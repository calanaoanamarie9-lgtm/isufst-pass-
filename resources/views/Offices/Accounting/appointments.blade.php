<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900">{{ $office }} Appointments</h1>
                <p class="text-sm text-gray-500 mt-1">Manage student appointments for the {{ $office }} office.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-bold text-gray-900">Appointment Management</h2>
                </div>
                <div class="px-5 py-12 text-center">
                    <p class="text-sm text-gray-500">Appointment management tools for the {{ $office }} office will appear here.</p>
                    <a href="{{ route(strtolower($office) . '.availability') }}" class="inline-block mt-4 px-4 py-2 bg-yellow-50 text-yellow-700 text-sm font-bold rounded-lg hover:bg-yellow-100 transition">Manage Availability</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>