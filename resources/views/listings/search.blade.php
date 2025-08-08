@extends('layouts.app')

@section('title', 'Résultats de la recherche')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Résultats pour "{{ $query }}"</h1>
    @if($listings->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($listings as $listing)
                <div class="bg-white rounded-xl shadow p-4 flex flex-col">
                    <div class="h-40 w-full bg-gray-200 rounded-lg mb-3 flex items-center justify-center">
                        @if($listing->images->first())
                            <img src="{{ $listing->images->first()->url ?? '' }}" class="object-cover w-full h-full rounded-lg" alt="{{ $listing->titre }}">
                        @else
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a4 4 0 004 4h10a4 4 0 004-4V7a4 4 0 00-4-4H7a4 4 0 00-4 4z" />
                            </svg>
                        @endif
                    </div>
                    <h2 class="text-lg font-semibold mb-1">{{ $listing->titre }}</h2>
                    <p class="text-gray-600 mb-2">{{ Str::limit($listing->description, 60) }}</p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-blue-700 font-bold">{{ number_format($listing->prix, 2) }} €</span>
                        <a href="{{ route('listings.show', $listing) }}" class="text-blue-600 hover:underline">Voir plus</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $listings->links() }}
        </div>
    @else
        <p>Aucun appartement trouvé pour cette recherche.</p>
    @endif
</div>
@endsection