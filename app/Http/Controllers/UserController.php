<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userAvatar()
    {
        $userEmail = Auth::user()->getEmail();

        return response()->json([
            'data' => $userEmail
        ], 200);
    }
}