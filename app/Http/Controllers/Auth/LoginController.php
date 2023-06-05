<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Http\Request;

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

    /**
     * @param $provider
     * 
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param $provider
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        try {
            $userSocialite = Socialite::driver($provider)->user();
            $user = User::where('email', $userSocialite->getEmail())->first();

            if($user){
                auth()->login($user, true);

                return redirect('cv-kerja')->with(['success' => 'Berhasil login']);
            }

            $user = User::create([
                'email'             => $userSocialite->getEmail(),
                'name'              => $userSocialite->getName(),
                'password'          => 0,
                'email_verified_at' => now()
            ]);
    
            auth()->login($user, true);

            return redirect('cv-kerja')->with(['success' => 'Berhasil login']);

        } catch (\Exception $e) {
            return redirect('cv-kerja')->with(['error' => 'Gagal login']);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
 
        $request->session()->flush();
        $request->session()->regenerate();
 
        return redirect('cv-kerja')->with(['success' => 'Berhasil logout']);
    }
}
