<?php

use Illuminate\Support\Facades\Auth;
use App\User;

if (!function_exists('get_logged_in_user')) {
    function get_logged_in_user(): ?User
    {
        return Auth::user();
    }
}
