<x-app-layout>
    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900">{{ $office }} Appointments</h1>
                <p class="text-sm text-gray-500 mt-1">Manage student appointments for the {{ $office }} department.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="font-bold text-gray-900">Appointment List</h2>
                    <span class="text-sm text-gray-400">{{ $appointments->total() }} total</span>
                </div>

                <div class="divide-y divide-gray-50">
                    @forelse ($appointments as $appointment)
                        <div class="px-5 py-4 flex items-center gap-3 hover:bg-blue-50/30 transition">
                            <div class="w-9 h-9 rounded-full bg-blue-50 flex items-center justify-center text-blue-700 font-bold text-xs shrink-0">
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
                    @empty
                        <div class="px-5 py-12 text-center text-sm text-gray-400">No appointments for {{ $office }} yet.</div>
                    @endforelse
                </div>
            </div>

            <div class="mt-6">{{ $appointments->links() }}</div>
        </div>
    </div>
</x-app-layout>
