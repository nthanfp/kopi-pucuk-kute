<?php

namespace App\Http\Controllers;

use App\Models\WebProfile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Mengambil data profil perusahaan dengan ID 1
        $webProfile = WebProfile::findOrFail(1);

        // Mengirim data profil perusahaan ke view 'home'
        return view('home', ['webProfile' => $webProfile]);
    }

    public function showHome()
    {
        return view('home');
    }

    public function showCart()
    {
        return view('cart.list');
    }
}
