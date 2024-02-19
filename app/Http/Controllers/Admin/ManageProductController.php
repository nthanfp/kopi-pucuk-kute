<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ManageProductController extends Controller
{
    function showPage()
    {
        // Ambil semua data produk dari database
        $products = Product::all();

        // Kirim data produk ke tampilan
        return view('admin.product.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $product->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                // Tambahkan logika untuk memperbarui atribut lainnya jika ada
            ]);

            return redirect()->back()->with('success', 'Produk berhasil diperbarui.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui produk.');
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
