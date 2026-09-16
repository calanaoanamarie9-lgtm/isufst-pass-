<x-app-layout>
    @php
        $user = Auth::user();
    @endphp

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Welcome --}}
            <div class="bg-gradient-to-br from-[#12347d] via-[#1d4ed8] to-[#3b82f6] rounded-2xl p-6 sm:p-8 relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative">
                    <p class="text-xs font-semibold uppercase tracking-widest text-yellow-400">Parent / Guardian Portal</p>
                    <h1 class="mt-2 text-2xl sm:text-3xl font-extrabold text-white">Welcome back, {{ $user->name }}!</h1>
                    <p class="mt-2 text-sm text-blue-200 max-w-lg">
                        Book office visits and track your child's appointments from this parent portal.
                    </p>
                </div>
            </div>

            {{-- Stats --}}
            <div class="mt-8 grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <p class="text-2xl font-black text-gray-900">{{ $upcomingAppointments }}</p>
                    <p class="text-sm text-gray-500 mt-1">Upcoming Visits</p>
                </div>
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <p class="text-2xl font-black text-gray-900">{{ $completedAppointments }}</p>
                    <p class="text-sm text-gray-500 mt-1">Completed Visits</p>
                </div>
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <p class="text-2xl font-black text-gray-900">{{ $hasPass ? 'Active' : '—' }}</p>
                    <p class="text-sm text-gray-500 mt-1">Child Pass</p>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="{{ route('student.appointments.create') }}"
                   class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:border-blue-300 hover:shadow-md transition">
                    <p class="font-bold text-gray-900">Book a Visit</p>
                    <p class="text-xs text-gray-500 mt-0.5">Schedule an office appointment for your child</p>
                </a>
                <a href="{{ route('student.appointments.index') }}"
                   class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:border-blue-300 hover:shadow-md transition">
                    <p class="font-bold text-gray-900">Upcoming Appointments</p>
                    <p class="text-xs text-gray-500 mt-0.5">View and manage your scheduled office visits</p>
                </a>
            </div>

            {{-- Recent Activity --}}
            <div class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="font-bold text-gray-900">Recent Activity</h2>
                    <a href="{{ route('student.appointments.index') }}" class="text-sm font-semibold text-blue-700 hover:text-blue-900">View all</a>
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
                            <div>
                                <p class="text-sm font-semibold text-gray-800">{{ $activity['title'] }}</p>
                                <p class="text-xs text-gray-400">{{ $activity['date']->diffForHumans() ?? $activity['date'] }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-10 text-center text-sm text-gray-400">No recent activity yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
