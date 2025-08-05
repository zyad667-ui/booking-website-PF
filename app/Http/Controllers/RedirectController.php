<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class RedirectController extends Controller
{
    /**
     * Rediriger les utilisateurs vers leur dashboard selon leur rôle
     */
    public function redirectToDashboard(): RedirectResponse
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('host')) {
            return redirect()->route('host.dashboard');
        }

        if ($user->hasRole('client')) {
            return redirect()->route('client.dashboard');
        }

        // Par défaut, rediriger vers le dashboard général
        return redirect()->route('dashboard');
    }
}