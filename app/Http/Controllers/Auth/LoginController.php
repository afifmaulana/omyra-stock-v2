<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $rules =  [
            'email' => 'required|string',
            'password' => 'required|string|min:6'
        ];

        $message = [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min',
        ];

        $this->validate($request, $rules, $message);

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // if (Auth::attempt($credential, $request->remember)) {
        //     return redirect()->intended(route('admin.dashboard.index'));
        // }

        // return redirect()->back()->withInput($request->only('email', 'remember'))
        //     ->withErrors([
        //         'failed' => 'Email/Password yang Anda masukan salah',
        //     ]);

        if (Auth::attempt($credential, true)) {
            $user = Auth::user();
           if ($user->roles->pluck('name')[0] == 'admin') {
                    return redirect()->intended(route('admin.dashboard'));
            }else if ($user->roles->pluck('name')[0] == 'ceo') {
                return redirect()->intended(route('frontend.dashboard.ceo'));
            } else {
                    return redirect()->intended(route('frontend.dashboard.index'));
            }
        } else {
            $errors = new MessageBag(['email' => 'Email atau password salah!']);
            return redirect()->back()->withInput($request->only('email'))
                ->withErrors($errors);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
