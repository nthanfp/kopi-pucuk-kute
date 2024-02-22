<?php

namespace App\Http\Controllers;

use App\Models\WebProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function update(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'district' => 'nullable|string',
            'village' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,ico|max:2048',
            // Tambahkan validasi untuk kolom lain jika diperlukan
        ]);

        try {
            // Perbarui data profil web dengan ID 1
            $webProfile = WebProfile::findOrFail(1);

            // Proses upload logo jika ada
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('web_profile', 'public');
                $validatedData['logo'] = $logoPath;
            }

            // Proses upload favicon jika ada
            if ($request->hasFile('favicon')) {
                $faviconPath = $request->file('favicon')->store('web_profile', 'public');
                $validatedData['favicon'] = $faviconPath;
            }

            $webProfile->update($validatedData);
            return redirect()->back()->with('success', 'Profil web berhasil diperbarui.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika gagal memperbarui profil web
            return redirect()->back()->with('error', 'Gagal memperbarui profil web.');
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
