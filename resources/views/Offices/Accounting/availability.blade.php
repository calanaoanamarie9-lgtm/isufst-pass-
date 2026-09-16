<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900">{{ $office }} Availability</h1>
                <p class="text-sm text-gray-500 mt-1">Configure open dates and time slots for the {{ $office }} office.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-bold text-gray-900">Time Slot Settings</h2>
                </div>
                <div class="px-5 py-12 text-center leading-relaxed">
                    <p class="text-sm text-gray-500">Availability configuration tools for the {{ $office }} office will appear here.</p>
                    <ul class="mt-4 inline-block text-left text-sm text-gray-600 space-y-1">
                        <li>Set a date to <strong>Open All Day</strong>, <strong>Closed</strong>, or <strong>Specific Slots</strong>.</li>
                        <li>Click <strong>Save Availability</strong> to apply changes.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>