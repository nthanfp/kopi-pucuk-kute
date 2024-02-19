<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function add(Request $request)
    {
        // Validasi request
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Logika untuk menambahkan item ke keranjang
        // Contoh:
        // $productId = $validatedData['product_id'];
        // $quantity = $validatedData['quantity'];
        
        // Kemudian lakukan penambahan ke keranjang sesuai logika aplikasi Anda

        // Redirect kembali ke halaman sebelumnya
        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
}
