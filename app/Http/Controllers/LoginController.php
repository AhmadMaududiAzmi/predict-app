<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $site = Site::all()->first();
        // return view('auth.login', compact('site'));
        return view('auth.login');
    }

    // public function logout(Request $request)
    // {
    //     SystemLog::create([
    //         'type' => 'logout',
    //         'desc' => auth()->user()->name . 'Berhasil Keluar Aplikasi',
    //         'extra' => $request->header('User-Agent')
    //     ]);

    //     Auth::logout();
    //     return redirect('/login');
    // }

    // public function redirectTo()
    // {
    //     $site = Site::all()->first();
    //     if ($site->undercontruction  == true){
    //         if(auth()->user()->role_id == 1){
    //             return '/dashboard';
    //         }
    //         return '/maintenance';
    //     }
    //     return '/dashboard';
    // }
}
