<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Task;
use Illuminate\Http\Request;
class UserController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();

        return response()->json([
            'data' => $user
        ], 200);
    }

    public function update(User $user)
    {
        $user->update([
            'name' => request()->name,
            'email' => request()->email,
            'location' => request()->location,
            'title' => request()->title,
            'education' => request()->education,
            'about' => request()->about
        ]);

        return response()->json([
            'data' => $user
        ],200);
    }

    public function show(User $user)
    {
        return response()->json([
            'data' => $user
        ],200);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }  
    
    
    public function tasksCount(User $user)
    {
        return response()->json([
            'data' => $user->tasks()->get()
        ],200);
    }
}