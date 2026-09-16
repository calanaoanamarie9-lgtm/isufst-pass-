<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900">{{ $office }} Department Dashboard</h1>
                <p class="text-sm text-gray-500 mt-1">Overview of appointments and activities for the {{ $office }} office.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <p class="text-sm text-gray-500">Total Appointments</p>
                    <p class="text-3xl font-black text-gray-900 mt-1">{{ $appointments->total() }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <p class="text-sm text-gray-500">Office</p>
                    <p class="text-3xl font-black text-blue-700 mt-1">{{ $office }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <p class="text-sm text-gray-500">Quick Actions</p>
                    <div class="mt-2 flex gap-2">
                        <a href="{{ route('cbmsd.appointments') }}" class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-bold rounded-lg hover:bg-blue-100 transition">Appointments</a>
                        <a href="{{ route('cbmsd.availability') }}" class="px-3 py-1.5 bg-green-50 text-green-700 text-xs font-bold rounded-lg hover:bg-green-100 transition">Availability</a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-bold text-gray-900">Recent Appointments</h2>
                </div>
                @forelse ($appointments as $appointment)
                    <div class="px-5 py-4 border-b border-gray-50 last:border-0">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-blue-50 flex items-center justify-center text-blue-700 font-bold text-xs">
                                {{ strtoupper(substr($appointment->user->name, 0, 2)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-900 text-sm">{{ $appointment->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $appointment->purpose }} &middot; {{ $appointment->date->format('M j, Y') }} &middot; {{ $appointment->time_slot }}</p>
                            </div>
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ match($appointment->status) {
                                'pending' => 'bg-yellow-50 text-yellow-700',
                                'confirmed' => 'bg-green-50 text-green-700',
                                'completed' => 'bg-blue-50 text-blue-700',
                                default => 'bg-gray-50 text-gray-500',
                            } }}">{{ ucfirst($appointment->status) }}</span>
                        </div>
                    </div>
                @empty
                    <div class="px-5 py-12 text-center text-sm text-gray-400">No appointments yet.</div>
                @endforelse
            </div>

            <div class="mt-6">{{ $appointments->links() }}</div>
        </div>
    </div>
</x-app-layout>
