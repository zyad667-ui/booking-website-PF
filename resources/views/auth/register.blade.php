<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Register</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-center">
                <div class="flex items-center justify-center w-16 h-16 bg-teal-600 rounded-full shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                </div>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Create your account
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Join our booking platform today
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow-xl rounded-lg sm:px-10">
                <form class="space-y-6" method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Role Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            I want to
                        </label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative">
                                <input type="radio" name="role" value="client"
                                    {{ old('role') == 'client' ? 'checked' : '' }} required class="sr-only peer">
                                <div
                                    class="border-2 border-gray-200 rounded-lg p-4 cursor-pointer peer-checked:border-teal-500 peer-checked:bg-teal-50 hover:border-gray-300 transition-all duration-200">
                                    <div class="flex flex-col items-center text-center">
                                        <svg class="w-6 h-6 text-cyan-500 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-900">Find Places</span>
                                        <span class="text-xs text-gray-500">Traveler</span>
                                    </div>
                                </div>
                            </label>
                            <label class="relative">
                                <input type="radio" name="role" value="host"
                                    {{ old('role') == 'host' ? 'checked' : '' }} required class="sr-only peer">
                                <div
                                    class="border-2 border-gray-200 rounded-lg p-4 cursor-pointer peer-checked:border-teal-500 peer-checked:bg-teal-50 hover:border-gray-300 transition-all duration-200">
                                    <div class="flex flex-col items-center text-center">
                                        <svg class="w-6 h-6 text-emerald-500 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-900">Host Places</span>
                                        <span class="text-xs text-gray-500">Property Owner</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @if ($errors->get('role'))
                            <div class="mt-2 text-sm text-red-600">
                                @foreach ((array) $errors->get('role') as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input id="name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                            type="text" name="name" value="{{ old('name') }}" required autofocus
                            autocomplete="name" placeholder="Enter your full name" />
                        @if ($errors->get('name'))
                            <div class="mt-2 text-sm text-red-600">
                                @foreach ((array) $errors->get('name') as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input id="email"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                            type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            placeholder="Enter your email address" />
                        @if ($errors->get('email'))
                            <div class="mt-2 text-sm text-red-600">
                                @foreach ((array) $errors->get('email') as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                            type="password" name="password" required autocomplete="new-password"
                            placeholder="Create a strong password" />
                        @if ($errors->get('password'))
                            <div class="mt-2 text-sm text-red-600">
                                @foreach ((array) $errors->get('password') as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <input id="password_confirmation"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                            type="password" name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirm your password" />
                        @if ($errors->get('password_confirmation'))
                            <div class="mt-2 text-sm text-red-600">
                                @foreach ((array) $errors->get('password_confirmation') as $message)
                                    <p>{{ $message }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Terms and Privacy -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required
                                class="focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="text-gray-600">
                                I agree to the
                                <a href="#" class="text-teal-600 hover:text-teal-500">Terms of Service</a>
                                and
                                <a href="#" class="text-teal-600 hover:text-teal-500">Privacy Policy</a>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-150 ease-in-out">
                            Create Account
                        </button>
                    </div>


                </form>

                <!-- Login Link -->
                <div class="mt-6">
                    <div class="text-center">
                        <span class="text-sm text-gray-600">
                            Already have an account?
                            <a href="{{ route('login') }}" class="font-medium text-teal-600 hover:text-teal-500">
                                Sign in
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Why join us?</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="ml-3 text-sm text-gray-600">Instant booking confirmation</p>
                    </div>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="ml-3 text-sm text-gray-600">24/7 customer support</p>
                    </div>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="ml-3 text-sm text-gray-600">Secure payment processing</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
