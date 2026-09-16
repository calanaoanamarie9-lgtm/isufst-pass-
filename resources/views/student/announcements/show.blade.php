<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <a href="{{ route('student.announcements.index') }}" class="text-sm font-semibold text-blue-700 hover:text-blue-900 transition">
                &larr; Back to Announcements
            </a>

            <article class="mt-6 bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                <div class="flex items-center gap-2">
                    @if ($announcement->office)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wide bg-blue-50 text-blue-700 ring-1 ring-blue-100">
                            {{ $announcement->office }}
                        </span>
                    @endif
                    <span class="text-xs text-gray-400">{{ $announcement->published_at->format('F j, Y g:i A') }}</span>
                </div>

                <h1 class="mt-3 text-2xl font-extrabold text-gray-900">{{ $announcement->title }}</h1>

                <div class="mt-5 text-gray-700 leading-relaxed whitespace-pre-line">{{ $announcement->body }}</div>
            </article>
        </div>
    </div>
</x-app-layout>