<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900">{{ $office }} Office Dashboard</h1>
                <p class="text-sm text-gray-500 mt-1">Overview of services and tools for the {{ $office }} office.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <p class="text-sm text-gray-500">Office</p>
                    <p class="text-3xl font-black text-blue-700 mt-1">{{ $office }}</p>
                    <p class="text-xs text-gray-400 mt-2">Department staff workspace</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <p class="text-sm text-gray-500">Quick Actions</p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <a href="{{ route(strtolower($office) . '.appointments') }}" class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-bold rounded-lg hover:bg-blue-100 transition">Appointments</a>
                        <a href="{{ route(strtolower($office) . '.qr.index') }}" class="px-3 py-1.5 bg-green-50 text-green-700 text-xs font-bold rounded-lg hover:bg-green-100 transition">QR Scanner</a>
                        <a href="{{ route(strtolower($office) . '.availability') }}" class="px-3 py-1.5 bg-yellow-50 text-yellow-700 text-xs font-bold rounded-lg hover:bg-yellow-100 transition">Availability</a>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <p class="text-sm text-gray-500">Manage</p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <a href="{{ route(strtolower($office) . '.consultations') }}" class="px-3 py-1.5 bg-purple-50 text-purple-700 text-xs font-bold rounded-lg hover:bg-purple-100 transition">Consultations</a>
                        <a href="{{ route(strtolower($office) . '.profile') }}" class="px-3 py-1.5 bg-gray-50 text-gray-700 text-xs font-bold rounded-lg hover:bg-gray-100 transition">Profile</a>
                        <a href="{{ route(strtolower($office) . '.help') }}" class="px-3 py-1.5 bg-red-50 text-red-700 text-xs font-bold rounded-lg hover:bg-red-100 transition">Help</a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-bold text-gray-900">{{ $office }} Office Overview</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6 text-sm text-gray-600">
                    <div class="rounded-xl bg-blue-50/50 p-5">
                        <p class="font-bold text-gray-900">Appointments</p>
                        <p class="mt-1">View and manage student appointments scheduled for the {{ $office }} office.</p>
                    </div>
                    <div class="rounded-xl bg-green-50/50 p-5">
                        <p class="font-bold text-gray-900">QR Check-in</p>
                        <p class="mt-1">Scan student passes to verify and record attendance in real time.</p>
                    </div>
                    <div class="rounded-xl bg-yellow-50/50 p-5">
                        <p class="font-bold text-gray-900">Availability</p>
                        <p class="mt-1">Configure open dates and time slots for student visits.</p>
                    </div>
                    <div class="rounded-xl bg-purple-50/50 p-5">
                        <p class="font-bold text-gray-900">Consultations</p>
                        <p class="mt-1">Review the {{ $office }}-specific appointment types and services offered.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>