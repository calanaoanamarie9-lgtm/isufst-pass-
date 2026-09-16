<x-app-layout>

    <div class="min-h-screen bg-[#f5f7fb] py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- =========================================================
                PAGE HEADER
            ========================================================== --}}
            <div class="mb-7">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div>
                        <h1 class="text-2xl font-bold text-[#102d5b]">
                            User Management
                        </h1>

                        <p class="text-sm text-gray-500 mt-1">
                            Create and manage student, staff, and office accounts.
                        </p>
                    </div>

                    <div class="inline-flex items-center gap-2 px-4 py-2.5
                                bg-blue-50 border border-blue-100 rounded-xl
                                text-sm font-semibold text-blue-800">
                        <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                        Account Administration
                    </div>

                </div>
            </div>


            {{-- =========================================================
                SUCCESS MESSAGE
            ========================================================== --}}
            @if (session('status'))
                <div class="mb-6 flex items-start gap-3 rounded-xl
                            bg-green-50 border border-green-200
                            px-4 py-3 text-sm text-green-700">

                    <div class="mt-0.5 w-5 h-5 rounded-full bg-green-100
                                flex items-center justify-center shrink-0">
                        ✓
                    </div>

                    <div>
                        {{ session('status') }}
                    </div>

                </div>
            @endif


            {{-- =========================================================
                ERROR MESSAGE
            ========================================================== --}}
            @if (session('error'))
                <div class="mb-6 flex items-start gap-3 rounded-xl
                            bg-red-50 border border-red-200
                            px-4 py-3 text-sm text-red-700">

                    <div class="mt-0.5 w-5 h-5 rounded-full bg-red-100
                                flex items-center justify-center shrink-0">
                        !
                    </div>

                    <div>
                        {{ session('error') }}
                    </div>

                </div>
            @endif


            {{-- =========================================================
                VALIDATION ERRORS
            ========================================================== --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl bg-red-50 border border-red-200
                            px-4 py-3 text-sm text-red-700">

                    <p class="font-semibold mb-2">
                        Please correct the following:
                    </p>

                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif


            {{-- =========================================================
                CREATE ACCOUNT
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-200
                        shadow-sm overflow-hidden mb-6">

                {{-- Card Header --}}
                <div class="px-6 py-4 bg-[#102d5b]">

                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 rounded-lg bg-white/10
                                    flex items-center justify-center
                                    text-white font-bold">
                            +
                        </div>

                        <div>
                            <h2 class="text-sm font-bold text-white">
                                Create Account
                            </h2>

                            <p class="text-xs text-blue-100 mt-0.5">
                                Add a new system user account
                            </p>
                        </div>

                    </div>

                </div>


                {{-- Form --}}
                <form method="POST"
                      action="{{ route('admin.users.store') }}"
                      class="p-6">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-5">

                        {{-- Name --}}
                        <div class="lg:col-span-3">

                            <label class="block text-xs font-bold
                                          uppercase tracking-wide text-gray-500 mb-2">
                                Name
                            </label>

                            <input type="text"
                                   name="name"
                                   required
                                   placeholder="Full name"
                                   class="w-full h-11 rounded-xl border-gray-300
                                          text-sm shadow-sm
                                          focus:border-blue-600
                                          focus:ring-blue-600">

                        </div>


                        {{-- Email --}}
                        <div class="lg:col-span-3">

                            <label class="block text-xs font-bold
                                          uppercase tracking-wide text-gray-500 mb-2">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   required
                                   placeholder="user@isufst.edu.ph"
                                   class="w-full h-11 rounded-xl border-gray-300
                                          text-sm shadow-sm
                                          focus:border-blue-600
                                          focus:ring-blue-600">

                        </div>


                        {{-- Role --}}
                        <div class="lg:col-span-2">

                            <label class="block text-xs font-bold
                                          uppercase tracking-wide text-gray-500 mb-2">
                                Role
                            </label>

                            <select name="role"
                                    required
                                    class="w-full h-11 rounded-xl border-gray-300
                                           text-sm shadow-sm
                                           focus:border-blue-600
                                           focus:ring-blue-600">

                                <option value="{{ \App\Models\User::ROLE_STUDENT }}">
                                    Student
                                </option>

                                <option value="{{ \App\Models\User::ROLE_REGISTRAR }}">
                                    Registrar
                                </option>

                                <option value="{{ \App\Models\User::ROLE_CASHIER }}">
                                    Cashier
                                </option>

                                <option value="{{ \App\Models\User::ROLE_DEPARTMENT }}">
                                    Department / Office
                                </option>

                                <option value="{{ \App\Models\User::ROLE_ADMIN }}">
                                    Administrator
                                </option>

                            </select>

                        </div>


                        {{-- Password --}}
                        <div class="lg:col-span-2">

                            <label class="block text-xs font-bold
                                          uppercase tracking-wide text-gray-500 mb-2">
                                Password
                            </label>

                            <input type="password"
                                   name="password"
                                   required
                                   placeholder="Min 8 chars"
                                   class="w-full h-11 rounded-xl border-gray-300
                                          text-sm shadow-sm
                                          focus:border-blue-600
                                          focus:ring-blue-600">

                        </div>


                        {{-- Button --}}
                        <div class="lg:col-span-2 flex items-end">

                            <button type="submit"
                                    class="w-full h-11 px-5 rounded-xl
                                           bg-[#0b4ea2] text-white
                                           text-sm font-semibold
                                           hover:bg-[#083d82]
                                           transition shadow-sm">

                                Create Account

                            </button>

                        </div>

                    </div>

                </form>

            </div>


            {{-- =========================================================
                SEARCH & FILTER
            ========================================================== --}}
            <form method="GET"
                  action="{{ route('admin.users.index') }}"
                  class="bg-white rounded-2xl border border-gray-200
                         shadow-sm p-5 mb-6">

                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

                    {{-- Search --}}
                    <div class="md:col-span-8">

                        <label class="block text-xs font-bold
                                      uppercase tracking-wide text-gray-500 mb-2">
                            Search Accounts
                        </label>

                        <input type="text"
                               name="q"
                               value="{{ $search }}"
                               placeholder="Search by name or email..."
                               class="w-full h-11 rounded-xl border-gray-300
                                      text-sm shadow-sm
                                      focus:border-blue-600
                                      focus:ring-blue-600">

                    </div>


                    {{-- Role --}}
                    <div class="md:col-span-2">

                        <label class="block text-xs font-bold
                                      uppercase tracking-wide text-gray-500 mb-2">
                            Role
                        </label>

                        <select name="role"
                                onchange="this.form.submit()"
                                class="w-full h-11 rounded-xl border-gray-300
                                       text-sm shadow-sm
                                       focus:border-blue-600
                                       focus:ring-blue-600">

                            <option value="">
                                All roles
                            </option>

                            <option value="{{ \App\Models\User::ROLE_STUDENT }}"
                                    @selected($roleFilter === \App\Models\User::ROLE_STUDENT)>
                                Student
                            </option>

                            <option value="{{ \App\Models\User::ROLE_REGISTRAR }}"
                                    @selected($roleFilter === \App\Models\User::ROLE_REGISTRAR)>
                                Registrar
                            </option>

                            <option value="{{ \App\Models\User::ROLE_CASHIER }}"
                                    @selected($roleFilter === \App\Models\User::ROLE_CASHIER)>
                                Cashier
                            </option>

                            <option value="{{ \App\Models\User::ROLE_DEPARTMENT }}"
                                    @selected($roleFilter === \App\Models\User::ROLE_DEPARTMENT)>
                                Department / Office
                            </option>

                            <option value="{{ \App\Models\User::ROLE_ADMIN }}"
                                    @selected($roleFilter === \App\Models\User::ROLE_ADMIN)>
                                Administrator
                            </option>

                        </select>

                    </div>


                    {{-- Filter --}}
                    <div class="md:col-span-2 flex gap-2">

                        <button type="submit"
                                class="h-11 flex-1 px-4 rounded-xl
                                       bg-[#102d5b] text-white
                                       text-sm font-semibold
                                       hover:bg-[#0b2449]
                                       transition">

                            Filter

                        </button>

                        @if ($search || $roleFilter)

                            <a href="{{ route('admin.users.index') }}"
                               class="h-11 px-4 rounded-xl
                                      border border-gray-300
                                      bg-white text-gray-600
                                      text-sm font-semibold
                                      inline-flex items-center
                                      justify-center
                                      hover:bg-gray-50 transition">

                                Reset

                            </a>

                        @endif

                    </div>

                </div>

            </form>


            {{-- =========================================================
                USER TABLE
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-200
                        shadow-sm overflow-hidden">

                {{-- Table Header --}}
                <div class="px-6 py-5 border-b border-gray-200
                            flex flex-col sm:flex-row
                            sm:items-center sm:justify-between gap-3">

                    <div>

                        <h2 class="text-base font-bold text-[#102d5b]">
                            System Accounts
                        </h2>

                        <p class="text-xs text-gray-500 mt-1">
                            Manage registered users and account access.
                        </p>

                    </div>

                    <div class="px-3 py-1.5 rounded-lg
                                bg-blue-50 text-blue-700
                                text-xs font-bold">

                        {{ $users->total() }} Accounts

                    </div>

                </div>


                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-[#f8fafc] border-b border-gray-200">

                            <tr>

                                <th class="px-6 py-4 text-left
                                           text-xs font-bold uppercase
                                           tracking-wide text-gray-500">
                                    User
                                </th>

                                <th class="px-6 py-4 text-left
                                           text-xs font-bold uppercase
                                           tracking-wide text-gray-500">
                                    Email
                                </th>

                                <th class="px-6 py-4 text-left
                                           text-xs font-bold uppercase
                                           tracking-wide text-gray-500">
                                    Role
                                </th>

                                <th class="px-6 py-4 text-left
                                           text-xs font-bold uppercase
                                           tracking-wide text-gray-500">
                                    Office
                                </th>

                                <th class="px-6 py-4 text-left
                                           text-xs font-bold uppercase
                                           tracking-wide text-gray-500">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-right
                                           text-xs font-bold uppercase
                                           tracking-wide text-gray-500">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @forelse ($users as $user)

                                <tr class="hover:bg-blue-50/30 transition">

                                    {{-- User --}}
                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="w-10 h-10 rounded-xl
                                                        bg-blue-100 text-blue-800
                                                        flex items-center justify-center
                                                        font-bold text-sm shrink-0">

                                                {{ strtoupper(substr($user->name, 0, 1)) }}

                                            </div>

                                            <div>

                                                <p class="text-sm font-semibold
                                                          text-gray-900">

                                                    {{ $user->name }}

                                                </p>

                                                <p class="text-xs text-gray-400 mt-0.5">
                                                    User Account
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Email --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <span class="text-sm text-gray-600">
                                            {{ $user->email }}
                                        </span>

                                    </td>


                                    {{-- Role --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @php
                                            $roleClass =
                                                $user->role === \App\Models\User::ROLE_ADMIN
                                                    ? 'bg-purple-50 text-purple-700 border-purple-100'
                                                    : ($user->role === \App\Models\User::ROLE_STUDENT
                                                        ? 'bg-green-50 text-green-700 border-green-100'
                                                        : ($user->role === \App\Models\User::ROLE_DEPARTMENT
                                                            ? 'bg-blue-50 text-blue-700 border-blue-100'
                                                            : 'bg-gray-50 text-gray-700 border-gray-200'));
                                        @endphp

                                        <span class="inline-flex items-center
                                                     px-2.5 py-1 rounded-lg
                                                     border text-xs font-semibold
                                                     {{ $roleClass }}">

                                            {{ ucfirst($user->role) }}

                                        </span>

                                    </td>


                                    {{-- Office --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <span class="text-sm text-gray-500">
                                            {{ $user->office ?? '—' }}
                                        </span>

                                    </td>


                                    {{-- Status --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($user->is_active)

                                            <span class="inline-flex items-center gap-1.5
                                                         px-2.5 py-1 rounded-lg
                                                         bg-green-50 text-green-700
                                                         border border-green-100
                                                         text-xs font-semibold">

                                                <span class="w-1.5 h-1.5 rounded-full
                                                             bg-green-500"></span>

                                                Active

                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-1.5
                                                         px-2.5 py-1 rounded-lg
                                                         bg-red-50 text-red-700
                                                         border border-red-100
                                                         text-xs font-semibold">

                                                <span class="w-1.5 h-1.5 rounded-full
                                                             bg-red-500"></span>

                                                Inactive

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Actions --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center justify-end gap-2">

                                            {{-- Activate / Deactivate --}}
                                            <form method="POST"
                                                  action="{{ route('admin.users.toggle', $user) }}">

                                                @csrf
                                                @method('PUT')

                                                <button type="submit"
                                                        class="px-3 py-2 rounded-lg
                                                               text-xs font-semibold
                                                               transition
                                                               {{ $user->is_active
                                                                    ? 'bg-red-50 text-red-600 hover:bg-red-100'
                                                                    : 'bg-green-50 text-green-600 hover:bg-green-100' }}">

                                                    {{ $user->is_active
                                                        ? 'Deactivate'
                                                        : 'Activate' }}

                                                </button>

                                            </form>


                                            {{-- Delete --}}
                                            <form method="POST"
                                                  action="{{ route('admin.users.destroy', $user) }}"
                                                  data-confirm="This account will be permanently deleted."
                                                  data-confirm-title="Delete this account?"
                                                  data-confirm-ok="Yes, delete it">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="px-3 py-2 rounded-lg
                                                               bg-gray-50 text-gray-600
                                                               border border-gray-200
                                                               text-xs font-semibold
                                                               hover:bg-gray-100
                                                               transition">

                                                    Delete

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6"
                                        class="px-6 py-16 text-center">

                                        <div class="max-w-sm mx-auto">

                                            <div class="w-12 h-12 mx-auto
                                                        rounded-xl bg-gray-100
                                                        text-gray-400
                                                        flex items-center justify-center
                                                        text-xl font-bold">

                                                —

                                            </div>

                                            <p class="mt-4 font-semibold
                                                      text-gray-700">

                                                No accounts found

                                            </p>

                                            <p class="text-sm text-gray-400 mt-1">

                                                Try a different search or role filter.

                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- =========================================================
                PAGINATION
            ========================================================== --}}
            @if ($users->hasPages())

                <div class="mt-6">
                    {{ $users->links() }}
                </div>

            @endif


            {{-- =========================================================
                FOOTER INFORMATION
            ========================================================== --}}
            <div class="mt-6 px-5 py-4 bg-blue-50
                        border border-blue-100 rounded-xl">

                <div class="flex items-start gap-3">

                    <div class="w-8 h-8 rounded-lg bg-blue-100
                                text-blue-700 flex items-center
                                justify-center font-bold shrink-0">
                        i
                    </div>

                    <div>

                        <p class="text-sm font-semibold text-blue-900">
                            Account Access
                        </p>

                        <p class="text-xs text-blue-700 mt-0.5">
                            Only active accounts can access the ISUFSTPASS system.
                            Deactivated accounts remain in the system but cannot sign in.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>