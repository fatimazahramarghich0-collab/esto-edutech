<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Str;

class SessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {

        //Implementing the rate limite functionality
        $this->ensureIsNotRateLimited($request);

        // Validate the request data
        $validatedAttributes = $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|min:8|max:100',
        ]);

        // Determine if "remember me" is checked
        $remember = $request->has('remember');

        // Attempt to log in the user using different guards
        if (Auth::guard('admin')->attempt($validatedAttributes, $remember)) {

            return redirect()->route('admin.dashboard');

        } elseif (Auth::guard('student')->attempt($validatedAttributes, $remember)) {

            return redirect()->route('student.dashboard');

        } elseif (Auth::guard('teacher')->attempt($validatedAttributes, $remember)) {

            return redirect()->route('teacher.dashboard');

        } else {
            throw ValidationException::withMessages(
                [
                    'email' => 'Sorry, These credentials do not match our records.'
                ]);
        }
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();
        return Redirect::route('home');
    }

    private function ensureIsNotRateLimited($request): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    private function throttleKey($request): string
    {
        return Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());
    }

    public function logout()
    {
        if (Auth::guard('teacher')->check()) {
            Auth::guard('teacher')->logout();
        } elseif (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();
        } elseif (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        return redirect()->route('login');
    }
}
