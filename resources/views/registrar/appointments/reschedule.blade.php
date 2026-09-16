<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back --}}
            <a href="{{ route('registrar.appointments.show', $appointment) }}"
               class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-blue-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Appointment
            </a>


            {{-- =====================================================
                PAGE HEADER
            ====================================================== --}}
            <div class="mt-5 mb-7">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div>
                        <div class="flex items-center gap-3">

                            <div class="w-11 h-11 rounded-2xl bg-indigo-100
                                        flex items-center justify-center">

                                <svg class="w-6 h-6 text-indigo-700"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 4h10M5 21h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M9 15l2 2 4-4"/>
                                </svg>

                            </div>

                            <div>
                                <h1 class="text-2xl font-extrabold text-slate-900">
                                    Reschedule Appointment
                                </h1>

                                <p class="text-sm text-slate-500 mt-0.5">
                                    Choose a new available date and time for this student.
                                </p>
                            </div>

                        </div>
                    </div>

                    {{-- Reference --}}
                    <div class="flex items-center gap-2">

                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400">
                            Reference
                        </span>

                        <span class="px-3 py-1.5 bg-white border border-slate-200
                                     rounded-lg text-xs font-bold text-slate-700">
                            {{ $appointment->reference_code }}
                        </span>

                    </div>

                </div>
            </div>


            {{-- =====================================================
                STUDENT INFORMATION
            ====================================================== --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden mb-6">

                <div class="px-6 py-4 border-b border-slate-100
                            flex items-center justify-between">

                    <div>
                        <p class="text-xs font-extrabold uppercase tracking-wider text-slate-400">
                            Student Information
                        </p>

                        <p class="text-lg font-bold text-slate-900 mt-1">
                            {{ $appointment->user->name }}
                        </p>
                    </div>

                    <div class="w-11 h-11 rounded-xl bg-blue-50
                                flex items-center justify-center">

                        <svg class="w-5 h-5 text-blue-700"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>

                    </div>

                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-slate-100">

                    <div class="px-6 py-4">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Student ID
                        </p>

                        <p class="text-sm font-semibold text-slate-800 mt-1">
                            {{ $appointment->user->studentProfile?->student_id ?? '—' }}
                        </p>
                    </div>

                    <div class="px-6 py-4">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Office
                        </p>

                        <p class="text-sm font-semibold text-slate-800 mt-1">
                            {{ $appointment->office }}
                        </p>
                    </div>

                    <div class="px-6 py-4">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Purpose
                        </p>

                        <p class="text-sm font-semibold text-slate-800 mt-1">
                            {{ $appointment->purpose }}
                        </p>
                    </div>

                </div>
            </div>


            {{-- =====================================================
                CURRENT SCHEDULE
            ====================================================== --}}
            <div class="relative overflow-hidden bg-gradient-to-r from-blue-900 to-indigo-900
                        rounded-2xl shadow-lg mb-6">

                {{-- Decorative --}}
                <div class="absolute -right-12 -top-12 w-40 h-40
                            rounded-full bg-white/5"></div>

                <div class="absolute -right-5 -bottom-16 w-48 h-48
                            rounded-full bg-white/5"></div>


                <div class="relative p-6">

                    <div class="flex items-center gap-2 mb-4">

                        <div class="w-8 h-8 rounded-lg bg-white/10
                                    flex items-center justify-center">

                            <svg class="w-4 h-4 text-white"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 4h10M5 21h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                            </svg>

                        </div>

                        <p class="text-xs font-bold uppercase tracking-widest text-blue-100">
                            Current Schedule
                        </p>

                    </div>


                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        <div>
                            <p class="text-2xl font-extrabold text-white">
                                {{ $appointment->date->format('F j, Y') }}
                            </p>

                            <p class="text-sm text-blue-100 mt-1">
                                {{ $appointment->time_slot }}
                            </p>
                        </div>

                        <div class="sm:text-right">

                            @if ($appointment->original_date)

                                <p class="text-xs text-blue-200">
                                    Originally scheduled
                                </p>

                                <p class="text-sm font-bold text-white mt-1">
                                    {{ $appointment->original_date->format('F j, Y') }}
                                </p>

                            @else

                                <p class="text-xs text-blue-200">
                                    Appointment Office
                                </p>

                                <p class="text-sm font-bold text-white mt-1">
                                    {{ $appointment->office }}
                                </p>

                            @endif

                        </div>

                    </div>

                </div>
            </div>


            {{-- =====================================================
                ERRORS
            ====================================================== --}}
            @if ($errors->any())

                <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4">

                    <div class="flex gap-3">

                        <svg class="w-5 h-5 text-red-600 shrink-0"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 9v2m0 4h.01M10.29 3.86l-7.82 14a1 1 0 00.87 1.5h17.32a1 1 0 00.87-1.5l-7.82-14a1 1 0 00-1.74 0z"/>
                        </svg>

                        <div>
                            <p class="text-sm font-bold text-red-800">
                                Please correct the following:
                            </p>

                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                </div>

            @endif


            {{-- =====================================================
                RESCHEDULE FORM
            ====================================================== --}}
            <form
                method="POST"
                action="{{ route('registrar.appointments.reschedule.update', $appointment) }}"

                data-confirm="The appointment will be moved to the new date and time slot."
                data-confirm-title="Reschedule this appointment?"
                data-confirm-ok="Yes, reschedule"
                data-confirm-icon="question"

                x-data="{
                    date: '{{ old('date') }}',
                    loading: false,
                    slots: [],
                    selectedSlot: '{{ old('time_slot') }}',

                    init() {
                        if (this.date) this.loadSlots();
                    },

                    loadSlots() {
                        if (!this.date) return;

                        this.loading = true;
                        this.slots = [];
                        this.selectedSlot = '';

                        fetch('{{ route('registrar.appointments.slots') }}?office={{ $appointment->office }}&date=' + this.date + '&ignore_id={{ $appointment->id }}')
                            .then(r => r.json())
                            .then(data => {
                                this.slots = data;
                                this.loading = false;
                            })
                            .catch(() => {
                                this.loading = false;
                                this.slots = [];
                            });
                    }
                }"

                x-on:date-selected="date = $event.detail.date; loadSlots()"
            >

                @csrf
                @method('PUT')


                <div class="bg-white rounded-2xl border border-slate-200
                            shadow-sm overflow-hidden">

                    {{-- Form Header --}}
                    <div class="px-6 py-5 border-b border-slate-100">

                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 rounded-xl bg-indigo-50
                                        flex items-center justify-center">

                                <svg class="w-5 h-5 text-indigo-700"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M12 8v4l3 2"/>
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>

                            </div>

                            <div>
                                <h2 class="font-bold text-slate-900">
                                    Select New Schedule
                                </h2>

                                <p class="text-xs text-slate-400 mt-0.5">
                                    Choose an available date and time slot.
                                </p>
                            </div>

                        </div>

                    </div>


                    <div class="p-6 space-y-8">


                        {{-- =================================================
                            DATE
                        ================================================== --}}
                        <div>

                            <div class="flex items-center justify-between mb-3">

                                <div>
                                    <label class="text-sm font-bold text-slate-800">
                                        1. Select New Date
                                    </label>

                                    <p class="text-xs text-slate-400 mt-0.5">
                                        Green dates have available appointment slots.
                                    </p>
                                </div>

                                <span class="inline-flex items-center gap-1.5
                                             text-[11px] font-bold text-emerald-600">

                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    Available

                                </span>

                            </div>


                            <input
                                id="date"
                                name="date"
                                type="date"
                                min="{{ now()->toDateString() }}"
                                x-model="date"
                                class="hidden"
                            >


                            <div class="rounded-2xl border border-slate-200
                                        bg-slate-50 p-4">

                                <x-availability-calendar
                                    office="{{ $appointment->office }}"
                                    endpoint="{{ route('registrar.availability.month') }}"
                                    :initial-month="substr(old('date', now()->toDateString()), 0, 7)"
                                    :selected="old('date', now()->toDateString())"
                                    emit
                                />

                            </div>

                            <div class="flex flex-wrap gap-4 mt-3">

                                <span class="inline-flex items-center gap-2 text-xs text-slate-500">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                    Open
                                </span>

                                <span class="inline-flex items-center gap-2 text-xs text-slate-500">
                                    <span class="w-2.5 h-2.5 rounded-full bg-red-400"></span>
                                    Full / Blocked
                                </span>

                            </div>

                        </div>


                        {{-- Divider --}}
                        <div class="border-t border-slate-100"></div>


                        {{-- =================================================
                            TIME SLOTS
                        ================================================== --}}
                        <div>

                            <div class="mb-4">

                                <label class="text-sm font-bold text-slate-800">
                                    2. Select Available Time
                                </label>

                                <p class="text-xs text-slate-400 mt-0.5">
                                    Available capacity is updated automatically.
                                </p>

                            </div>


                            {{-- Loading --}}
                            <div
                                x-show="loading"
                                x-cloak
                                class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                                <div class="h-20 rounded-xl bg-slate-100 animate-pulse"></div>
                                <div class="h-20 rounded-xl bg-slate-100 animate-pulse"></div>

                            </div>


                            {{-- No date --}}
                            <div
                                x-show="!loading && !date"
                                x-cloak
                                class="border border-dashed border-slate-300
                                       rounded-2xl p-8 text-center">

                                <div class="w-12 h-12 mx-auto rounded-xl bg-slate-100
                                            flex items-center justify-center mb-3">

                                    <svg class="w-6 h-6 text-slate-400"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 4h10M5 21h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                                    </svg>

                                </div>

                                <p class="text-sm font-semibold text-slate-600">
                                    Select a date first
                                </p>

                                <p class="text-xs text-slate-400 mt-1">
                                    Available time slots will appear here.
                                </p>

                            </div>


                            {{-- Empty slots --}}
                            <div
                                x-show="!loading && date && slots.length === 0"
                                x-cloak
                                class="border border-dashed border-slate-300
                                       rounded-2xl p-8 text-center">

                                <div class="w-12 h-12 mx-auto rounded-xl bg-orange-50
                                            flex items-center justify-center mb-3">

                                    <svg class="w-6 h-6 text-orange-500"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M12 9v2m0 4h.01M10.29 3.86l-7.82 14a1 1 0 00.87 1.5h17.32a1 1 0 00.87-1.5l-7.82-14a1 1 0 00-1.74 0z"/>
                                    </svg>

                                </div>

                                <p class="text-sm font-semibold text-slate-600">
                                    No available time slots
                                </p>

                                <p class="text-xs text-slate-400 mt-1">
                                    Please select another date.
                                </p>

                            </div>


                            {{-- Time Slot Cards --}}
                            <div
                                x-show="!loading && slots.length > 0"
                                x-cloak
                                class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                                <template x-for="slot in slots" :key="slot.time">

                                    <button
                                        type="button"
                                        :disabled="!slot.is_open"

                                        @click="if(slot.is_open) selectedSlot = slot.time"

                                        :class="{
                                            'border-indigo-500 bg-indigo-50 ring-2 ring-indigo-100':
                                                selectedSlot === slot.time && slot.is_open,

                                            'border-slate-200 bg-white hover:border-indigo-300 hover:bg-indigo-50/40':
                                                selectedSlot !== slot.time && slot.is_open,

                                            'border-slate-200 bg-slate-50 opacity-60 cursor-not-allowed':
                                                !slot.is_open
                                        }"

                                        class="relative text-left rounded-2xl border p-4
                                               transition duration-200">

                                        <div class="flex items-center justify-between">

                                            <div>

                                                <p
                                                    class="text-sm font-bold text-slate-800"
                                                    x-text="slot.time">
                                                </p>

                                                <p
                                                    class="text-xs mt-1"
                                                    :class="slot.is_open
                                                        ? 'text-emerald-600'
                                                        : 'text-red-500'"
                                                    x-text="slot.is_open
                                                        ? slot.remaining + ' seat' + (slot.remaining === 1 ? '' : 's') + ' available'
                                                        : 'Fully booked'">
                                                </p>

                                            </div>


                                            <div
                                                class="w-9 h-9 rounded-xl flex items-center justify-center"
                                                :class="slot.is_open
                                                    ? 'bg-emerald-50 text-emerald-600'
                                                    : 'bg-red-50 text-red-500'">

                                                <svg
                                                    x-show="slot.is_open"
                                                    class="w-5 h-5"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M5 13l4 4L19 7"/>
                                                </svg>

                                                <svg
                                                    x-show="!slot.is_open"
                                                    class="w-5 h-5"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M6 18L18 6M6 6l12 12"/>
                                                </svg>

                                            </div>

                                        </div>


                                        {{-- Selected indicator --}}
                                        <div
                                            x-show="selectedSlot === slot.time && slot.is_open"
                                            class="absolute top-2 right-2">

                                            <span class="w-2 h-2 rounded-full
                                                         bg-indigo-600 block"></span>

                                        </div>

                                    </button>

                                </template>

                            </div>


                            {{-- Hidden time input --}}
                            <input
                                type="hidden"
                                name="time_slot"
                                x-model="selectedSlot"
                                required
                            >

                        </div>


                        {{-- Divider --}}
                        <div class="border-t border-slate-100"></div>


                        {{-- =================================================
                            REASON
                        ================================================== --}}
                        <div>

                            <label
                                for="reschedule_reason"
                                class="text-sm font-bold text-slate-800">

                                3. Reason for Reschedule

                            </label>

                            <p class="text-xs text-slate-400 mt-1 mb-3">
                                Explain why the original appointment needs to be changed.
                            </p>


                            <textarea
                                id="reschedule_reason"
                                name="reschedule_reason"
                                rows="4"
                                required
                                placeholder="Example: The requested time slot has reached its maximum capacity."
                                class="w-full rounded-2xl border-slate-200
                                       bg-slate-50 px-4 py-3 text-sm
                                       focus:bg-white
                                       focus:border-indigo-500
                                       focus:ring-indigo-500">{{ old('reschedule_reason') }}</textarea>


                            <div class="flex items-start gap-2 mt-2">

                                <svg class="w-4 h-4 text-slate-400 mt-0.5 shrink-0"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"/>

                                </svg>

                                <p class="text-xs text-slate-400">
                                    This reason will be visible to the student and included
                                    in the appointment rescheduling email.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        FOOTER
                    ================================================== --}}
                    <div class="px-6 py-5 bg-slate-50 border-t border-slate-200">

                        <div class="flex flex-col sm:flex-row
                                    sm:items-center sm:justify-between gap-4">

                            <div class="flex items-start gap-3">

                                <div class="w-9 h-9 rounded-xl bg-amber-50
                                            flex items-center justify-center shrink-0">

                                    <svg class="w-5 h-5 text-amber-600"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M12 9v2m0 4h.01M10.29 3.86l-7.82 14a1 1 0 00.87 1.5h17.32a1 1 0 00.87-1.5l-7.82-14a1 1 0 00-1.74 0z"/>

                                    </svg>

                                </div>

                                <div>
                                    <p class="text-sm font-bold text-slate-700">
                                        Student notification
                                    </p>

                                    <p class="text-xs text-slate-400 mt-0.5">
                                        The student will receive an email after the
                                        reschedule is confirmed.
                                    </p>
                                </div>

                            </div>


                            <div class="flex items-center gap-3">

                                <a
                                    href="{{ route('registrar.appointments.show', $appointment) }}"
                                    class="px-5 py-2.5 bg-white border border-slate-200
                                           text-slate-600 text-sm font-bold rounded-xl
                                           hover:bg-slate-100 transition">

                                    Cancel

                                </a>


                                <button
                                    type="submit"
                                    class="inline-flex items-center justify-center
                                           gap-2 px-6 py-2.5
                                           bg-indigo-700 text-white
                                           text-sm font-bold rounded-xl
                                           hover:bg-indigo-800
                                           shadow-sm hover:shadow-md
                                           transition">

                                    <svg class="w-4 h-4"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M3 10h10a4 4 0 014 4v2"/>
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M7 6l-4 4 4 4"/>

                                    </svg>

                                    Save &amp; Notify Student

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>
    </div>
</x-app-layout>