@props([
    'passTitle' => 'Transcript of Record',
    'status' => 'Approved',
    'qrCodeImage' => null,
    'referenceCode' => null,
    'viewPassUrl' => '#',
])

<div class="max-w-sm mx-auto bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-2xl">

    <!-- Card Header (Dark Navy / Blue with Gold Accent) -->
    <div class="bg-slate-900 text-white p-4 flex items-center justify-between border-b-4 border-amber-500">
        <div class="flex items-center space-x-3">
            <div class="bg-amber-500 text-slate-900 p-2 rounded-lg font-bold">
                <!-- Icon (Document / ID) -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-base tracking-wide">{{ $passTitle }}</h3>
                <p class="text-xs text-amber-400 font-medium">Digital Verification Pass</p>
            </div>
        </div>

        <!-- Status Badge -->
        <span class="px-2.5 py-1 text-xs font-semibold bg-emerald-500/20 text-emerald-400 rounded-full border border-emerald-500/30 flex items-center gap-1">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
            {{ $status }}
        </span>
    </div>

    <!-- QR Code Body with Corner Brackets -->
    <div class="p-6 flex flex-col items-center justify-center bg-white relative">

        <div class="relative p-4 bg-white rounded-xl shadow-inner border border-gray-100 flex items-center justify-center">
            <!-- Corner Bracket Top-Left -->
            <div class="absolute top-2 left-2 w-4 h-4 border-t-2 border-l-2 border-slate-400"></div>
            <!-- Corner Bracket Top-Right -->
            <div class="absolute top-2 right-2 w-4 h-4 border-t-2 border-r-2 border-slate-400"></div>
            <!-- Corner Bracket Bottom-Left -->
            <div class="absolute bottom-2 left-2 w-4 h-4 border-b-2 border-l-2 border-slate-400"></div>
            <!-- Corner Bracket Bottom-Right -->
            <div class="absolute bottom-2 right-2 w-4 h-4 border-b-2 border-r-2 border-slate-400"></div>

            <div class="w-full h-48 bg-gray-50 flex items-center justify-center">
                {!! $qrCodeImage !!}
            </div>
        </div>

        <!-- Reference Code / ID Details -->
        <div class="mt-4 text-center w-full">
            <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold">Reference Code</p>
            <p class="text-xs font-mono font-bold text-slate-700 mt-0.5 tracking-wider">{{ $referenceCode }}</p>
        </div>
    </div>

    <!-- Card Footer / Action Button -->
    <div class="px-6 pb-6 pt-2 bg-white">
        <a href="{{ $viewPassUrl }}" class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-xl text-sm transition-colors shadow-md shadow-blue-500/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            View Full Pass
        </a>
    </div>

</div>