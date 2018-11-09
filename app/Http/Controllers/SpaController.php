<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpaController extends Controller
{
    public function index() {
        return view('welcome', ['auth_user' => Auth::user() ]);
    }

    public function curr_user() {
        return Auth::user()->get(['id', 'name']);
    }

    public function gen_csrf() {
        return response(csrf_token());
    }

}
