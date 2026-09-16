{{-- Self-contained Reschedule Appointment modal. --}}
{{-- Open via: $dispatch('open-reschedule', { id, student, reference, office, dateLabel, timeSlot }) --}}

<style>[x-cloak]{display:none!important}</style>

<div
    x-data="rescheduleModal()"
    @open-reschedule.window="start($event.detail)"
    x-cloak
    class="fixed inset-0 z-50"
    x-show="open"
    style="display: none"
>


    {{-- BACKDROP --}}
    <div
        x-show="open"
        x-transition.opacity.duration.200ms
        @click="if (!busy) close()"
        class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"
    ></div>


    {{-- PANEL --}}
    <div class="absolute inset-0 flex justify-center p-4 overflow-y-auto">

        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            class="relative w-full max-w-lg bg-white rounded-2xl shadow-2xl m-auto"
        >


            {{-- HEADER --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">

                <div>
                    <h2 class="text-xl font-bold text-slate-900">
                        Reschedule Appointment
                    </h2>

                    <p class="text-xs text-gray-500 mt-0.5">
                        Pick a new date and an open time slot for the student.
                    </p>
                </div>


                <button
                    type="button"
                    @click="if (!busy) close()"
                    class="w-9 h-9 rounded-lg text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition flex items-center justify-center"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

            </div>




            {{-- BODY --}}
            <form @submit.prevent="submit()" class="px-6 py-5 space-y-5">


                {{-- STUDENT --}}
                <div class="flex items-center gap-3 rounded-xl bg-blue-50 border border-blue-100 px-4 py-3">

                    <div class="w-10 h-10 rounded-full bg-blue-700 text-white flex items-center justify-center font-bold shrink-0">
                        <span x-text="(appointment?.student || '?').charAt(0)"></span>
                    </div>


                    <div class="min-w-0">
                        <p class="text-xs font-bold uppercase tracking-wide text-blue-500">Student</p>

                        <p class="font-bold text-slate-900 truncate" x-text="appointment?.student"></p>

                        <p class="text-xs text-gray-500">
                            <span x-text="appointment?.studentId ? 'Student ID: ' + appointment.studentId : appointment?.reference"></span>
                            <span x-show="appointment?.studentId" x-text="'  ·  ' + appointment?.reference"></span>
                        </p>
                    </div>

                </div>




                {{-- CURRENT SCHEDULE --}}
                <div class="rounded-xl bg-slate-50 border border-slate-200 px-4 py-3">

                    <p class="text-xs font-bold uppercase tracking-wide text-gray-400 mb-1">
                        Current Schedule
                    </p>


                    <div class="flex items-center gap-2 text-sm text-slate-800">

                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>


                        <span class="font-semibold" x-text="appointment?.dateLabel"></span>

                        <span class="text-slate-300">|</span>

                        <span x-text="appointment?.timeSlot"></span>

                        <template x-if="appointment?.office">

                            <span class="ml-auto inline-flex px-2 py-0.5 rounded-full bg-white border border-slate-200 text-[10px] font-bold text-slate-500"
                                  x-text="appointment?.office"></span>

                        </template>

                    </div>

                </div>




                {{-- REASON --}}
                <div x-show="appointment?.reason" class="rounded-xl bg-amber-50 border border-amber-200 px-4 py-3">

                    <p class="text-xs font-bold uppercase tracking-wide text-amber-600 mb-1">
                        Reason for Rescheduling
                    </p>

                    <p class="text-sm text-slate-700" x-text="appointment?.reason || ''"></p>

                </div>




                {{-- NEW DATE --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                        New Date
                    </label>


                    <input
                        type="date"
                        x-model="newDate"
                        min="{{ now()->toDateString() }}"
                        @change="loadSlots()"
                        class="w-full h-11 rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                    >

                </div>




                {{-- NEW TIME --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                        New Time
                    </label>


                    <select
                        x-model="timeSlot"
                        :disabled="!newDate || loadingSlots || slots.length === 0"
                        class="w-full h-11 rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm disabled:bg-slate-50 disabled:text-gray-400"
                    >


                        <option value="" disabled>
                            <span x-text="timePlaceholder"></span>
                        </option>


                        <template x-for="slot in slots" :key="slot.time">

                            <option :value="slot.time"
                                    x-text="slot.time + '  ·  ' + slot.remaining + (slot.remaining === 1 ? ' seat left' : ' seats left')"
                                    :selected="slot.time === timeSlot"
                            ></option>

                        </template>

                    </select>


                    <p x-show="slotError" x-text="slotError" class="mt-1.5 text-xs text-red-600"></p>

                </div>




                {{-- REASON --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Reason
                    </label>


                    <textarea
                        x-model="reason"
                        rows="3"
                        maxlength="500"
                        required
                        placeholder="Explain why this appointment is being rescheduled…"
                        class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm resize-none"
                    ></textarea>
                </div>




                {{-- ERROR BOX --}}
                <div x-show="formError" x-transition class="rounded-xl bg-red-50 border border-red-200 px-4 py-3">
                    <p class="text-sm font-medium text-red-700" x-text="formError"></p>
                </div>




                {{-- BUTTONS --}}
                <div class="flex items-center justify-end gap-3 pt-1">

                    <button
                        type="button"
                        @click="close()"
                        :disabled="busy"
                        class="px-5 py-2.5 rounded-xl bg-white border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition disabled:opacity-50"
                    >
                        Cancel
                    </button>


                    <button
                        type="submit"
                        :disabled="busy || !newDate || !timeSlot || !reason.trim()"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-bold hover:bg-indigo-700 transition shadow-sm disabled:opacity-50 disabled:cursor-not-allowed"
                    >

                        <svg x-show="busy" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                        </svg>


                        <span x-text="busy ? 'Rescheduling…' : 'Confirm Reschedule'"></span>

                    </button>

                </div>


            </form>

        </div>

    </div>

</div>




<script>

function rescheduleModal() {

    return {

        open: false,
        busy: false,

        appointment: null,

        newDate: '',
        timeSlot: '',
        reason: '',

        slots: [],
        loadingSlots: false,
        slotError: '',
        formError: '',

        slotsUrl: '{{ route('registrar.appointments.slots') }}',

        actionTemplate: '{{ url('registrar/appointments') }}/:id/reschedule',


        get timePlaceholder() {

            if (!this.newDate) return 'Pick a date first';

            if (this.loadingSlots) return 'Loading available slots…';

            if (this.slots.length === 0) return 'No open slots on this date';

            return 'Select a time slot';

        },



        start(detail) {

            this.appointment = detail;

            this.newDate = '';

            this.timeSlot = '';

            this.reason = '';

            this.slots = [];

            this.slotError = '';

            this.formError = '';

            this.open = true;

        },


        close() {

            if (this.busy) return;

            this.open = false;

        },


        loadSlots() {

            if (!this.newDate || !this.appointment) {
                return;
            }

            this.loadingSlots = true;

            this.slotError = '';

            this.timeSlot = '';


            const url = this.slotsUrl
                + '?office=' + encodeURIComponent(this.appointment.office)
                + '&date=' + this.newDate
                + '&ignore_id=' + this.appointment.id;


            fetch(url, { headers: { 'Accept': 'application/json' } })

                .then((response) => response.json())

                .then((data) => {

                    this.slots = data.filter((slot) => slot.is_open && slot.remaining > 0);

                    if (this.slots.length === 0) {

                        this.slotError = 'No open time slots on this date. Try another date or the next day with availability.';

                    }


                    this.loadingSlots = false;

                })

                .catch(() => {

                    this.loadingSlots = false;

                    this.slotError = 'Could not load time slots. Please try again.';

                });

        },



        submit() {

            if (!this.appointment || this.busy) {
                return;
            }

            this.busy = true;

            this.formError = '';


            fetch(this.actionTemplate.replace(':id', this.appointment.id), {

                method: 'PUT',

                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },

                body: JSON.stringify({
                    date: this.newDate,
                    time_slot: this.timeSlot,
                    reschedule_reason: this.reason.trim(),
                })

            })

                .then(async (response) => {

                    const data = await response.json().catch(() => ({}));


                    if (!response.ok) {

                        this.busy = false;

                        this.formError = data.errors
                            ? Object.values(data.errors)[0][0]
                            : (data.message || 'Could not reschedule the appointment.');

                        return;

                    }


                    window.location.href = data.redirect;

                })

                .catch(() => {

                    this.busy = false;

                    this.formError = 'Network error. Please try again.';

                });

        }

    }

}

</script>
