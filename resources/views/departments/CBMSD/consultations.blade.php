<x-app-layout>
    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900">Consultation Services</h1>
                <p class="text-sm text-gray-500 mt-1">Configure {{ $office }}-specific appointment types.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="font-bold text-gray-900">Appointment Types</h2>
                </div>

                <div class="divide-y divide-gray-50">
                    @forelse (['Capstone Consultation', 'OJT Advising', 'Academic Advising', 'Research Guidance', 'General Inquiry'] as $type)
                        <div class="px-5 py-4 flex items-center gap-3 hover:bg-blue-50/30 transition">
                            <div class="w-9 h-9 rounded-full bg-blue-50 flex items-center justify-center text-blue-700 font-bold text-xs shrink-0">
                                📋
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-gray-900 text-sm">{{ $type }}</p>
                                <p class="text-xs text-gray-400">Available for {{ $office }} students</p>
                            </div>
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full bg-green-50 text-green-700">Active</span>
                        </div>
                    @empty
                        <div class="px-5 py-12 text-center text-sm text-gray-400">No consultation services configured yet.</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
