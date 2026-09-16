<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('status'))
                <div class="mb-6 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @php
                $steps = [
                    ['value' => 'submitted',       'label' => 'Submitted'],
                    ['value' => 'processing',      'label' => 'Paid'],
                    ['value' => 'for_signature',   'label' => 'Approved'],
                    ['value' => 'ready_for_pickup','label' => 'For Release'],
                    ['value' => 'completed',       'label' => 'Claimed'],
                ];
                $activeStep = collect($steps)->search(fn ($s) => $s['value'] === $request->status);
                $cancelled = $request->status === 'cancelled';
            @endphp

            {{-- Header --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h1 class="text-lg font-extrabold text-gray-900">Document Details</h1>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('registrar.document-requests.index') }}"
                           class="w-8 h-8 inline-flex items-center justify-center rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition"
                           title="Close">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Stepper --}}
                <div class="px-6 py-6">
                    <ol class="flex items-center gap-1 overflow-x-auto">
                        @foreach ($steps as $i => $step)
                            @if ($i > 0)
                                <li class="flex-1 min-w-4 h-px mx-1 mb-5 {{ $activeStep !== false && $i <= $activeStep ? 'bg-green-500' : 'bg-gray-200' }}"></li>
                            @endif
                            <li class="flex flex-col items-center w-20 shrink-0">
                                <span class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold
                                    {{ $cancelled ? 'bg-red-50 text-red-500 ring-1 ring-red-200'
                                        : ($activeStep !== false && $i < $activeStep ? 'bg-green-500 text-white'
                                        : ($activeStep === $i ? 'bg-blue-800 text-white ring-4 ring-blue-100'
                                        : 'bg-gray-100 text-gray-400')) }}">
                                    {{ $i + 1 }}
                                </span>
                                <span class="mt-1.5 text-[11px] font-bold uppercase tracking-wide text-center {{ $activeStep === $i && ! $cancelled ? 'text-blue-800' : 'text-gray-400' }}">
                                    {{ $step['label'] }}
                                </span>
                            </li>
                        @endforeach
                    </ol>

                    @if ($cancelled)
                        <p class="mt-3 text-center text-xs font-bold text-red-600">This request was rejected / cancelled.</p>
                    @endif
                </div>

                {{-- Main Details --}}
                <div class="px-6 pb-6">
                    <div class="rounded-xl border border-gray-100 bg-gray-50/60 overflow-hidden">
                        <div class="px-5 py-4 flex items-start justify-between gap-3 border-b border-gray-100">
                            <div>
                                <p class="font-extrabold text-gray-900">{{ $request->documentsSummary() }}</p>
                                <p class="text-xs text-gray-500 mt-1">Transaction No.: {{ $request->request_number }}</p>
                            </div>
                            <span class="shrink-0 inline-flex px-3 py-1 rounded-full text-xs font-bold
                                @if ($cancelled) bg-red-50 text-red-600 ring-1 ring-red-200
                                @elseif ($request->status === 'completed') bg-green-50 text-green-700 ring-1 ring-green-200
                                @else bg-yellow-50 text-yellow-700 ring-1 ring-yellow-200 @endif">
                                {{ $cancelled ? 'Cancelled' : ($activeStep !== false ? $steps[$activeStep]['label'] : ucfirst($request->status)) }}
                            </span>
                        </div>

                        <div class="px-5 py-4 grid grid-cols-2 gap-5 text-sm">
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">Student Name</p>
                                <p class="mt-1 font-semibold text-gray-800">{{ $request->student_name }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">Student ID</p>
                                <p class="mt-1 font-semibold text-gray-800">{{ $request->user->studentProfile?->student_id ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">Course / Department</p>
                                <p class="mt-1 font-semibold text-gray-800">
                                    {{ $request->user->studentProfile?->course ?? '—' }}
                                    @if ($request->user->studentProfile?->year_level)
                                        <span class="block text-xs font-normal text-gray-500">{{ $request->user->studentProfile->year_level }}</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">ISUFST Email</p>
                                <p class="mt-1 font-semibold text-gray-800 break-all">{{ $request->user->email }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">Payment Status</p>
                                <p class="mt-1 font-semibold {{ $request->isPaid() ? 'text-green-700' : 'text-yellow-600' }}">
                                    {{ $request->isPaid() ? 'Paid' : 'Pending' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">Amount</p>
                                <p class="mt-1 font-semibold text-gray-800">₱{{ number_format($request->totalFee(), 2) }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Payment Info --}}
                    <div class="mt-4">
                        <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-2 mt-5">Payment Info</p>
                        <div class="rounded-xl border border-gray-100 overflow-hidden">
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 px-5 py-3.5 text-sm bg-white">
                                <div>
                                    <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">Method</p>
                                    <p class="mt-1 font-semibold text-gray-800">{{ $request->isPaid() ? 'Over the Counter' : '—' }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">Transaction No.</p>
                                    <p class="mt-1 font-semibold text-gray-800">{{ $request->isPaid() ? $request->request_number : '—' }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">Official Receipt No.</p>
                                    <p class="mt-1 font-semibold text-gray-800">{{ $request->or_number ?? '—' }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] font-bold uppercase tracking-wide text-gray-400">Paid at</p>
                                    <p class="mt-1 font-semibold text-gray-800">{{ $request->paid_at?->format('M d, Y h:i A') ?? '—' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                @if ($request->isActive())
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex flex-col sm:flex-row gap-3 sm:justify-between sm:items-center">
                        <p class="text-sm text-gray-500">The student is notified on every change.</p>
                        <div class="flex gap-3">
                            <form method="POST" action="{{ route('registrar.document-requests.cancel', $request) }}"
                                  data-confirm="The student will be notified that their request was rejected."
                                  data-confirm-title="Reject this document request?" data-confirm-ok="Yes, reject it"
                                  class="flex flex-col sm:flex-row gap-2 items-start sm:items-center">
                                @csrf
                                <input type="text" name="reason" maxlength="500"
                                       placeholder="Rejection reason (optional)"
                                       class="w-full sm:w-56 px-3 py-2 border border-gray-200 rounded-xl text-sm focus:border-red-300 focus:ring-red-200">
                                <button type="submit"
                                        class="px-5 py-2.5 bg-white border border-red-200 text-red-600 text-sm font-semibold rounded-xl hover:bg-red-50 transition">
                                    Reject Request
                                </button>
                            </form>
                            <form method="POST" action="{{ route('registrar.document-requests.next', $request) }}"
                                  data-confirm="{{ $request->status === 'ready_for_pickup'
                                    ? 'Verify that the student is present and release the documents.'
                                    : 'Approve and advance this request to the next pipeline stage.' }}"
                                  data-confirm-title="{{ $request->status === 'ready_for_pickup' ? 'Mark as claimed?' : 'Approve this document?' }}"
                                  data-confirm-ok="{{ $request->status === 'ready_for_pickup' ? 'Yes, mark as claimed' : 'Yes, approve' }}"
                                  data-confirm-icon="{{ $request->status === 'ready_for_pickup' ? 'success' : 'question' }}"
                                  class="flex flex-col sm:flex-row gap-2 items-start sm:items-end">
                                @csrf
                                @if ($request->status === 'for_signature')
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wide text-gray-400 mb-1">Release Date</label>
                                        <input type="date" name="release_date" value="{{ now()->toDateString() }}"
                                               class="px-3 py-2 border border-gray-200 rounded-xl text-sm focus:border-blue-400 focus:ring-blue-200">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold uppercase tracking-wide text-gray-400 mb-1">Release Time</label>
                                        <input type="time" name="release_time" value="08:00"
                                               class="px-3 py-2 border border-gray-200 rounded-xl text-sm focus:border-blue-400 focus:ring-blue-200">
                                    </div>
                                @endif
                                <button type="submit"
                                        class="px-5 py-2.5 bg-blue-800 text-white text-sm font-semibold rounded-xl hover:bg-blue-900 transition">
                                    {{ $request->status === 'ready_for_pickup' ? 'Mark as Claimed' : 'Approve Document' }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                {{-- Full Request Details --}}
                <details class="px-6 py-4 border-t border-gray-100">
                    <summary class="cursor-pointer text-sm font-semibold text-blue-700 hover:text-blue-900 transition">
                        Full Request Details
                    </summary>
                    <dl class="mt-4 grid sm:grid-cols-2 gap-5 text-sm">
                        <div>
                            <dt class="text-gray-400 text-xs">Purpose</dt>
                            <dd class="mt-1 font-semibold text-gray-800">
                                {{ \App\Enums\RequestPurposeType::tryFrom($request->purpose_type)?->label() ?? '—' }}
                                @if ($request->transfer_to)
                                    <span class="block text-sm font-normal text-gray-600 mt-0.5">Transfer to: {{ $request->transfer_to }}</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs">Student Status / Level</dt>
                            <dd class="mt-1 font-semibold text-gray-800">
                                {{ \App\Enums\EducationalStatus::tryFrom($request->educational_status)?->label() ?? '—' }}
                                &middot; {{ \App\Enums\EducationalLevel::tryFrom($request->educational_level)?->label() ?? '—' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs">Contact</dt>
                            <dd class="mt-1 font-semibold text-gray-800">{{ $request->student_contact ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs">Address</dt>
                            <dd class="mt-1 font-semibold text-gray-800">{{ $request->student_address ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs">Mode of Claiming</dt>
                            <dd class="mt-1 font-semibold text-gray-800">
                                {{ \App\Enums\ClaimMode::tryFrom($request->claim_mode)?->label() ?? '—' }}
                                @if ($request->claim_mode === 'representative' && $request->representative_name)
                                    <span class="block text-sm font-normal text-gray-600 mt-0.5">Representative: {{ $request->representative_name }}</span>
                                @endif
                            </dd>
                        </div>

                        @if (! empty($request->attachments))
                            <div class="sm:col-span-2">
                                <dt class="text-gray-400 text-xs">Attachments</dt>
                                <dd class="mt-1 flex flex-wrap gap-2">
                                    @foreach ($request->attachments as $attachment)
                                        <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($attachment) }}" target="_blank"
                                           class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-blue-50 text-xs font-semibold text-blue-700 hover:bg-blue-100 transition">
                                            📎 {{ basename($attachment) }}
                                        </a>
                                    @endforeach
                                </dd>
                            </div>
                        @endif
                    </dl>
                </details>
            </div>
        </div>
    </div>
</x-app-layout>