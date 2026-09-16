<x-app-layout>

    <div class="min-h-screen bg-[#f5f7fb] py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- =========================================================
                PAGE HEADER
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm mb-6">

                <div class="px-6 py-5 flex flex-col sm:flex-row
                            sm:items-center sm:justify-between gap-4">

                    <div class="flex items-center gap-4">

                        {{-- Icon --}}
                        <div class="w-11 h-11 rounded-xl
                                    bg-blue-50 flex items-center justify-center">

                            <svg class="w-6 h-6 text-blue-700"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"/>

                            </svg>

                        </div>

                        <div>

                            <h1 class="text-xl sm:text-2xl font-extrabold
                                       text-[#102d5b]">

                                Master Logs & Audits

                            </h1>

                            <p class="text-sm text-gray-500 mt-0.5">

                                System-wide audit trails and administrative activity.

                            </p>

                        </div>

                    </div>


                    {{-- Security Status --}}
                    <div class="inline-flex items-center gap-2
                                px-3 py-2 rounded-xl
                                bg-green-50 border border-green-100
                                w-fit">

                        <span class="w-2 h-2 rounded-full bg-green-500"></span>

                        <span class="text-xs font-bold text-green-700">
                            Audit Logging Active
                        </span>

                    </div>

                </div>

                {{-- Blue Line --}}
                <div class="h-1 bg-[#063b91]"></div>

            </div>


            {{-- =========================================================
                FILTERS
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-200
                        shadow-sm mb-6">

                <div class="px-5 py-4 border-b border-gray-100">

                    <div class="flex items-center gap-2">

                        <svg class="w-5 h-5 text-blue-700"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 12.414V19a1 1 0 01-.553.894l-4 2A1 1 0 019 21v-8.586L3.293 6.707A1 1 0 013 6V4z"/>

                        </svg>

                        <h2 class="text-sm font-bold text-gray-800">
                            Filter Audit Logs
                        </h2>

                    </div>

                </div>


                <form method="GET"
                      action="{{ route('admin.audits.index') }}"
                      class="p-5">

                    <div class="grid grid-cols-1 md:grid-cols-2
                                lg:grid-cols-5 gap-4">


                        {{-- Search --}}
                        <div class="lg:col-span-2">

                            <label class="block text-xs font-bold
                                          uppercase tracking-wide
                                          text-gray-500 mb-1.5">

                                Search

                            </label>

                            <div class="relative">

                                <svg class="absolute left-3 top-1/2
                                            -translate-y-1/2
                                            w-4 h-4 text-gray-400"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"/>

                                </svg>

                                <input type="text"
                                       name="q"
                                       value="{{ $search }}"
                                       placeholder="Search actor, role, or description"

                                       class="w-full pl-9 pr-3 py-2.5
                                              rounded-xl
                                              border-gray-300
                                              text-sm
                                              focus:border-blue-500
                                              focus:ring-blue-500">

                            </div>

                        </div>


                        {{-- Action --}}
                        <div>

                            <label class="block text-xs font-bold
                                          uppercase tracking-wide
                                          text-gray-500 mb-1.5">

                                Action

                            </label>

                            <select name="action"
                                    onchange="this.form.submit()"

                                    class="w-full rounded-xl
                                           border-gray-300
                                           text-sm
                                           focus:border-blue-500
                                           focus:ring-blue-500">

                                <option value="">
                                    All Actions
                                </option>

                                @foreach ($actions as $action)

                                    <option value="{{ $action }}"
                                            @selected($actionFilter === $action)>

                                        {{ $action }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- From --}}
                        <div>

                            <label class="block text-xs font-bold
                                          uppercase tracking-wide
                                          text-gray-500 mb-1.5">

                                From

                            </label>

                            <input type="date"
                                   name="from"
                                   value="{{ $from }}"

                                   class="w-full rounded-xl
                                          border-gray-300
                                          text-sm
                                          focus:border-blue-500
                                          focus:ring-blue-500">

                        </div>


                        {{-- To --}}
                        <div>

                            <label class="block text-xs font-bold
                                          uppercase tracking-wide
                                          text-gray-500 mb-1.5">

                                To

                            </label>

                            <input type="date"
                                   name="to"
                                   value="{{ $to }}"

                                   class="w-full rounded-xl
                                          border-gray-300
                                          text-sm
                                          focus:border-blue-500
                                          focus:ring-blue-500">

                        </div>

                    </div>


                    {{-- Filter Buttons --}}
                    <div class="mt-4 flex flex-wrap items-center gap-2">

                        <button type="submit"
                                class="inline-flex items-center gap-2
                                       px-5 py-2.5
                                       bg-[#063b91]
                                       hover:bg-[#052f73]
                                       text-white text-sm font-bold
                                       rounded-xl transition">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"/>

                            </svg>

                            Apply Filters

                        </button>


                        @if ($search || $actionFilter || $from || $to)

                            <a href="{{ route('admin.audits.index') }}"
                               class="px-5 py-2.5
                                      bg-gray-100
                                      hover:bg-gray-200
                                      text-gray-700
                                      text-sm font-bold
                                      rounded-xl transition">

                                Reset

                            </a>

                        @endif

                    </div>

                </form>

            </div>


            {{-- =========================================================
                AUDIT LOGS
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-200
                        shadow-sm overflow-hidden">


                {{-- Table Header --}}
                <div class="px-5 py-4
                            bg-gray-50
                            border-b border-gray-200">

                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                sm:justify-between gap-2">

                        <div>

                            <h2 class="text-sm font-extrabold
                                       text-[#102d5b]">

                                Audit Activity

                            </h2>

                            <p class="text-xs text-gray-500 mt-0.5">

                                Record of administrative actions performed in the system.

                            </p>

                        </div>

                        <div class="text-xs font-semibold text-gray-400">

                            System Audit Trail

                        </div>

                    </div>

                </div>


                {{-- Logs --}}
                @forelse ($logs as $log)

                    <div class="px-5 py-4
                                border-b border-gray-100
                                last:border-0
                                hover:bg-gray-50/70
                                transition">

                        <div class="flex flex-col lg:flex-row
                                    lg:items-center
                                    gap-4">


                            {{-- Actor --}}
                            <div class="flex items-start gap-3 flex-1 min-w-0">

                                {{-- Avatar --}}
                                <div class="w-10 h-10 shrink-0
                                            rounded-xl
                                            bg-blue-50
                                            flex items-center justify-center">

                                    <svg class="w-5 h-5 text-blue-700"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 21a8 8 0 0116 0"/>

                                    </svg>

                                </div>


                                <div class="min-w-0">

                                    <div class="flex flex-wrap
                                                items-center gap-2">

                                        <p class="text-sm font-bold
                                                  text-gray-900">

                                            {{ $log->actor_name ?? 'System' }}

                                        </p>

                                        <span class="text-[10px]
                                                     font-bold
                                                     uppercase
                                                     tracking-wide
                                                     px-2 py-0.5
                                                     rounded-md
                                                     bg-gray-100
                                                     text-gray-500">

                                            {{ $log->role ?? 'system' }}

                                        </span>

                                    </div>


                                    <p class="text-sm text-gray-600 mt-1">

                                        {{ $log->description }}

                                    </p>

                                </div>

                            </div>


                            {{-- Action --}}
                            <div class="lg:w-40">

                                <p class="text-[10px] font-bold
                                          uppercase tracking-wide
                                          text-gray-400 mb-1">

                                    Action

                                </p>

                                <span class="inline-flex
                                             px-2.5 py-1
                                             rounded-lg
                                             bg-blue-50
                                             text-blue-700
                                             border border-blue-100
                                             text-[11px]
                                             font-bold">

                                    {{ $log->action }}

                                </span>

                            </div>


                            {{-- Date --}}
                            <div class="lg:w-48 lg:text-right">

                                <p class="text-[10px] font-bold
                                          uppercase tracking-wide
                                          text-gray-400 mb-1">

                                    Date & Time

                                </p>

                                <p class="text-xs font-semibold
                                          text-gray-600">

                                    {{ $log->created_at->format('M d, Y') }}

                                </p>

                                <p class="text-[11px] text-gray-400 mt-0.5">

                                    {{ $log->created_at->format('h:i A') }}

                                </p>

                            </div>

                        </div>

                    </div>


                @empty

                    {{-- Empty State --}}
                    <div class="px-6 py-16 text-center">

                        <div class="mx-auto w-14 h-14
                                    rounded-2xl
                                    bg-blue-50
                                    flex items-center justify-center">

                            <svg class="w-7 h-7 text-blue-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"/>

                            </svg>

                        </div>


                        <h3 class="mt-4 text-sm font-bold
                                   text-gray-800">

                            No Audit Entries Found

                        </h3>


                        <p class="mt-1 text-xs text-gray-400">

                            Administrative activities will appear here
                            once actions are recorded.

                        </p>

                    </div>

                @endforelse

            </div>


            {{-- =========================================================
                PAGINATION
            ========================================================== --}}
            @if ($logs->hasPages())

                <div class="mt-5">

                    {{ $logs->links() }}

                </div>

            @endif


            {{-- =========================================================
                FOOTER INFORMATION
            ========================================================== --}}
            <div class="mt-6 bg-blue-50
                        border border-blue-100
                        rounded-2xl px-5 py-4">

                <div class="flex items-start gap-3">

                    <div class="w-9 h-9 shrink-0
                                rounded-xl
                                bg-blue-700
                                flex items-center justify-center">

                        <svg class="w-5 h-5 text-white"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 15v2m0-8v4m0-9a9 9 0 100 18 9 9 0 000-18z"/>

                        </svg>

                    </div>

                    <div>

                        <p class="text-sm font-bold text-blue-900">

                            Secure System Audit Trail

                        </p>

                        <p class="text-xs text-blue-700 mt-1">

                            Audit records help administrators monitor system
                            activity, maintain accountability, and review
                            important administrative actions.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>