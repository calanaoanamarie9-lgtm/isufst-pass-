<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900">QR Pass Verification</h1>
                <p class="text-sm text-gray-500 mt-1">Scan or paste a student QR code to verify their identity.</p>
            </div>

<form method="GET" action="{{ route('registrar.qr.index') }}"
      class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-6">
    <label class="block text-xs font-bold uppercase tracking-wide text-gray-400 mb-1.5">QR Code / Student Identifier</label>
    <div class="flex flex-col sm:flex-row gap-3">
        <input type="text" name="q" value="{{ $query }}" id="qr-input"
               placeholder="Scan, paste the QR link, or type the student's name / email"
               class="flex-1 rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
               autofocus>
        <button type="submit"
                class="px-6 py-2.5 bg-blue-800 text-white text-sm font-semibold rounded-xl hover:bg-blue-900 transition">
            Verify
        </button>
    </div>
    <button type="button" onclick="startQrCamera()"
            class="mt-3 w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-blue-200 bg-blue-50 text-blue-800 text-xs font-bold hover:bg-blue-100 transition">
        📷 Scan with Camera
    </button>
    <div id="qr-reader" class="hidden mt-3 overflow-hidden rounded-xl border border-gray-200"></div>
    <p class="text-xs text-gray-400 mt-2">Tip: scanning a student pass, claim slip, or appointment QR opens its verification page automatically. USB scanner guns also work — just keep this field focused.</p>
</form>

<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
    let qrScanner = null;

    function startQrCamera() {
        const box = document.getElementById('qr-reader');

        if (typeof Html5Qrcode === 'undefined') {
            alert('Camera scanner could not load. Check your internet connection or use a USB scanner.');
            return;
        }

        box.classList.remove('hidden');

        if (qrScanner) return;

        qrScanner = new Html5Qrcode('qr-reader');

        qrScanner.start(
            { facingMode: 'environment' },
            { fps: 10, qrbox: { width: 230, height: 230 } },
            (decoded) => {
                stopQrCamera();
                const input = document.getElementById('qr-input');
                input.value = decoded.trim();
                input.closest('form').submit();
            },
            () => {}
        ).catch((err) => {
            box.classList.add('hidden');
            alert('Unable to access the camera: ' + err);
        });
    }

    function stopQrCamera() {
        if (qrScanner) {
            qrScanner.stop().then(() => {
                document.getElementById('qr-reader').classList.add('hidden');
                qrScanner.clear();
                qrScanner = null;
            }).catch(() => {});
        }
    }
