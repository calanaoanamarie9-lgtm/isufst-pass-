<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900">{{ $office }} QR Scanner &amp; Check-in</h1>
                <p class="text-sm text-gray-500 mt-1">Scan student appointment passes for instant attendance verification.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="font-bold text-gray-900">QR Scanner</h2>
                </div>
                <div class="px-5 py-12 text-center">
                    <p class="text-sm text-gray-500">QR check-in tools for the {{ $office }} office will appear here.</p>
                    <p class="mt-3 text-xs text-gray-400">Ask the student to present their QR pass, then scan or enter the token manually.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>