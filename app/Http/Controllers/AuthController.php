<?php

namespace GaziWorks\Performance\Http\Controllers;

use GaziWorks\Performance\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function getLogin()
    {
        if (auth()->check()) {
            return redirect()->intended(route('dashboard'));
        }

        return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $request)
    {
        if (auth()->attempt($request->only('username', 'password'))) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('auth.login')->withErrors([
            'login' => 'The credentials you entered did not match our records. Try again...',
        ]);
    }

    public function getLogout()
    {
        auth()->logout();

        return redirect()->route('auth.login');
    }
}
