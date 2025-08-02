<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-rose-50 via-pink-50 to-orange-50 dark:bg-gradient-to-br dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-12 px-4 sm:px-6 lg:px-8">
        <!-- Background Pattern -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-32 w-96 h-96 rounded-full bg-gradient-to-br from-rose-200/30 to-pink-300/30 blur-3xl"></div>
            <div class="absolute -bottom-40 -left-32 w-96 h-96 rounded-full bg-gradient-to-tr from-orange-200/30 to-pink-300/30 blur-3xl"></div>
        </div>

        <div class="relative w-full max-w-4xl mx-auto px-4 lg:px-8 space-y-8">
            <!-- Logo & Header -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-rose-500 to-pink-600 rounded-2xl shadow-xl transform hover:scale-105 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>

                <div class="space-y-3">
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-rose-600 to-pink-600 bg-clip-text text-transparent">
                        Rejoignez-nous
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300 text-lg">
                        Découvrez des logements uniques ou partagez le vôtre
                    </p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 p-8 lg:p-12 space-y-8">
                <form method="POST" action="{{ route('register') }}" class="space-y-8">
                    @csrf
                    
                    <!-- Role Selection -->
                    <div class="space-y-4">
                        <label class="block text-sm font-semibold text-gray-800 dark:text-gray-200">
                            Comment souhaitez-vous utiliser notre plateforme ?
                        </label>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Client Option -->
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="role" value="client" {{ old('role') == 'client' ? 'checked' : '' }} required class="sr-only peer" />
                                <div class="h-full p-6 bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl border-2 border-transparent peer-checked:border-blue-500 peer-checked:shadow-lg peer-checked:shadow-blue-500/25 transition-all duration-300 flex flex-col items-center justify-center space-y-3 group-hover:scale-[1.02]">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                    <span class="text-base font-medium text-gray-700 dark:text-gray-300">Voyageur</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400 text-center">Je cherche un logement</span>
                                </div>
                            </label>

                            <!-- Host Option -->
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="role" value="host" {{ old('role') == 'host' ? 'checked' : '' }} required class="sr-only peer" />
                                <div class="h-full p-6 bg-gradient-to-br from-emerald-50 to-green-100 dark:from-emerald-900/20 dark:to-green-900/20 rounded-2xl border-2 border-transparent peer-checked:border-emerald-500 peer-checked:shadow-lg peer-checked:shadow-emerald-500/25 transition-all duration-300 flex flex-col items-center justify-center space-y-3 group-hover:scale-[1.02]">
                                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                    </div>
                                    <span class="text-base font-medium text-gray-700 dark:text-gray-300">Hôte</span>
                                    <span class="text-sm text-gray-500 dark:text-gray-400 text-center">Je loue mon logement</span>
                                </div>
                            </label>
                        </div>

                        <x-input-error :messages="$errors->get('role')" class="text-sm text-red-500" />
                    </div>

                    <!-- Name and Email Fields Row -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Name Field -->
                        <div class="space-y-3">
                            <x-input-label for="name" :value="__('Nom complet')" class="text-sm font-semibold text-gray-800 dark:text-gray-200" />
                            
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-rose-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <x-text-input 
                                    id="name" 
                                    class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition-all duration-300 hover:bg-white dark:hover:bg-gray-700" 
                                    type="text" 
                                    name="name" 
                                    :value="old('name')" 
                                    required 
                                    autofocus 
                                    autocomplete="name"
                                    placeholder="Entrez votre nom complet" 
                                />
                            </div>
                            
                            <x-input-error :messages="$errors->get('name')" class="text-sm text-red-500" />
                        </div>

                        <!-- Email Field -->
                        <div class="space-y-3">
                            <x-input-label for="email" :value="__('Adresse email')" class="text-sm font-semibold text-gray-800 dark:text-gray-200" />
                            
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-rose-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>
                                <x-text-input 
                                    id="email" 
                                    class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition-all duration-300 hover:bg-white dark:hover:bg-gray-700" 
                                    type="email" 
                                    name="email" 
                                    :value="old('email')" 
                                    required 
                                    autocomplete="username"
                                    placeholder="votre@email.com" 
                                />
                            </div>
                            
                            <x-input-error :messages="$errors->get('email')" class="text-sm text-red-500" />
                        </div>
                    </div>

                    <!-- Password Fields Row -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Password Field -->
                        <div class="space-y-3">
                            <x-input-label for="password" :value="__('Mot de passe')" class="text-sm font-semibold text-gray-800 dark:text-gray-200" />
                            
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-rose-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <x-text-input 
                                    id="password" 
                                    class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition-all duration-300 hover:bg-white dark:hover:bg-gray-700"
                                    type="password"
                                    name="password"
                                    required 
                                    autocomplete="new-password"
                                    placeholder="Minimum 8 caractères" 
                                />
                            </div>
                            
                            <x-input-error :messages="$errors->get('password')" class="text-sm text-red-500" />
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="space-y-3">
                            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-sm font-semibold text-gray-800 dark:text-gray-200" />
                            
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-rose-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <x-text-input 
                                    id="password_confirmation" 
                                    class="block w-full pl-12 pr-4 py-3 bg-gray-50/50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent transition-all duration-300 hover:bg-white dark:hover:bg-gray-700"
                                    type="password"
                                    name="password_confirmation" 
                                    required 
                                    autocomplete="new-password"
                                    placeholder="Répétez votre mot de passe" 
                                />
                            </div>
                            
                            <x-input-error :messages="$errors->get('password_confirmation')" class="text-sm text-red-500" />
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <x-primary-button class="group relative w-full flex justify-center items-center py-3 px-6 border-0 text-base font-semibold rounded-xl text-white bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 focus:outline-none focus:ring-4 focus:ring-rose-500/25 transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg">
                            <svg class="w-5 h-5 mr-3 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            {{ __('Créer mon compte') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200 dark:border-gray-600"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-gradient-to-br from-rose-50 via-pink-50 to-orange-50 dark:from-gray-900 dark:via-rose-900/20 dark:to-orange-900/20 text-gray-600 dark:text-gray-400 font-medium">
                        ou
                    </span>
                </div>
            </div>

            <!-- Login Link -->
            <div class="text-center">
                <a class="inline-flex items-center text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-rose-600 dark:hover:text-rose-400 transition-colors duration-200 group" href="{{ route('login') }}">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    {{ __('Déjà membre ? Se connecter') }}
                </a>
            </div>

            <!-- Trust Indicators -->
            <div class="pt-6 space-y-4">
                <div class="flex flex-wrap items-center justify-center gap-6 text-gray-500 dark:text-gray-400 text-sm">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Sécurisé</span>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Vérifié</span>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Gratuit</span>
                    </div>
                </div>

                <p class="text-xs text-gray-500 dark:text-gray-400 max-w-md mx-auto text-center leading-relaxed">
                    En créant un compte, vous acceptez nos conditions d'utilisation et notre politique de confidentialité.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>