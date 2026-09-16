<x-app-layout>
    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center max-w-2xl mx-auto">
                <p class="text-xs font-bold uppercase tracking-widest text-blue-700">New Request</p>
                <h1 class="mt-2 text-2xl sm:text-3xl font-extrabold text-gray-900">What do you need today?</h1>
                <p class="mt-3 text-sm text-gray-500">
                    Choose how you want to transact with the university. Your request will be
                    tracked under <strong>My Appointments</strong> or <strong>My Requests</strong>.
                </p>
            </div>

            <div class="mt-10 grid md:grid-cols-2 gap-6">

                {{-- Option A: Book Appointment --}}
                <a href="{{ route('student.appointments.create') }}"
                   class="group bg-white rounded-2xl border-2 border-gray-100 shadow-sm p-8 hover:border-blue-300 hover:shadow-lg transition relative overflow-hidden">
                    <div class="absolute -top-16 -right-16 w-48 h-48 bg-blue-50 rounded-full blur-2xl pointer-events-none group-hover:bg-blue-100 transition"></div>

                    <div class="relative w-14 h-14 bg-blue-800 text-white rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>

                    <h2 class="relative mt-6 text-xl font-extrabold text-gray-900">Book an Appointment</h2>
                    <p class="relative mt-2 text-sm text-gray-500 leading-relaxed">
                        Schedule a visit with OSAS, Registrar, Guidance, Cashier, Accounting,
                        or the Admin office. Pick a purpose, date, and an available time slot.
                    </p>

                    <ul class="relative mt-5 space-y-2 text-xs text-gray-500">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Live slot availability indicator
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Cancel anytime
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Tracked under My Appointments
                        </li>
                    </ul>

                    <div class="relative mt-7 inline-flex items-center gap-2 text-sm font-bold text-blue-800 group-hover:gap-3 transition-all">
                        Book Now
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </div>
                </a>

                {{-- Option B: Request Document --}}
                <a href="{{ route('student.documents.create') }}"
                   class="group bg-white rounded-2xl border-2 border-gray-100 shadow-sm p-8 hover:border-blue-300 hover:shadow-lg transition relative overflow-hidden">
                    <div class="absolute -top-16 -right-16 w-48 h-48 bg-yellow-50 rounded-full blur-2xl pointer-events-none group-hover:bg-yellow-100 transition"></div>

                    <div class="relative w-14 h-14 bg-yellow-400 text-blue-950 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 6.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>

                    <h2 class="relative mt-6 text-xl font-extrabold text-gray-900">Request a Document</h2>
                    <p class="relative mt-2 text-sm text-gray-500 leading-relaxed">
                        Request TOR, Good Moral, Certificate of Enrollment, Clearance, and other
                        institutional documents with required attachments.
                    </p>

                    <ul class="relative mt-5 space-y-2 text-xs text-gray-500">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Upload attachments up to 3 files
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Tracked under My Requests
                        </li>
                    </ul>

                    <div class="relative mt-7 inline-flex items-center gap-2 text-sm font-bold text-blue-800 group-hover:gap-3 transition-all">
                        Request Now
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </div>
                </a>

            </div>

            {{-- Recent activity hint --}}
            <div class="mt-8 bg-blue-50 border border-blue-100 rounded-2xl px-5 py-4 flex flex-col sm:flex-row sm:items-center gap-3 text-sm">
                <svg class="w-5 h-5 text-blue-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-blue-800">
                    Already submitted something? Track it under
                    <a href="{{ route('student.documents.index') }}" class="font-bold underline hover:text-blue-950">My Requests</a>
                    or
                    <a href="{{ route('student.appointments.index') }}" class="font-bold underline hover:text-blue-950">My Appointments</a>.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>