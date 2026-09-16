<x-app-layout>
    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <a href="{{ route('cashier.ledger.index') }}" class="text-sm text-blue-700 font-semibold hover:underline">← Back to Student Ledger</a>
                <h1 class="text-2xl font-extrabold text-gray-900 mt-2">{{ $student->name }}</h1>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $student->studentProfile?->course ?: 'No course set' }}
                    @if ($student->studentProfile?->year_level)
                        &middot; Year {{ $student->studentProfile->year_level }}
                    @endif
                    &middot; {{ $student->email }}
                </p>
            </div>

            {{-- Summary --}}
            <div class="grid sm:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Document Requests</p>
                    <p class="mt-1 text-2xl font-extrabold text-gray-900">{{ $requests->count() }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Total Paid</p>
                    <p class="mt-1 text-2xl font-extrabold text-green-700">₱{{ number_format($totalPaid, 2) }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Outstanding Balance</p>
                    <p class="mt-1 text-2xl font-extrabold {{ $totalOutstanding > 0 ? 'text-red-600' : 'text-gray-900' }}">₱{{ number_format($totalOutstanding, 2) }}</p>
                </div>
            </div>

            {{-- Requests --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="font-bold text-gray-900 text-sm">Document Requests</h2>
                </div>

                @forelse ($requests as $request)
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3 px-6 py-4 border-b border-gray-50 last:border-0">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <p class="font-bold text-gray-900 text-sm truncate">{{ $request->documentsSummary() }}</p>
                                <span class="text-[10px] font-bold uppercase tracking-wide text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $request->request_number }}</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-0.5">
                                {{ $request->created_at->format('M d, Y') }}
                                @if ($request->isPaid())
                                    &middot; Paid {{ $request->paid_at->format('M d, Y h:i A') }}
                                @endif
                            </p>
                        </div>
                        <div class="flex items-center gap-3 self-start sm:self-center">
                            <span class="font-bold text-blue-900">₱{{ number_format($request->totalFee(), 2) }}</span>
                            @if ($request->isPaid())
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-green-50 text-green-700 ring-1 ring-green-200">Paid</span>
                            @else
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-yellow-50 text-yellow-700 ring-1 ring-yellow-200">Unpaid</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <p class="font-semibold text-gray-700">No document requests yet</p>
                        <p class="text-sm text-gray-400 mt-1">This student has not requested any documents.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>