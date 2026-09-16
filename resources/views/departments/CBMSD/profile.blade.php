<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900">{{ $office }} Profile Settings</h1>
                <p class="text-sm text-gray-500 mt-1">Update department credentials, office name, and email info.</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wide text-gray-400 mb-1.5">Name</label>
                        <input type="text" value="{{ $user->name }}" disabled
                               class="w-full rounded-xl border-gray-200 bg-gray-50 text-sm text-gray-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wide text-gray-400 mb-1.5">Email</label>
                        <input type="email" value="{{ $user->email }}" disabled
                               class="w-full rounded-xl border-gray-200 bg-gray-50 text-sm text-gray-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wide text-gray-400 mb-1.5">Office</label>
                        <input type="text" value="{{ $office }}" disabled
                               class="w-full rounded-xl border-gray-200 bg-gray-50 text-sm text-gray-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wide text-gray-400 mb-1.5">Role</label>
                        <input type="text" value="Department Staff" disabled
                               class="w-full rounded-xl border-gray-200 bg-gray-50 text-sm text-gray-500">
                    </div>
                </div>
                <p class="text-xs text-gray-400 mt-6">Contact your administrator to update account details.</p>
            </div>

        </div>
    </div>
</x-app-layout>
