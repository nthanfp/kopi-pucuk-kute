<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['showProductList', 'showProductDetail', 'showProductData']);
    }

    public function showProductList()
    {
        // Mengambil semua produk dari database
        $products = Product::with('variants')
            ->select('products.*', DB::raw('MIN(product_variants.price) AS min_price'))
            ->join('product_variants', 'products.id_product', '=', 'product_variants.id_product')
            ->groupBy('products.id_product')
            ->get();


        // Mengirim data produk ke view product.list
        return view('product.list', ['products' => $products]);
    }

    public function showProductDetail($id)
    {
        // Mengambil data produk berdasarkan ID
        $product = Product::findOrFail($id);

        return view('product.detail', compact('product'));
    }

    public function showProductData($id)
    {
        // Mengambil data produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Mengirim data produk ke view product.list
        return view('product.list', ['product' => $product]);
    }
}
