<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900">{{ $office }} Availability</h1>
                <p class="text-sm text-gray-500 mt-1">Manage available dates and time slots for the {{ $office }} department.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6" x-data="availabilityManager()">
                    <h2 class="font-bold text-gray-900 mb-4">Set Availability</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wide text-gray-400 mb-1.5">Date</label>
                            <input type="date" x-model="date" :min="today"
                                   class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wide text-gray-400 mb-1.5">Status</label>
                            <div class="flex gap-3">
                                <label class="flex items-center gap-2">
                                    <input type="radio" x-model="type" value="open" class="text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm font-semibold">Open All Day</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" x-model="type" value="closed" class="text-red-600 focus:ring-red-500">
                                    <span class="text-sm font-semibold">Closed</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="radio" x-model="type" value="slots" class="text-yellow-600 focus:ring-yellow-500">
                                    <span class="text-sm font-semibold">Specific Slots</span>
                                </label>
                            </div>
                        </div>

                        <div x-show="type === 'slots'" x-transition>
                            <label class="block text-xs font-bold uppercase tracking-wide text-gray-400 mb-1.5">Select Slots</label>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach ($timeSlots as $slot)
                                    <label class="flex items-center gap-2 p-2 rounded-lg border border-gray-200 hover:bg-gray-50">
                                        <input type="checkbox" value="{{ $slot }}" x-model="slots" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span class="text-xs font-semibold text-gray-700">{{ $slot }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <button @click="save()" :disabled="saving"
                                class="w-full px-4 py-2.5 bg-blue-700 text-white text-sm font-bold rounded-xl hover:bg-blue-800 transition disabled:opacity-50">
                            <span x-text="saving ? 'Saving...' : 'Save Availability'"></span>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h2 class="font-bold text-gray-900 mb-4">Schedule</h2>
                    <p class="text-sm text-gray-500 mb-4">Configured availability dates for {{ $office }}.</p>
                    <div id="schedule-list" class="space-y-3">
                        <p class="text-sm text-gray-400 text-center py-4">Loading schedule...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function availabilityManager() {
        return {
            date: '',
            type: 'open',
            slots: [],
            saving: false,
            today: new Date().toISOString().split('T')[0],

            async save() {
                if (!this.date) return alert('Please select a date.');
                this.saving = true;
                try {
                    const res = await fetch('{{ route("cici.availability") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            date: this.date,
                            type: this.type,
                            slots: this.slots,
                        }),
                    });
                    const data = await res.json();
                    if (data.message) alert(data.message);
                } catch (e) {
                    alert('Failed to save availability.');
                } finally {
                    this.saving = false;
                }
            }
        };
    }
    </script>
</x-app-layout>
