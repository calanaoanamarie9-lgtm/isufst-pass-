<x-app-layout>

<div
    x-data="availabilityManager()"
    class="min-h-screen bg-slate-50 px-6 py-8"
>

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-slate-900">
            Availability Schedule
        </h1>

        <p class="mt-2 text-lg text-slate-500">
            Set which dates and time slots are open for Registrar's Office.
            Students can only book slots marked as available.
        </p>
    </div>


    {{-- MAIN GRID --}}
    <div class="grid grid-cols-1 gap-8 xl:grid-cols-[460px_1fr]">


        {{-- ===================================================== --}}
        {{-- LEFT: SET AVAILABILITY --}}
        {{-- ===================================================== --}}

        <div x-ref="form" class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="p-8">

                <h2 class="text-2xl font-bold text-slate-900">
                    Set Availability
                </h2>

                <p class="mt-4 text-base leading-7 text-slate-500">
                    Fully booked dates are still counted automatically
                    based on existing bookings.
                </p>


                {{-- DATE --}}
                <div class="mt-8">

                    <label class="mb-2 block text-base font-medium text-slate-700">
                        Date
                    </label>

                    <div class="relative">

                        <input
                            type="date"
                            x-model="date"
                            min="{{ now()->toDateString() }}"
                            @change="loadSelectedDate()"
                            class="h-14 w-full rounded-xl border border-slate-300 bg-white px-5 pr-12 text-base text-slate-800 outline-none transition focus:border-blue-600 focus:ring-2 focus:ring-blue-100"
                        >

                    </div>

                </div>


                {{-- AVAILABILITY OPTIONS --}}
                <div class="mt-7 space-y-5">

                    {{-- OPEN ENTIRE DAY --}}
                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="radio"
                            name="availability_type"
                            value="open"
                            x-model="availabilityType"
                            class="h-6 w-6 border-slate-300 text-blue-600 focus:ring-blue-500"
                        >

                        <span class="text-lg text-slate-700">
                            Open the entire day
                        </span>

                    </label>


                    {{-- CLOSE ENTIRE DAY --}}
                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="radio"
                            name="availability_type"
                            value="closed"
                            x-model="availabilityType"
                            class="h-6 w-6 border-slate-300 text-blue-600 focus:ring-blue-500"
                        >

                        <span class="text-lg text-slate-700">
                            Close the entire day
                        </span>

                    </label>


                    {{-- SPECIFIC TIME SLOTS --}}
                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="radio"
                            name="availability_type"
                            value="slots"
                            x-model="availabilityType"
                            class="h-6 w-6 border-slate-300 text-blue-600 focus:ring-blue-500"
                        >

                        <span class="text-lg text-slate-700">
                            Set specific time slots
                        </span>

                    </label>

                </div>


                {{-- TIME SLOTS (official appointment slots) --}}
                <div
                    x-show="availabilityType === 'slots'"
                    x-transition
                    class="mt-7 rounded-xl border border-slate-200 bg-slate-50 p-5"
                >

                    <div class="mb-4 flex items-center justify-between">

                        <h3 class="font-semibold text-slate-900">
                            Available Time Slots
                        </h3>

                        <span class="text-xs font-medium text-slate-400">
                            {{ count($timeSlots) }} official slots
                        </span>

                    </div>


                    {{-- QUICK SET: open only the first N slots --}}
                    <div class="mb-4 flex items-center gap-3 rounded-lg border border-blue-100 bg-blue-50 px-4 py-3">

                        <span class="text-sm font-medium text-slate-600">
                            Open only the first
                        </span>

                        <input
                            type="number"
                            min="0"
                            max="{{ count($timeSlots) }}"
                            x-model.number="slotCount"
                            @change="applySlotCount()"
                            class="h-10 w-20 rounded-lg border border-slate-300 bg-white px-3 text-center text-sm font-bold text-slate-800 focus:border-blue-600 focus:ring-2 focus:ring-blue-100"
                        >

                        <span class="text-sm font-medium text-slate-600">
                            slot(s) of the day
                        </span>

                    </div>


                    <div class="max-h-72 space-y-3 overflow-y-auto pr-1">

                        @foreach ($timeSlots as $slot)

                            <label class="flex cursor-pointer items-center gap-3 rounded-lg border border-slate-200 bg-white px-4 py-3 transition hover:border-blue-300">

                                <input
                                    type="checkbox"
                                    value="{{ $slot }}"
                                    x-model="selectedSlots"
                                    class="h-5 w-5 shrink-0 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                >

                                <span class="text-sm font-medium text-slate-700">
                                    {{ $slot }}
                                </span>

                            </label>


                        @endforeach

                    </div>

                </div>


                {{-- LIVE PREVIEW --}}
                <p class="mt-6 text-center text-sm font-semibold text-slate-500">
                    <span class="text-blue-700" x-text="openPreview()"></span>
                    <span x-text="openPreview() === 1 ? 'slot' : 'slots'"></span>
                    will be open on the selected date.
                </p>


                {{-- SAVE --}}
                <button
                    type="button"
                    @click="saveAvailability()"
                    class="mt-3 flex h-14 w-full items-center justify-center rounded-xl bg-blue-600 px-6 text-lg font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100"
                >
                    Save Availability
                </button>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- RIGHT: SCHEDULE --}}
        {{-- ===================================================== --}}

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- SCHEDULE HEADER --}}
            <div class="flex items-center justify-between border-b border-slate-200 px-8 py-7">

                <h2 class="text-2xl font-bold text-slate-900">
                    Schedule
                </h2>

                <span class="text-xs font-medium text-slate-400">
                    Click a date to edit it
                </span>

            </div>


            {{-- SCHEDULE CONTENT --}}
            <div class="min-h-[470px] p-8">


                {{-- EMPTY STATE --}}
                <template x-if="schedule.length === 0">

                    <div class="flex min-h-[400px] flex-col items-center justify-center text-center">

                        {{-- CALENDAR ICON --}}
                        <div class="mb-6 text-slate-300">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-16 w-16"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <rect
                                    x="3"
                                    y="4"
                                    width="18"
                                    height="17"
                                    rx="2"
                                />

                                <path
                                    stroke-linecap="round"
                                    d="M16 2v4M8 2v4M3 10h18"
                                />

                            </svg>

                        </div>


                        <p class="text-xl text-slate-500">
                            No schedule set. All dates and time slots are
                            available unless fully booked.
                        </p>

                    </div>

                </template>


                {{-- SCHEDULE LIST --}}
                <template x-if="schedule.length > 0">

                    <div class="space-y-5">

                        <template
                            x-for="item in schedule"
                            :key="item.id"
                        >

                            <div
                                @click="editItem(item)"
                                class="cursor-pointer rounded-xl border border-slate-200 bg-slate-50 p-5 transition hover:border-blue-400 hover:bg-blue-50/40"
                            >

                                <div class="flex items-center justify-between">

                                    <div>

                                        <p
                                            class="text-lg font-bold text-slate-900"
                                            x-text="item.date"
                                        ></p>

                                        <p
                                            class="mt-1 text-sm text-slate-500"
                                            x-text="item.status"
                                        ></p>

                                    </div>


                                    <span
                                        class="rounded-full px-3 py-1 text-sm font-semibold"
                                        :class="{
                                            'bg-green-100 text-green-700': item.type === 'open',
                                            'bg-red-100 text-red-700': item.type === 'closed',
                                            'bg-blue-100 text-blue-700': item.type === 'slots'
                                        }"
                                        x-text="item.typeLabel"
                                    ></span>

                                </div>


                                {{-- SLOTS --}}
                                <template x-if="item.type === 'slots'">

                                    <div class="mt-5 grid gap-3 sm:grid-cols-2">

                                        <template
                                            x-for="slot in item.slots"
                                            :key="slot.start"
                                        >

                                            <div class="flex items-center justify-between rounded-lg border border-slate-200 bg-white px-4 py-3">

                                                <span
                                                    class="font-medium text-slate-700"
                                                    x-text="slot.start"
                                                ></span>

                                                <span class="text-sm font-semibold text-green-600">
                                                    Available
                                                </span>

                                            </div>

                                        </template>

                                    </div>

                                </template>

                            </div>

                        </template>

                    </div>

                </template>

            </div>

        </div>

    </div>

