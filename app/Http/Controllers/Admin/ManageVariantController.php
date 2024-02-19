<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ManageVariantController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id_product',
            'variant_name' => 'required|string',
            'variant_price' => 'required|numeric',
            'variant_stock' => 'required|integer|min:0',
            'variant_weight' => 'required|numeric|min:0',
            // tambahkan validasi untuk atribut lainnya jika diperlukan
        ]);

        ProductVariant::create([
            'id_product' => $request->product_id,
            'name' => $request->variant_name,
            'price' => $request->variant_price,
            'stock' => $request->variant_stock,
            'weight' => $request->variant_weight,
            // tambahkan atribut lainnya sesuai kebutuhan
        ]);

        return redirect()->back()->with('success', 'Variant berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        try {
            $variant = ProductVariant::findOrFail($id);
            $variant->delete();
            return redirect()->back()->with('success', 'Variant berhasil dihapus.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Variant tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus variant.');
        }
    }
}
