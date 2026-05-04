<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        Password::sendResetLink($request->only('email'));

        // Sempre redireciona para check-email, independente do resultado,
        // para não expor se o e-mail existe ou não no sistema.
        return redirect()
            ->route('auth.check-email')
            ->with('email', $request->email);
    }
}
