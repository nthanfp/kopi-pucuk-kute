<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ManageVariantController extends Controller
{
    public function index()
    {
        // Implementasi untuk menampilkan daftar variant
    }

    public function create()
    {
        // Implementasi untuk menampilkan form tambah variant
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_product' => 'required|exists:products,id_product',
            'variant_name' => 'required|string',
            'variant_price' => 'required|numeric',
            'variant_stock' => 'required|integer|min:0',
            'variant_weight' => 'required|numeric|min:0',
            // tambahkan validasi untuk atribut lainnya jika diperlukan
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', 'Gagal menambahkan variant.');
        }

        try {
            ProductVariant::create([
                'id_product' => $request->id_product,
                'name' => $request->variant_name,
                'price' => $request->variant_price,
                'stock' => $request->variant_stock,
                'weight' => $request->variant_weight,
                // tambahkan atribut lainnya sesuai kebutuhan
            ]);

            return Redirect::route('admin.product.edit', [$request->id_product])->with('success', 'Variant berhasil ditambahkan.');
        } catch (\Exception $e) {
            return Redirect::back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan variant.');
        }
    }


    public function show($id)
    {
        // Implementasi untuk menampilkan detail variant
    }

    public function edit($id)
    {
        try {
            $variant = ProductVariant::findOrFail($id);
            // Mengambil data produk terkait, jika diperlukan
            $product = $variant->product; // Asumsi relasi antara variant dan produk sudah didefinisikan di model ProductVariant
    
            return view('admin.variant.edit', compact('variant', 'product'));
        } catch (\Exception $e) {
            return Redirect::route('admin.product.edit', [$variant->id_product])->with('error', 'Variant tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_product' => 'required|exists:products,id_product',
            'variant_name' => 'required|string',
            'variant_price' => 'required|numeric',
            'variant_stock' => 'required|integer|min:0',
            'variant_weight' => 'required|numeric|min:0',
            // tambahkan validasi untuk atribut lainnya jika diperlukan
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput()->with('error', 'Gagal memperbarui variant.');
        }

        try {
            $variant = ProductVariant::findOrFail($id);
            $variant->update([
                'id_product' => $request->id_product,
                'name' => $request->variant_name,
                'price' => $request->variant_price,
                'stock' => $request->variant_stock,
                'weight' => $request->variant_weight,
                // tambahkan atribut lainnya sesuai kebutuhan
            ]);

            return Redirect::route('admin.product.edit', [$variant->id_product])->with('success', 'Variant berhasil diperbarui.');
        } catch (\Exception $e) {
            return Redirect::back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui variant.');
        }
    }


    public function destroy($id)
    {
        try {
            $variant = ProductVariant::findOrFail($id);
            $variant->delete();
            return Redirect::route('admin.product.edit', [$variant->id_product])->with('success', 'Variant berhasil dihapus.');
        } catch (\Exception $e) {
            return Redirect::route('admin.product.edit', [$variant->id_product])->with('error', 'Terjadi kesalahan saat menghapus variant.');
        }
    }
}

