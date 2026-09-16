<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ISUFSTPASS | Create Your Account</title>

    <link rel="icon"
          type="image/png"
          href="{{ asset('img/isufstpass-logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('partials.pwa-head')
</head>

<body class="font-sans antialiased bg-slate-100 min-h-screen">

    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">

        <!-- Main Container -->
        <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col lg:flex-row">

            <!-- =====================================================
                 LEFT SIDE - UNIVERSITY INFORMATION
            ====================================================== -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-700 via-blue-800 to-indigo-900 text-white relative overflow-hidden">

                <!-- Decorative Circles -->
                <div class="absolute -top-28 -left-28 w-80 h-80 bg-white/10 rounded-full"></div>

                <div class="absolute -bottom-40 -right-28 w-[28rem] h-[28rem] bg-blue-400/10 rounded-full"></div>

                <div class="absolute top-1/2 -right-24 w-48 h-48 bg-indigo-400/10 rounded-full"></div>


                <div class="relative z-10 flex flex-col justify-between p-12 xl:p-16 w-full">

                    <!-- Logo -->
                    <div class="flex items-center gap-4">

                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-lg">

                            <img
                                src="{{ asset('img/isufstpass-logo.png') }}"
                                alt="ISUFSTPASS Logo"
                                class="w-12 h-12 object-contain"
                            >

                        </div>

                        <div>
                            <p class="font-extrabold text-xl tracking-wide">
                                ISUFSTPASS
                            </p>

                            <p class="text-blue-200 text-sm">
                                Iloilo State University
                            </p>
                        </div>

                    </div>


                    <!-- Main Message -->
                    <div class="max-w-lg my-12">

                        <p class="text-blue-200 font-semibold text-sm uppercase tracking-[0.2em] mb-5">
                            University Transaction Portal
                        </p>

                        <h1 class="text-5xl xl:text-6xl font-extrabold leading-tight">

                            One Account.

                            <span class="block text-blue-300">
                                All Transactions.
                            </span>

                        </h1>

                        <p class="mt-7 text-blue-100 text-lg leading-8 max-w-md">
                            Create your ISUFSTPASS account and enjoy a convenient,
                            organized, and secure way to manage university
                            transactions.
                        </p>

                    </div>


                    <!-- Features -->
                    <div class="grid grid-cols-3 gap-4">

                        <!-- Documents -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/10">

                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mb-3">
                                <svg class="w-5 h-5 text-blue-200"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                    />

                                </svg>
                            </div>

                            <p class="text-sm font-semibold">
                                Documents
                            </p>

                            <p class="text-xs text-blue-200 mt-1">
                                Request online
                            </p>

                        </div>


                        <!-- Appointments -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/10">

                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mb-3">

                                <svg class="w-5 h-5 text-blue-200"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />

                                </svg>

                            </div>

                            <p class="text-sm font-semibold">
                                Appointments
                            </p>

                            <p class="text-xs text-blue-200 mt-1">
                                Book easily
                            </p>

                        </div>


                        <!-- QR -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/10">

                            <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mb-3">

                                <svg class="w-5 h-5 text-blue-200"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 4h6v6H4V4zm10 0h6v6h-6V4zM4 14h6v6H4v-6zm10 0h2m2 0h2m-6 4h2m2 0h2m-6 2h6"
                                    />

                                </svg>

                            </div>

                            <p class="text-sm font-semibold">
                                QR Enabled
                            </p>

                            <p class="text-xs text-blue-200 mt-1">
                                Fast & secure
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =====================================================
                 RIGHT SIDE - SELECT ACCOUNT TYPE
            ====================================================== -->
            <div class="w-full lg:w-1/2 flex items-center justify-center bg-white px-6 py-10 sm:px-10 lg:px-14 xl:px-20">

                <div class="w-full max-w-md">


                    <!-- Top Navigation -->
                    <div class="flex items-center justify-between mb-8">

                        <!-- Logo -->
                        <div class="flex items-center gap-2">

                            <img
                                src="{{ asset('img/isufstpass-logo.png') }}"
                                alt="ISUFSTPASS"
                                class="w-9 h-9 object-contain"
                            >

                            <span class="font-bold text-gray-800">
                                ISUFSTPASS
                            </span>

                        </div>

                    </div>


                    <!-- Mobile Logo -->
                    <div class="flex lg:hidden items-center justify-center mb-7">

                        <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center">

                            <img
                                src="{{ asset('img/isufstpass-logo.png') }}"
                                alt="ISUFSTPASS"
                                class="w-12 h-12 object-contain"
                            >

                        </div>

                    </div>


                    <!-- Heading -->
                    <div class="text-center mb-9">

                        <h2 class="text-4xl font-extrabold text-gray-900">
                            Create Your Account
                        </h2>

                        <p class="mt-3 text-gray-500 leading-6">
                            How would you like to register
                            in
                            <span class="font-semibold text-gray-700">
                                ISUFSTPASS?
                            </span>
                        </p>

                    </div>


                    <!-- Account Type Cards -->
                    <div class="grid sm:grid-cols-2 gap-6">

                        <!-- Student Card -->
                        <a
                            href="{{ route('register.form', ['type' => 'student']) }}"
                            class="group flex flex-col items-center text-center p-7 rounded-2xl border-2 border-blue-100 bg-blue-50/50 hover:border-blue-600 hover:bg-blue-50 hover:shadow-xl transition-all duration-200"
                        >

                            <div class="w-16 h-16 rounded-2xl bg-blue-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">

                                <svg class="w-8 h-8 text-white"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path
                                        d="M12 14l9-5-9-5-9 5 9 5z"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                    />

                                    <path
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998a12.078 12.078 0 01.665-6.479L12 14z"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 14v7"
                                    />

                                </svg>

                            </div>

                            <p class="text-lg font-extrabold text-gray-900 uppercase tracking-wide">
                                Student
                            </p>

                            <p class="mt-2 text-sm text-gray-500 leading-5">
                                Currently enrolled at ISUFST
                            </p>

                            <span class="mt-6 inline-flex items-center gap-2 px-5 py-2.5 bg-white text-blue-700 font-bold text-sm rounded-xl border border-blue-200 group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 transition-colors">

                                Register
                                <svg class="w-4 h-4"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"
                                    />

                                </svg>

                            </span>

                        </a>


                        <!-- Other Card -->
                        <a
                            href="{{ route('register.form', ['type' => 'other']) }}"
                            class="group flex flex-col items-center text-center p-7 rounded-2xl border-2 border-emerald-100 bg-emerald-50/50 hover:border-emerald-600 hover:bg-emerald-50 hover:shadow-xl transition-all duration-200"
                        >

                            <div class="w-16 h-16 rounded-2xl bg-emerald-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">

                                <svg class="w-8 h-8 text-white"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                    />

                                </svg>

                            </div>

                            <p class="text-lg font-extrabold text-gray-900 uppercase tracking-wide">
                                Other
                            </p>

                            <p class="mt-2 text-sm text-gray-500 leading-5">
                                Alumni, Guest,
                                Parent/Guardian
                            </p>

                            <span class="mt-6 inline-flex items-center gap-2 px-5 py-2.5 bg-white text-emerald-700 font-bold text-sm rounded-xl border border-emerald-200 group-hover:bg-emerald-600 group-hover:text-white group-hover:border-emerald-600 transition-colors">

                                Register
                                <svg class="w-4 h-4"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"
                                    />

                                </svg>

                            </span>

                        </a>

                    </div>


                    <!-- Login -->
                    <div class="mt-9 text-center">

                        <p class="text-sm text-gray-500">

                            Already have an account?

                            <a
                                href="{{ route('login') }}"
                                class="font-semibold text-blue-600 hover:text-blue-800"
                            >
                                Sign In
                            </a>

                        </p>

                    </div>

                    <!-- Back Home -->
                    <div class="mt-6 flex justify-center">

                        <a
                            href="{{ url('/') }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-blue-600 transition-colors"
                        >

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"
                                />
                            </svg>

                            Back to Home

                        </a>

                    </div>


                    <!-- Footer -->
                    <div class="mt-7 pt-5 border-t border-gray-100 text-center">

                        <p class="text-xs text-gray-400">
                            © {{ date('Y') }} ISUFSTPASS
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            QR Code-Based Transaction Management System
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
</html>