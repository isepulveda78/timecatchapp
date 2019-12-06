<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
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

}