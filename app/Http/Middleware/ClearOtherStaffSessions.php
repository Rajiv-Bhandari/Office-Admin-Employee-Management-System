<?php

// app/Http/Middleware/ClearOtherStaffSessions.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;

class ClearOtherStaffSessions
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user() instanceof Staff) {
            $user = Auth::user();
            $sessionToken = $request->session()->get('session_token');

            // Check if the session_token in the database matches the one in the current session
            if ($user->session_token !== $sessionToken) {
                // Clear the session_token in the staff table
                $user->update(['session_token' => null]);

                // Redirect to the login page with a message indicating the session logout
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->withErrors('You have been logged out from other devices.');
            }
        }

        return $next($request);
    }
}
