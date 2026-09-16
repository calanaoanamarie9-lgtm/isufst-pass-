<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Welcome Banner --}}
            <div class="bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 overflow-hidden relative">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-blue-700/40 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative">
                    <p class="text-xs font-semibold uppercase tracking-widest text-yellow-400">
                        Registrar Dashboard
                    </p>
                    <h1 class="mt-2 text-2xl sm:text-3xl font-extrabold text-white">
                        Welcome,  {{ Auth::user()->name }}!
                    </h1>
                    <p class="mt-2 text-sm text-blue-200 max-w-lg">
                        Review document requests, approve transactions, and manage issued documents.
                    </p>
                </div>
                <div class="relative shrink-0">
                    <a href="#"
                       class="inline-flex items-center justify-center px-6 py-3 bg-yellow-400 text-blue-950 font-bold rounded-xl hover:bg-yellow-300 transition shadow-lg">
                        View Requests
                    </a>
                </div>
            </div>

            {{-- Stats --}}
            <div class="mt-8 grid grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="w-11 h-11 bg-yellow-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-2xl font-black text-gray-900">0</p>
                    <p class="text-sm text-gray-500">Pending Requests</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="w-11 h-11 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-2xl font-black text-gray-900">0</p>
                    <p class="text-sm text-gray-500">Approved</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-2xl font-black text-gray-900">0</p>
                    <p class="text-sm text-gray-500">Issued Documents</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <div class="w-11 h-11 bg-indigo-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-2xl font-black text-gray-900">0</p>
                    <p class="text-sm text-gray-500">Students Served</p>
                </div>

            </div>

            {{-- Pending Requests Table --}}
            <div class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="font-bold text-gray-900">Pending Document Requests</h2>
                    <a href="#" class="text-sm font-semibold text-blue-700 hover:text-blue-900 transition">View All</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Student</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Document</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date Requested</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-400">No pending requests.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>