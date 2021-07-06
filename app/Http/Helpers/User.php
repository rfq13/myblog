<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

if (! function_exists('areActiveRoutesHome')) {
    function areActiveRoutesHome(Array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }

    }
}
if (! function_exists('cekRole')) {
    function cekRole()
    {
        if (Auth::check() && Auth::user()->user_type == "admin" ) {
            return redirect()->route('admin.login');
        }
    }
}