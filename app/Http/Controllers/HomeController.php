<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->email !== 'admin@mail.com') {
            return abort(403);
        }

        $settings = DB::table('settings')->get()->keyBy('key');

        return view('home', [
            'settings' => $settings
        ]);
    }

    public function saveData(Request $request)
    {
        if (auth()->user()->email !== 'admin@mail.com') {
            return abort(403);
        }

        // Ambil semua input dari form, kecuali _token
        $inputs = $request->except('_token');

        foreach ($inputs as $key => $value) {

            // Cek apakah key sudah ada
            $exists = DB::table('settings')->where('key', $key)->first();

            if ($exists) {
                // UPDATE jika sudah ada
                DB::table('settings')
                    ->where('key', $key)
                    ->update([
                        'value' => $value,
                        'updated_at' => now(),
                    ]);
            } else {
                // INSERT jika belum ada
                DB::table('settings')
                    ->insert([
                        'key' => $key,
                        'value' => $value,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
            }
        }

        return redirect()->route('home');
    }
}
