<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo()
    {
        $role = Auth::user()->id;
        switch ($role) {
            default:
                return '/login';
            break;
        }
    }

    public function loginUser(Request $request)
    {
       // dd($request->all());
        $check = User::where('username',$request->username)->first();
        if($check)
        {
            if(!Hash::check($request->password , $check->password  ) )
            {
                return redirect()->back()->with('error','Password anda salah');
            }
            
            //fungso login
            $user = User::find($check->id);
            Auth::login($user);
            return redirect('dashboard');
        }else{
            return redirect()->back()->with('error','Username anda salah');
        }
    }
}