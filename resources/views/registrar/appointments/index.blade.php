<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- =========================================================
                HEADER
            ========================================================== --}}
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-8">

                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-11 h-11 rounded-2xl bg-blue-800 flex items-center justify-center shadow-lg shadow-blue-800/20">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 4h10M5 21h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-2xl font-extrabold tracking-tight text-slate-900">
                                Appointments Management
                            </h1>

                            <p class="text-sm text-slate-500 mt-0.5">
                                {{ auth()->user()->officeScope() }} Office
                            </p>
                        </div>
                    </div>

                    <p class="text-sm text-slate-500 max-w-2xl">
                        Review student appointments, manage schedules, and reschedule appointments
                        when necessary.
                    </p>
                </div>

                {{-- Calendar Button --}}
                <a href="#"
                   class="inline-flex items-center justify-center gap-2 px-5 py-3
                          bg-white border border-slate-200 text-slate-700
                          text-sm font-bold rounded-xl shadow-sm
                          hover:bg-slate-50 transition">

                    <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 4h10M5 21h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                    </svg>

                    Schedule Calendar
                </a>
            </div>


            {{-- =========================================================
                STATISTICS
            ========================================================== --}}
            @php
                $totalAppointments = $appointments->total();

                $pendingCount = $appointments->where('status', 'pending')->count();
                $confirmedCount = $appointments->where('status', 'confirmed')->count();
                $rescheduleCount = $appointments->where('status', 'for_reschedule')->count();
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-7">

                {{-- Total --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Total Appointments
                            </p>

                            <p class="text-3xl font-extrabold text-slate-900 mt-2">
                                {{ $totalAppointments }}
                            </p>

                            <p class="text-xs text-slate-400 mt-1">
                                All appointments
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-700" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 4h10M5 21h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>


                {{-- Pending --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Pending
                            </p>

                            <p class="text-3xl font-extrabold text-yellow-600 mt-2">
                                {{ $pendingCount }}
                            </p>

                            <p class="text-xs text-slate-400 mt-1">
                                Awaiting review
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-yellow-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>


                {{-- Confirmed --}}
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Confirmed
                            </p>

                            <p class="text-3xl font-extrabold text-emerald-600 mt-2">
                                {{ $confirmedCount }}
                            </p>

                            <p class="text-xs text-slate-400 mt-1">
                                Scheduled students
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                </div>


                {{-- Reschedule --}}
                <div class="bg-white rounded-2xl border border-orange-200 p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                For Reschedule
                            </p>

                            <p class="text-3xl font-extrabold text-orange-600 mt-2">
                                {{ $rescheduleCount }}
                            </p>

                            <p class="text-xs text-slate-400 mt-1">
                                Needs new schedule
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-orange-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-600" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8V4m0 0l-3 3m3-3l3 3M6 12a6 6 0 1012 0"/>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>


            {{-- =========================================================
                SEARCH / FILTER
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 mb-5">

                <div class="flex flex-col lg:flex-row gap-3">

                    {{-- Search --}}
                    <div class="relative flex-1">

                        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2
                                    w-5 h-5 text-slate-400"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-4.35-4.35m2.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>

                        <input
                            type="text"
                            placeholder="Search student name or reference number..."
                            class="w-full pl-11 pr-4 py-3 rounded-xl
                                   border-slate-200 bg-slate-50
                                   text-sm focus:bg-white
                                   focus:border-blue-500 focus:ring-blue-500">
                    </div>


                    {{-- Status --}}
                    <select
                        class="lg:w-48 rounded-xl border-slate-200 bg-slate-50
                               text-sm text-slate-600 focus:bg-white
                               focus:border-blue-500 focus:ring-blue-500">

                        <option>All Status</option>
                        <option>Pending</option>
                        <option>Confirmed</option>
                        <option>For Reschedule</option>
                        <option>Rescheduled</option>
                        <option>Completed</option>
                        <option>Cancelled</option>
                    </select>


                    {{-- Date --}}
                    <input
                        type="date"
                        class="lg:w-48 rounded-xl border-slate-200 bg-slate-50
                               text-sm text-slate-600 focus:bg-white
                               focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>


            {{-- =========================================================
                APPOINTMENTS
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- Table Header --}}
                <div class="hidden lg:grid grid-cols-12 gap-4 px-6 py-3
                            bg-slate-50 border-b border-slate-200
                            text-[11px] font-extrabold uppercase
                            tracking-wider text-slate-400">

                    <div class="col-span-4">Student / Appointment</div>
                    <div class="col-span-3">Schedule</div>
                    <div class="col-span-2">Status</div>
                    <div class="col-span-3 text-right">Actions</div>
                </div>


                @forelse ($appointments as $appointment)

                    <div class="group px-5 lg:px-6 py-5 border-b border-slate-100
                                last:border-0 hover:bg-blue-50/30 transition">

                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-center">

                            {{-- Student --}}
                            <a
                                href="{{ route('registrar.appointments.show', $appointment) }}"
                                class="lg:col-span-4 min-w-0">

                                <div class="flex items-start gap-3">

                                    <div class="w-10 h-10 rounded-xl bg-blue-100
                                                text-blue-800 flex items-center
                                                justify-center font-extrabold
                                                text-sm shrink-0">

                                        {{ strtoupper(substr($appointment->user->name, 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <div class="flex items-center gap-2 flex-wrap">
                                            <p class="font-bold text-slate-900 text-sm">
                                                {{ $appointment->user->name }}
                                            </p>

                                            <span class="text-[10px] font-bold
                                                         uppercase tracking-wide
                                                         text-slate-400 bg-slate-100
                                                         px-2 py-0.5 rounded-full">
                                                {{ $appointment->reference_code }}
                                            </span>
                                        </div>

                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ $appointment->office }}
                                        </p>

                                        <p class="text-xs text-slate-400 mt-0.5 truncate">
                                            {{ $appointment->purpose }}
                                        </p>
                                    </div>

                                </div>
                            </a>


                            {{-- Schedule --}}
                            <div class="lg:col-span-3">

                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50
                                                flex items-center justify-center">

                                        <svg class="w-4 h-4 text-blue-700"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M8 7V3m8 4V3m-9 4h10M5 21h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                                        </svg>
                                    </div>

                                    <div>
                                        <p class="text-sm font-bold text-slate-800">
                                            {{ $appointment->date->format('M j, Y') }}
                                        </p>

                                        <p class="text-xs text-slate-500">
                                            {{ $appointment->time_slot }}
                                        </p>
                                    </div>
                                </div>

                                @if ($appointment->original_date)
                                    <p class="text-[11px] text-indigo-600 font-semibold mt-2 ml-10">
                                        Rescheduled from
                                        {{ $appointment->original_date->format('M j, Y') }}
                                    </p>
                                @endif

                            </div>


                            {{-- Status --}}
                            <div class="lg:col-span-2">

                                <span class="inline-flex items-center gap-1.5
                                             px-3 py-1.5 rounded-full text-xs font-bold

                                    @if ($appointment->status === 'confirmed')
                                        bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200

                                    @elseif ($appointment->status === 'checked_in')
                                        bg-cyan-50 text-cyan-700 ring-1 ring-cyan-200

                                    @elseif ($appointment->status === 'rescheduled')
                                        bg-indigo-50 text-indigo-700 ring-1 ring-indigo-200

                                    @elseif ($appointment->status === 'for_reschedule')
                                        bg-orange-50 text-orange-700 ring-1 ring-orange-200

                                    @elseif ($appointment->status === 'completed')
                                        bg-blue-50 text-blue-700 ring-1 ring-blue-200

                                    @elseif ($appointment->status === 'cancelled')
                                        bg-red-50 text-red-600 ring-1 ring-red-200

                                    @elseif ($appointment->status === 'no_show')
                                        bg-slate-100 text-slate-500 ring-1 ring-slate-200

                                    @else
                                        bg-yellow-50 text-yellow-700 ring-1 ring-yellow-200
                                    @endif
                                ">

                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>

                                    {{ \App\Enums\AppointmentStatus::tryFrom($appointment->status)?->label() ?? ucfirst($appointment->status) }}

                                </span>

                            </div>


                            {{-- Actions --}}
                            <div class="lg:col-span-3 flex flex-wrap
                                        lg:justify-end gap-2">

                                @unless (in_array($appointment->status, ['completed', 'cancelled', 'no_show']))

                                    <button
                                        type="button"
                                        @click="$dispatch('open-reschedule', {
                                            id: {{ $appointment->id }},
                                            student: @js($appointment->user->name),
                                            studentId: @js($appointment->user->studentProfile?->student_id),
                                            reference: @js($appointment->reference_code),
                                            office: @js($appointment->office),
                                            dateLabel: @js($appointment->date->format('F j, Y')),
                                            timeSlot: @js($appointment->time_slot),
                                            reason: @js($appointment->reschedule_reason)
                                        })"
                                        class="inline-flex items-center justify-center gap-1.5
                                               px-3.5 py-2.5
                                               bg-indigo-50 border border-indigo-200
                                               text-indigo-700 text-xs font-bold
                                               rounded-xl hover:bg-indigo-100
                                               transition">

                                        <svg class="w-4 h-4" fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M8 7V3m8 4V3m-9 4h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M9 15l2 2 4-4"/>
                                        </svg>

                                        Reschedule
                                    </button>

                                @endunless


                                <a
                                    href="{{ route('registrar.appointments.show', $appointment) }}"
                                    class="inline-flex items-center justify-center gap-1.5
                                           px-3.5 py-2.5
                                           bg-blue-800 text-white
                                           text-xs font-bold rounded-xl
                                           hover:bg-blue-900 transition shadow-sm">

                                    <svg class="w-4 h-4" fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>

                                    View Details
                                </a>

                            </div>

                        </div>
                    </div>

                @empty

                    <div class="py-20 text-center">

                        <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-100
                                    flex items-center justify-center mb-4">

                            <svg class="w-8 h-8 text-slate-400"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 4h10M5 21h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                            </svg>

                        </div>

                        <p class="font-bold text-slate-700">
                            No appointments found
                        </p>

                        <p class="text-sm text-slate-400 mt-1">
                            There are currently no appointments matching your criteria.
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- Pagination --}}
            <div class="mt-6">
                {{ $appointments->links() }}
            </div>

        </div>
    </div>


    {{-- Existing Reschedule Modal --}}
    @include('registrar.appointments.partials.reschedule-modal')

</x-app-layout>