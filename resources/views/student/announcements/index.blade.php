<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-2xl font-extrabold text-gray-900">Announcements</h1>
            <p class="text-sm text-gray-500 mt-1">Official announcements from campus offices.</p>

            <div class="mt-8 space-y-4">
                @forelse ($announcements as $announcement)
                    <a href="{{ route('student.announcements.show', $announcement) }}"
                       class="block bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:border-blue-300 hover:shadow-md transition">
                        <div class="flex items-center gap-2">
                            @if ($announcement->office)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wide bg-blue-50 text-blue-700 ring-1 ring-blue-100">
                                    {{ $announcement->office }}
                                </span>
                            @endif
                            <span class="text-xs text-gray-400">{{ $announcement->published_at->format('M j, Y') }}</span>
                        </div>
                        <h2 class="mt-2 font-bold text-gray-900">{{ $announcement->title }}</h2>
                        <p class="mt-1 text-sm text-gray-500 line-clamp-2">{{ $announcement->body }}</p>
                    </a>
                @empty
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
                        <p class="font-semibold text-gray-700">No announcements yet</p>
                        <p class="text-sm text-gray-400 mt-1">Check back later for campus updates.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $announcements->links() }}
            </div>
        </div>
    </div>
</x-app-layout>