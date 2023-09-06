<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $credentials = [
            'username' => $input['username'],
            'password' => $input['password'],
        ];

        if (auth()->attempt($credentials)) {
            
            // Memeriksa apakah pengguna memiliki peran 'student'
            if (Auth::user()->role === 'student') {
                auth()->logout(); // Log out the student user
                return redirect()->route('login')->withErrors('Siswa tidak dapat login memlalui website ini.');
            } else {
                alert()->toast('Welcome <b>' . Auth::user()->username . '</b>, you have been successfully logged in!', 'success')->position('top-end');
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')->withErrors('Username atau Password Salah.');
        }
    }
}
