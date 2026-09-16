<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900">{{ $office }} Consultation Services</h1>
                <p class="text-sm text-gray-500 mt-1">Appointment types and services offered by the {{ $office }} office.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-bold text-gray-900">Consultation Services</h2>
                </div>
                <div class="px-5 py-12 text-center">
                    <p class="text-sm text-gray-500">Consultation service configuration for the {{ $office }} office will appear here.</p>
                    <p class="mt-3 text-xs text-gray-400">Contact the administrator to add or modify service types.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>