@extends('layouts.app')

@section('title', 'Expériences - PlaceZo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Expériences uniques</h1>
            <p class="text-lg text-gray-600">Découvrez des propriétés et activités exceptionnelles sélectionnées pour vous.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($experiences as $experience)
                <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition p-6 flex flex-col">
                    <div class="mb-4 h-40 w-full rounded-xl overflow-hidden bg-gray-200 flex items-center justify-center">
                        @if($experience->image)
                            <img src="{{ $experience->image }}" alt="{{ $experience->titre }}" class="object-cover w-full h-full">
                        @else
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a4 4 0 004 4h10a4 4 0 004-4V7a4 4 0 00-4-4H7a4 4 0 00-4 4z" />
                            </svg>
                        @endif
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $experience->titre }}</h2>
                    <p class="text-gray-600 flex-1">{{ \Illuminate\Support\Str::limit($experience->description, 80) }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-lg font-bold text-blue-700">{{ number_format($experience->prix, 2) }} €</span>
                        <a href="{{ route('listings.show', $experience) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Voir plus</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-12 flex justify-center">
            {{ $experiences->links() }}
        </div>
    </div>
</div>
@endsection