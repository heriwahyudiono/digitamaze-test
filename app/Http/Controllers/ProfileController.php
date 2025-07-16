<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = User::findOrFail($request->query('id'));

        return Inertia::render('Profile', [
            'user' => $user,
        ]);
    }
}
