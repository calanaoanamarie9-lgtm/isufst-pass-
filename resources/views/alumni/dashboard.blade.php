<x-app-layout>
    @php
        $user = Auth::user();
    @endphp

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Welcome Banner --}}
            <div class="bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 overflow-hidden relative">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-blue-700/40 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative">
                    <p class="text-xs font-semibold uppercase tracking-widest text-yellow-400">
                        Alumni Dashboard
                    </p>
                    <h1 class="mt-2 text-2xl sm:text-3xl font-extrabold text-white">
                        Welcome, {{ $user->name }}!
                    </h1>
                    <p class="mt-2 text-sm text-blue-200 max-w-lg">
                        Stay connected with ISUFSTPASS — book office visits, request documents, and manage your alumni pass from here.
                    </p>
                </div>
                <div class="relative shrink-0">
                    <a href="{{ route('alumni.documents.new') }}"
                       class="inline-flex items-center justify-center px-6 py-3 bg-yellow-400 text-blue-950 font-bold rounded-xl hover:bg-yellow-300 transition shadow-lg">
                        New Request
                    </a>
                </div>
            </div>

            @if ($bannerEnabled && $bannerText)
                <div class="mt-6 rounded-2xl border border-yellow-300 bg-yellow-50 px-5 py-4 text-sm text-yellow-800 flex items-start gap-3">
                    <span class="text-base leading-none mt-0.5">📢</span>
                    <p>{{ $bannerText }}</p>
                </div>
            @endif

            {{-- Stats --}}
            <div class="mt-8 grid grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 6.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-2xl font-black text-gray-900">{{ $activeDocumentRequests }}</p>
                    <p class="text-sm text-gray-500">Active Document Requests</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="w-11 h-11 bg-green-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-2xl font-black text-gray-900">{{ $upcomingAppointments }}</p>
                    <p class="text-sm text-gray-500">Upcoming Appointments</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="w-11 h-11 bg-yellow-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-2xl font-black text-gray-900">{{ $completedTransactions }}</p>
                    <p class="text-sm text-gray-500">Completed Transactions</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="w-11 h-11 bg-indigo-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-3-3H8a3 3 0 00-3 3v2h3m7-5v6m2-10a3 3 0 11-6 0 3 3 0 016 0zm3-8h5m-9 4h-5"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-2xl font-black text-gray-900">{{ $hasPass ? 'Active' : 'Inactive' }}</p>
                    <p class="text-sm text-gray-500">Alumni Pass</p>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <a href="{{ route('alumni.appointments.index') }}"
                   class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex items-center gap-4 hover:border-blue-300 hover:shadow-md transition">
                    <div class="w-11 h-11 bg-green-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">My Appointments</p>
                        <p class="text-xs text-gray-500 mt-0.5">Manage upcoming office visits</p>
                    </div>
                </a>

                <a href="{{ route('alumni.documents.index') }}"
                   class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex items-center gap-4 hover:border-blue-300 hover:shadow-md transition">
                    <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 6.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">My Requests</p>
                        <p class="text-xs text-gray-500 mt-0.5">Track document request status</p>
                    </div>
                </a>

                <a href="{{ route('alumni.pass.show') }}"
                   class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex items-center gap-4 hover:border-blue-300 hover:shadow-md transition">
                    <div class="w-11 h-11 bg-indigo-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-3-3H8a3 3 0 00-3 3v2h3m7-5v6m2-10a3 3 0 11-6 0 3 3 0 016 0zm3-8h5m-9 4h-5"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">My Alumni Pass</p>
                        <p class="text-xs text-gray-500 mt-0.5">Show your QR ID at the gate</p>
                    </div>
                </a>

                <a href="{{ route('alumni.profile.show') }}"
                   class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex items-center gap-4 hover:border-blue-300 hover:shadow-md transition">
                    <div class="w-11 h-11 bg-yellow-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">My Profile</p>
                        <p class="text-xs text-gray-500 mt-0.5">Update alumni info &amp; credentials</p>
                    </div>
                </a>
            </div>

            {{-- Recent Activity --}}
            <div class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="font-bold text-gray-900">Recent Activity</h2>
                    <a href="{{ route('alumni.documents.index') }}" class="text-sm font-semibold text-blue-700 hover:text-blue-900">View all</a>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse ($recentActivity as $activity)
                        <div class="px-6 py-4 flex items-center gap-4">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center {{ $activity['type'] === 'appointment' ? 'bg-green-50' : 'bg-blue-50' }}">
                                <svg class="w-5 h-5 {{ $activity['type'] === 'appointment' ? 'text-green-600' : 'text-blue-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if ($activity['type'] === 'appointment')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 6.707V19a2 2 0 01-2 2z"/>
                                    @endif
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold text-gray-800 truncate">{{ $activity['title'] }}</p>
                                <p class="text-xs text-gray-400">{{ $activity['date'] }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $activity['badge']['class'] }}">{{ $activity['badge']['label'] }}</span>
                        </div>
                    @empty
                        <div class="px-6 py-10 text-center text-sm text-gray-400">No recent activity yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
