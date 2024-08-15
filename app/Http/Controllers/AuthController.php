<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function create(): View
    {
        return view('lich-su-mua-hang.dang-nhap');
    }
    /**
     * Handle an authentication attempt.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            $request->session()->regenerate();

            return redirect()->route('lich-su-mua-hang.index');
        }

        return back()->withErrors([
            'errors' => [
                'message' => 'Incorrect credentials',
            ]
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->back();
    }
}
