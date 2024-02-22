<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Menampilkan profil yang dapat diedit.
     */
    public function show()
    {
        // Ambil data pengguna yang sedang masuk
        $user = Auth::user();

        // Kirim data pengguna ke view
        return view('profile.show', compact('user'));
    }

    /**
     * Memperbarui profil pengguna.
     */
    public function update(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id() . ',id_user',
            'address' => 'nullable|string',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'district' => 'nullable|string',
            'village' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        try {
            // Perbarui data profil pengguna yang sedang masuk
            // Auth::user()->update($validatedData);
            User::where('id_user', Auth::id())->update($validatedData);

            // Redirect kembali dengan pesan sukses
            return redirect()->route('account.profile.show')->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika gagal memperbarui profil
            return redirect()->route('account.profile.show')->with('error', 'Gagal memperbarui profil.');
        }
    }

    public function showTransaction()
    {
        // Mendapatkan riwayat transaksi pengguna yang sedang login
        $transactions = Transaction::where('id_user', Auth::id())->orderBy('transaction_date', 'desc')->get();

        // Mengirim data transaksi ke tampilan
        return view('profile.transaction', ['transactions' => $transactions]);
    }

    public function showDetail($id)
    {
        // Retrieve transaction details from the database based on the $id
        $transaction = Transaction::findOrFail($id);

        // Return the view with transaction details
        return view('profile.transaction-detail', compact('transaction'));
    }
}
