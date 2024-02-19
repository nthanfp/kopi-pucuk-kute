<?php

namespace App\Http\Controllers;

use App\Models\WebProfile;
use Illuminate\Http\Request;

class WebProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $web_profile = WebProfile::findOrFail(1); // Ambil data profil perusahaan dengan ID 1
        return view('admin.web-profile.show', compact('web_profile')); // Kirim data ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WebProfile $webProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WebProfile $webProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WebProfile $webProfile)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'logo' => 'nullable|string',
            'favicon' => 'nullable|string',
        ]);
    
        // Cari data web profile dengan id = 1
        $webProfile = WebProfile::find(1);
    
        if ($webProfile) {
            $webProfile->update($validatedData);
            return redirect()->back()->with('success', 'Web profile berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Web profile tidak ditemukan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebProfile $webProfile)
    {
        //
    }
}