</script>

            @if ($documentRequest)
                <div class="bg-white rounded-2xl border border-blue-200 shadow-sm overflow-hidden mb-6">
                    <div class="px-6 py-4 bg-blue-50 border-b border-blue-100 flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center gap-2">
                            <span class="text-xl">📄</span>
                            <p class="font-bold text-blue-800 text-sm">Document Request Found</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                            @if ($documentRequest->status === 'cancelled') bg-red-50 text-red-600 ring-1 ring-red-200
                            @elseif ($documentRequest->status === 'completed') bg-blue-50 text-blue-700 ring-1 ring-blue-200
                            @elseif ($documentRequest->status === 'ready_for_pickup') bg-green-50 text-green-700 ring-1 ring-green-200
                            @else bg-yellow-50 text-yellow-700 ring-1 ring-yellow-200 @endif">
                            {{ \App\Enums\DocumentRequestStatus::tryFrom($documentRequest->status)?->label() }}
                        </span>
                    </div>

                    <div class="p-6">
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div class="rounded-xl bg-blue-50/60 p-4">
                                <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Reference Number</p>
                                <p class="mt-1 text-sm font-semibold text-gray-800">{{ $documentRequest->request_number }}</p>
                            </div>
                            <div class="rounded-xl bg-blue-50/60 p-4">
                                <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Student</p>
                                <p class="mt-1 text-sm font-semibold text-gray-800">{{ $documentRequest->student_name }}</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="text-xs font-bold uppercase tracking-wide text-gray-400 mb-2">Document(s)</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($documentRequest->documents as $doc)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-50 text-xs font-semibold text-blue-700">
                                        {{ $doc->name }} <span class="text-blue-400">&middot; ₱{{ number_format($doc->fee, 2) }}</span>
                                    </span>
                                @endforeach
                                @if ($documentRequest->others_specification)
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-indigo-50 text-xs font-semibold text-indigo-700">
                                        Others: {{ $documentRequest->others_specification }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if ($documentRequest->status === 'ready_for_pickup')
                            <form method="POST" action="{{ route('registrar.document-requests.next', $documentRequest) }}"
                                  data-confirm="Verify that the student is present and release the documents."
                                  data-confirm-title="Mark this request as claimed?" data-confirm-ok="Yes, release documents" data-confirm-icon="success">
                                @csrf
                                <button type="submit"
                                        class="mt-5 w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-green-600 text-white text-sm font-bold rounded-xl hover:bg-green-700 transition">
                                    ✅ Verify &amp; Claim / Release Documents
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif

            @if ($appointment)
                <div class="bg-white rounded-2xl border border-cyan-200 shadow-sm overflow-hidden mb-6">
                    <div class="px-6 py-4 bg-cyan-50 border-b border-cyan-100 flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center gap-2">
                            <span class="text-xl">📅</span>
                            <p class="font-bold text-cyan-800 text-sm">Appointment Found</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                            @if ($appointment->status === 'confirmed') bg-green-50 text-green-700 ring-1 ring-green-200
                            @elseif ($appointment->status === 'checked_in') bg-cyan-50 text-cyan-700 ring-1 ring-cyan-200
                            @elseif ($appointment->status === 'rescheduled') bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200
                            @else bg-yellow-50 text-yellow-700 ring-1 ring-yellow-200 @endif">
                            {{ \App\Enums\AppointmentStatus::tryFrom($appointment->status)?->label() }}
                        </span>
                    </div>

                    <div class="p-6">
                        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="rounded-xl bg-blue-50/60 p-4">
                                <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Reference</p>
                                <p class="mt-1 text-sm font-semibold text-gray-800">{{ $appointment->reference_code }}</p>
                            </div>
                            <div class="rounded-xl bg-blue-50/60 p-4">
                                <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Office</p>
                                <p class="mt-1 text-sm font-semibold text-gray-800">{{ $appointment->office }}</p>
                            </div>
                            <div class="rounded-xl bg-blue-50/60 p-4">
                                <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Date</p>
                                <p class="mt-1 text-sm font-semibold text-gray-800">{{ $appointment->date->format('M j, Y') }}</p>
                            </div>
                            <div class="rounded-xl bg-blue-50/60 p-4">
                                <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Time Slot</p>
                                <p class="mt-1 text-sm font-semibold text-gray-800">{{ $appointment->time_slot }}</p>
                            </div>
                        </div>

                        <div class="mt-4 rounded-xl bg-blue-50/60 p-4">
                            <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Purpose</p>
                            <p class="mt-1 text-sm font-semibold text-gray-800">{{ $appointment->purpose }}</p>
                        </div>

                        @if ($appointment->user && $student)
                            <a href="{{ route('registrar.appointments.show', $appointment) }}"
                               class="mt-5 w-full inline-flex items-center justify-center px-5 py-3 bg-blue-800 text-white text-sm font-bold rounded-xl hover:bg-blue-900 transition">
                                Open Appointment Details
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            @if ($query && ! $student)
                <div class="bg-white rounded-2xl border border-red-200 shadow-sm p-8 text-center">
                    <p class="text-3xl">❌</p>
                    <p class="mt-2 font-bold text-gray-900">No student found</p>
                    <p class="text-sm text-gray-500 mt-1">The QR code or identifier does not match any registered student.</p>
                </div>
            @endif

            @if ($student)
                <div class="bg-white rounded-2xl border border-green-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 bg-green-50 border-b border-green-100 flex items-center gap-2">
                        <span class="text-xl">✅</span>
                        <p class="font-bold text-green-800 text-sm">Verified Student</p>
                    </div>

                    <div class="p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            <div class="w-16 h-16 rounded-full bg-blue-900 overflow-hidden flex items-center justify-center text-yellow-400 font-bold text-xl uppercase shrink-0">
                                @if ($student->studentProfile?->avatar)
                                    <img src="{{ Storage::url($student->studentProfile->avatar) }}"
                                         alt="Avatar" class="w-full h-full object-cover">
                                @else
                                    {{ substr($student->name, 0, 1) }}
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h2 class="text-xl font-extrabold text-gray-900">{{ $student->name }}</h2>
                                <p class="text-sm text-gray-500 mt-0.5">{{ $student->email }}</p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $student->studentProfile?->course ?: 'No course set' }}
                                    @if ($student->studentProfile?->year_level)
                                        &middot; Year {{ $student->studentProfile->year_level }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 grid sm:grid-cols-2 gap-4">
                            <div class="rounded-xl bg-blue-50/60 p-4">
                                <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Status</p>
                                <p class="mt-1 text-sm font-semibold text-green-700">Active Student Account</p>
                            </div>
                            <div class="rounded-xl bg-blue-50/60 p-4">
                                <p class="text-xs font-bold uppercase tracking-wide text-gray-400">Member Since</p>
                                <p class="mt-1 text-sm font-semibold text-gray-800">{{ $student->created_at->format('M j, Y') }}</p>
                            </div>
                        </div>

                        <h3 class="mt-6 text-xs font-bold uppercase tracking-widest text-gray-400">Recent Transactions</h3>
                        <div class="mt-2 space-y-2">
                            @forelse ($student->documentRequests as $request)
                                <div class="flex items-center justify-between gap-3 rounded-xl border border-gray-100 px-4 py-3">
                                    <p class="text-sm font-semibold text-gray-800 truncate">{{ $request->documentsSummary() }}</p>
                                    <span class="shrink-0 text-xs font-bold text-blue-700">{{ \App\Enums\DocumentRequestStatus::tryFrom($request->status)?->label() }}</span>
                                </div>
                            @empty
                                <p class="text-sm text-gray-400">No recent document requests.</p>
                            @endforelse
                            @forelse ($student->appointments as $appointment)
                                <div class="flex items-center justify-between gap-3 rounded-xl border border-gray-100 px-4 py-3">
                                    <p class="text-sm font-semibold text-gray-800 truncate">{{ $appointment->office }} — {{ $appointment->date->format('M j, Y') }} {{ $appointment->time_slot }}</p>
                                    <span class="shrink-0 text-xs font-bold text-blue-700">{{ \App\Enums\AppointmentStatus::tryFrom($appointment->status)?->label() }}</span>
                                </div>
                            @empty
                                <p class="text-sm text-gray-400">No recent appointments.</p>
                            @endforelse
                            <a href="{{ route('registrar.students.show', $student) }}"
                               class="block mt-2 text-sm font-semibold text-blue-700 hover:text-blue-900 transition">
                                View full student record →
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>