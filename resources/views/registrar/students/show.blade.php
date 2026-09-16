<x-app-layout>
    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6">
                <a href="{{ route('registrar.students.index') }}"
                   class="text-sm font-semibold text-blue-700 hover:text-blue-900 transition">← Back to student lookup</a>
            </div>

            {{-- Student Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
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
                        <h1 class="text-2xl font-extrabold text-gray-900">{{ $student->name }}</h1>
                        <p class="text-sm text-gray-500 mt-0.5">{{ $student->email }}</p>
                        <p class="text-xs text-gray-400 mt-1">
                            {{ $student->studentProfile?->course ?: 'No course set' }}
                            @if ($student->studentProfile?->year_level)
                                &middot; Year {{ $student->studentProfile->year_level }}
                            @endif
                        </p>
                    </div>
                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 ring-1 ring-blue-200">Student</span>
                </div>

                @if ($student->studentProfile && ($student->studentProfile->address || $student->studentProfile->contact_number))
                    <dl class="mt-5 grid sm:grid-cols-2 gap-4 border-t border-gray-100 pt-5 text-sm">
                        <div>
                            <dt class="text-gray-400 text-xs">Address</dt>
                            <dd class="mt-1 font-semibold text-gray-800">{{ $student->studentProfile->address }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-400 text-xs">Contact Number</dt>
                            <dd class="mt-1 font-semibold text-gray-800">{{ $student->studentProfile->contact_number }}</dd>
                        </div>
                    </dl>
                @endif
            </div>

            {{-- Document Requests --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="font-bold text-gray-900">Document Requests</h2>
                </div>
                @forelse ($student->documentRequests as $request)
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 px-6 py-4 border-b border-gray-50 last:border-0">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 truncate">{{ $request->documentsSummary() }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $request->request_number }} &middot; {{ $request->created_at->format('M j, Y') }}</p>
                        </div>
                        <span class="self-start sm:self-center inline-flex px-3 py-1 rounded-full text-xs font-bold
                            @if ($request->status === 'submitted') bg-yellow-50 text-yellow-700 ring-1 ring-yellow-200
                            @elseif ($request->status === 'processing') bg-cyan-50 text-cyan-700 ring-1 ring-cyan-200
                            @elseif ($request->status === 'for_signature') bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200
                            @elseif ($request->status === 'ready_for_pickup') bg-green-50 text-green-700 ring-1 ring-green-200
                            @elseif ($request->status === 'completed') bg-blue-50 text-blue-700 ring-1 ring-blue-200
                            @else bg-red-50 text-red-600 ring-1 ring-red-200 @endif">
                            {{ \App\Enums\DocumentRequestStatus::tryFrom($request->status)?->label() ?? ucfirst($request->status) }}
                        </span>
                    </div>
                @empty
                    <div class="p-10 text-center">
                        <p class="text-sm text-gray-400">No document requests yet.</p>
                    </div>
                @endforelse
            </div>

            {{-- Appointments --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="font-bold text-gray-900">Appointments</h2>
                </div>
                @forelse ($student->appointments as $appointment)
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 px-6 py-4 border-b border-gray-50 last:border-0">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800">{{ $appointment->office }} — {{ $appointment->purpose }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $appointment->date->format('M j, Y') }} &middot; {{ $appointment->time_slot }} &middot; {{ $appointment->reference_code }}</p>
                        </div>
                        <span class="self-start sm:self-center inline-flex px-3 py-1 rounded-full text-xs font-bold
                            @if ($appointment->status === 'confirmed') bg-green-50 text-green-700 ring-1 ring-green-200
                            @elseif ($appointment->status === 'checked_in') bg-cyan-50 text-cyan-700 ring-1 ring-cyan-200
                            @elseif ($appointment->status === 'rescheduled') bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200
                            @elseif ($appointment->status === 'completed') bg-blue-50 text-blue-700 ring-1 ring-blue-200
                            @elseif ($appointment->status === 'cancelled') bg-red-50 text-red-600 ring-1 ring-red-200
                            @elseif ($appointment->status === 'no_show') bg-gray-100 text-gray-500 ring-1 ring-gray-200
                            @else bg-yellow-50 text-yellow-700 ring-1 ring-yellow-200 @endif">
                            {{ \App\Enums\AppointmentStatus::tryFrom($appointment->status)?->label() ?? ucfirst($appointment->status) }}
                        </span>
                    </div>
                @empty
                    <div class="p-10 text-center">
                        <p class="text-sm text-gray-400">No appointments yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>