</div>



{{-- ============================================================= --}}
{{-- ALPINE JS --}}
{{-- ============================================================= --}}

<script>

function availabilityManager() {

    return {

        date: '',

        availabilityType: 'closed',

        selectedSlots: [],

        slotCount: 8,

        schedule: @json($schedule),

        timeSlots: @json($timeSlots),

        settingsUrl: '{{ route('registrar.availability.settings', ['date' => ':date']) }}',

        saveUrl: '{{ route('registrar.availability.save') }}',


        applySlotCount() {

            const max = this.timeSlots.length;

            let n = parseInt(this.slotCount);

            if (isNaN(n) || n < 0) {
                n = 0;
            }

            if (n > max) {
                n = max;
                this.slotCount = max;
            }


            this.selectedSlots = this.timeSlots.slice(0, n);

        },


        openPreview() {

            if (this.availabilityType === 'open') {
                return this.timeSlots.length;
            }

            if (this.availabilityType === 'closed') {
                return 0;
            }

            return this.selectedSlots.length;

        },



        editItem(item) {

            this.date = item.id;

            this.loadSelectedDate();

            this.$refs.form.scrollIntoView({ behavior: 'smooth', block: 'start' });

        },


        loadSelectedDate() {

            if (!this.date) {
                return;
            }


            fetch(this.settingsUrl.replace(':date', this.date), {
                headers: { 'Accept': 'application/json' }
            })

                .then((response) => response.json())

                .then((data) => {

                    this.availabilityType = data.type;

                    this.selectedSlots = data.slots || [];

                    this.slotCount = this.availabilityType === 'open'
                        ? this.timeSlots.length
                        : (this.availabilityType === 'closed' ? 0 : this.selectedSlots.length);

                });

        },


        async saveAvailability() {

            if (!this.date) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Date Required',
                    text: 'Please select a date first.',
                    confirmButtonColor: '#2563eb'
                });

                return;

            }


            if (
                this.availabilityType === 'slots'
                &&
                this.selectedSlots.length === 0
            ) {

                Swal.fire({
                    icon: 'warning',
                    title: 'No Time Slots',
                    text: 'Please select at least one time slot.',
                    confirmButtonColor: '#2563eb'
                });

                return;

            }


            const response = await fetch(this.saveUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    date: this.date,
                    type: this.availabilityType,
                    slots: this.selectedSlots
                })
            });


            const data = await response.json();


            if (!response.ok) {

                const message = data.errors
                    ? Object.values(data.errors)[0][0]
                    : (data.message || 'Something went wrong.');


                Swal.fire({
                    icon: 'error',
                    title: 'Not Saved',
                    text: message,
                    confirmButtonColor: '#2563eb'
                });

                return;

            }


            this.schedule = data.schedule;


            Swal.fire({
                icon: 'success',
                title: 'Availability Saved!',
                text: data.message,
                confirmButtonColor: '#2563eb'
            });

        }

    }

}

</script>

</x-app-layout>
