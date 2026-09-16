<x-app-layout>
    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900">Document Fees &amp; Services</h1>
                <p class="text-sm text-gray-500 mt-1">Manage document pricing and fees for student requests.</p>
            </div>

            @if (session('status'))
                <div class="mb-6 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Add Document --}}
            <form method="POST" action="{{ route('registrar.documents.store') }}"
                  class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-6 grid sm:grid-cols-12 gap-3 items-end">
                @csrf
                <div class="sm:col-span-4">
                    <label class="block text-xs font-bold uppercase tracking-wide text-gray-400 mb-1.5">Document Name</label>
                    <input type="text" name="name" required placeholder="e.g. Transcript of Records"
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>
                <div class="sm:col-span-4">
                    <label class="block text-xs font-bold uppercase tracking-wide text-gray-400 mb-1.5">Description</label>
                    <input type="text" name="description" placeholder="Short description (optional)"
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wide text-gray-400 mb-1.5">Fee (₱)</label>
                    <input type="number" name="fee" min="0" step="0.01" required placeholder="0.00"
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                </div>
                <div class="sm:col-span-2">
                    <button type="submit"
                            class="w-full px-4 py-2.5 bg-blue-800 text-white text-sm font-semibold rounded-xl hover:bg-blue-900 transition">
                        Add Document
                    </button>
                </div>
            </form>

            {{-- Document List --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="font-bold text-gray-900 text-sm">Document Services &amp; Fees</h2>
                </div>

                @forelse ($documents as $document)
                    <form method="POST" action="{{ route('registrar.documents.update', $document) }}"
                          class="flex flex-col lg:flex-row lg:items-center gap-3 px-6 py-4 border-b border-gray-50 last:border-0"
                          data-confirm="Save the changes made to this document and its fee?"
                          data-confirm-title="Save document changes?" data-confirm-ok="Yes, save" data-confirm-icon="question">
                        @csrf
                        @method('PUT')

                        <div class="flex-1 min-w-0">
                            <input type="text" name="name" value="{{ $document->name }}" required
                                   class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm font-bold text-gray-900">
                            <input type="text" name="description" value="{{ $document->description }}"
                                   placeholder="Description"
                                   class="mt-1.5 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-xs text-gray-500">
                        </div>

                        <div class="flex items-center gap-2 lg:w-48">
                            <span class="text-sm font-bold text-gray-400 shrink-0">₱</span>
                            <input type="number" name="fee" min="0" step="0.01" value="{{ $document->fee }}" required
                                   class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>

                        <div class="flex items-center gap-4 lg:w-auto">
                            <label class="flex items-center gap-2 text-xs font-semibold text-gray-500 cursor-pointer">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" @checked($document->is_active)
                                       class="rounded border-gray-300 text-blue-700 focus:ring-blue-500">
                                Active
                            </label>

                            <button type="submit"
                                    class="px-4 py-2 bg-blue-800 text-white text-xs font-bold rounded-xl hover:bg-blue-900 transition">
                                Save
                            </button>
                        </div>

                        @if ($document->requests_count === 0)
                            <button type="submit" form="delete-document-{{ $document->id }}"
                                    class="px-4 py-2 bg-red-50 text-red-600 text-xs font-bold rounded-xl hover:bg-red-100 transition">
                                Delete
                            </button>
                        @else
                            <span class="px-4 py-2 text-xs font-semibold text-gray-400 bg-gray-50 rounded-xl"
                                  title="Attached to {{ $document->requests_count }} request(s) — cannot be deleted">
                                Used {{ $document->requests_count }}×
                            </span>
                        @endif
                    </form>

                    <form id="delete-document-{{ $document->id }}" method="POST"
                          action="{{ route('registrar.documents.destroy', $document) }}"
                          data-confirm="This document service and its fee will be removed."
                          data-confirm-title="Delete this document service?" data-confirm-ok="Yes, delete it">
                        @csrf
                        @method('DELETE')
                    </form>
                @empty
                    <div class="p-12 text-center">
                        <p class="font-semibold text-gray-700">No document services yet</p>
                        <p class="text-sm text-gray-400 mt-1">Add document types and their fees above.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>