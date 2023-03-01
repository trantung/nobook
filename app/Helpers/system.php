<?php

use Illuminate\Support\Facades\Auth;
use App\User;

if (!function_exists('get_logged_in_user')) {
    function get_logged_in_user(): ?User
    {
        return Auth::user();
    }
}

if (! function_exists('log_exception')) {
    function log_exception(Exception $exception) {
        \Log::error($exception);
    }
}

if (!function_exists('route_with_add_action')) {
    function route_with_add_action(string $route): string {
        $explode = explode('.', $route);
        $addAction = request()->add_action;
        if ($addAction == 'add') {
            $explode[2] = 'create';
        } elseif ($addAction == 'list') {
            $explode[2] = 'index';
        }

        return implode('.', $explode);
    }
}
