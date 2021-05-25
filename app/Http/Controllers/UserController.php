<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json([
            'message' => 'Ajout avec succès',
            'user' => $user 
        ]);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json('Updated successfully');
    }

    public function destroy(User $user)
    {
       $user->delete();
        return response()->json(['message' => 'deleted']);
    }
}
