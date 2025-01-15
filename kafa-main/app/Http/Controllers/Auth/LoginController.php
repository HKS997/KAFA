<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        if (auth()->attempt(['email' => $input['email'], 'password' => $input['password'], 'role' => $input['role']])) {
            if (auth()->user()->role == 'Kafa') {
                return redirect()->route('kafa.dashboard');
            } elseif (auth()->user()->role == 'Muip') {
                return redirect()->route('muip.dashboard');
            } elseif (auth()->user()->role == 'Parent') {
                return redirect()->route('parent.dashboard');
            } elseif (auth()->user()->role == 'Teacher') {
                return redirect()->route('teacher.dashboard');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')->with('error', 'Your credential is not proper');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
