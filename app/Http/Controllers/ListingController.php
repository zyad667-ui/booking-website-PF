<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->hasRole('admin')) {
            $listings = Listing::with('user')->get();
        } elseif ($user->hasRole('host')) {
            $listings = $user->listings;
        } else {
            $listings = Listing::where('statut', 'publie')->get();
        }
        
        return view('listings.index', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'adresse' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['statut'] = 'en_attente';

        Listing::create($validated);

        return redirect()->route('listings.index')->with('success', 'Annonce créée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $listing = Listing::with(['user', 'reviews', 'images'])->findOrFail($id);
        return view('listings.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listing = Listing::findOrFail($id);
        
        // Vérifier les permissions
        $user = auth()->user();
        if (!$user->hasRole('admin') && $listing->user_id !== $user->id) {
            abort(403);
        }
        
        return view('listings.edit', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $listing = Listing::findOrFail($id);
        
        // Vérifier les permissions
        $user = auth()->user();
        if (!$user->hasRole('admin') && $listing->user_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'adresse' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
        ]);

        $listing->update($validated);

        return redirect()->route('listings.index')->with('success', 'Annonce mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $listing = Listing::findOrFail($id);
        
        // Vérifier les permissions
        $user = auth()->user();
        if (!$user->hasRole('admin') && $listing->user_id !== $user->id) {
            abort(403);
        }

        $listing->delete();

        return redirect()->route('listings.index')->with('success', 'Annonce supprimée avec succès !');
    }
}
