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

    //tambahkan script di bawah ini
    public function redirectToProvider(Request $request)
    {
        $data['request'] = json_encode($request->all());

        return Socialite::driver('google')->redirect();
    }
  
  
    //tambahkan script di bawah ini 
    public function handleProviderCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();

            //jika user ada maka langsung di redirect
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb
            if($user != null){
                \auth()->login($user, true);
                return redirect('cv-kerja')->with(['success' => 'Berhasil login']);
            }else{
                $create = User::create([
                    'email'             => $user_google->getEmail(),
                    'name'              => $user_google->getName(),
                    'password'          => 0,
                    'email_verified_at' => now()
                ]);
        
                \auth()->login($create, true);
                return redirect('cv-kerja')->with(['success' => 'Berhasil login']);
            }

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
