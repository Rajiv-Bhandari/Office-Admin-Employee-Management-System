<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class SessionGuard
{
    public function handle($request, Closure $next)
    {
        // Check if the staff member is logged in
        if (Auth::check()) {
            // Get the user (staff member)
            $user = Auth::user();

            // Check if the user is an instance of the Staff model
            if ($user instanceof Staff) {
                // Check if the session_token is not set in the session
                if (!$request->session()->has('session_token')) {
                    // Generate a new session token and store it in the session
                    $sessionToken = Str::random(60);
                    $request->session()->put('session_token', $sessionToken);

                    // Update the session_token column in the staff table
                    $user->update(['session_token' => $sessionToken]);
                }

                // Check if the session_token in the database matches the one in the current session
                if ($user->session_token !== $request->session()->get('session_token')) {
                    // Log out the staff member from the current session
                    Auth::logout();

                    // Redirect to the login page with a message indicating the session logout
                    return redirect()->route('login')->withErrors('You have been logged out from other devices.');
                }
            }
        }

        return $next($request);
    }
}
