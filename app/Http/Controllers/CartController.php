<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addToCart(Request $request)
    {
        // Validasi request
        $request->validate([
            'product_id' => 'required|exists:products,id_product',
            'variant_id' => 'required|exists:product_variants,id_variant',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id');
        $quantity = $request->input('quantity');

        // Ambil data produk dan varian dari database
        $product = Product::findOrFail($productId);
        $variant = $product->variants()->findOrFail($variantId);

        // Pastikan stok mencukupi
        if ($variant->stock < $quantity) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        // Hitung total harga
        $totalPrice = $quantity * $variant->price;

        // Tambahkan item ke keranjang belanja dalam sesi
        $cart = session()->get('cart');

        // Jika keranjang belanja masih kosong, inisialisasi array
        if (!$cart) {
            $cart = [
                $variantId => [
                    'product_id' => (int) $productId,
                    'variant_id' => (int) $variantId,
                    'name' => $product->name,
                    'description' => $product->description,
                    'variant_name' => $variant->name,
                    'price' => $variant->price,
                    'quantity' => (int) $quantity,
                    'total_price' => $totalPrice,
                    'image' => $product->image_url,
                    'stock' => $variant->stock,
                ]
            ];

            session()->put('cart', $cart);

            return back()->with('success', 'Item berhasil ditambahkan ke keranjang belanja.');
        }

        // Jika item sudah ada dalam keranjang belanja, update jumlahnya
        if (isset($cart[$variantId])) {
            $cart[$variantId]['quantity'] += $quantity;
            $cart[$variantId]['total_price'] += $totalPrice;
            session()->put('cart', $cart);

            return back()->with('success', 'Jumlah item berhasil diperbarui dalam keranjang belanja.');
        }

        // Jika item belum ada dalam keranjang belanja, tambahkan baru
        $cart[$variantId] = [
            'product_id' => (int) $productId,
            'variant_id' => (int) $variantId,
            'name' => $product->name,
            'description' => $product->description,
            'variant_name' => $variant->name,
            'price' => $variant->price,
            'quantity' => (int) $quantity,
            'total_price' => $totalPrice,
            'image' => $product->image_url,
            'stock' => $variant->stock,
        ];

        session()->put('cart', $cart);

        return back()->with('success', 'Item berhasil ditambahkan ke keranjang belanja.');
    }

    public function showCart()
    {
        // Ambil data keranjang belanja dari sesi
        $cart = session()->get('cart');

        return view('cart.list', compact('cart'));
    }

    public function updateCart(Request $request)
    {
        // Validasi request
        $request->validate([
            'cart_items.*.variant_id' => 'required|exists:product_variants,id_variant',
            'cart_items.*.quantity' => 'required|integer|min:1',
        ]);

        // Ambil data dari request
        $cartItems = $request->input('cart_items');

        // Ambil data keranjang belanja dari sesi
        $cart = session()->get('cart');

        // Lakukan iterasi untuk setiap item dalam keranjang belanja yang diterima dari permintaan
        foreach ($cartItems as $item) {
            $variantId = $item['variant_id'];
            $quantity = $item['quantity'];

            // Periksa apakah item ada dalam keranjang belanja sesi
            if (isset($cart[$variantId])) {
                // Periksa apakah jumlah yang diminta melebihi stok yang tersedia
                $variant = ProductVariant::findOrFail($variantId);
                if ($quantity > $variant->stock) {
                    return response()->json(['success' => false, 'message' => 'Stok tidak mencukupi untuk ' . $variant->name]);
                }

                // Update jumlah item sesuai dengan data yang diterima dari permintaan
                $cart[$variantId]['quantity'] = $quantity;
                // Hitung total harga ulang berdasarkan jumlah yang baru
                $cart[$variantId]['total_price'] = $quantity * $cart[$variantId]['price'];
            }
        }

        // Simpan kembali data keranjang belanja yang telah diperbarui ke dalam sesi
        session()->put('cart', $cart);

        // Berikan respons yang sesuai
        return response()->json(['success' => true, 'message' => 'Cart updated successfully']);
    }

    public function deleteCartItem(Request $request)
    {
        // Validasi request
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id_variant',
        ]);

        // Ambil variant_id dari request
        $variantId = $request->input('variant_id');

        // Ambil data keranjang belanja dari sesi
        $cart = session()->get('cart');

        // Periksa apakah item ada dalam keranjang belanja sesi
        if (isset($cart[$variantId])) {
            // Hapus item dari keranjang belanja sesi
            unset($cart[$variantId]);
            // Simpan kembali data keranjang belanja yang telah diperbarui ke dalam sesi
            session()->put('cart', $cart);
            // Berikan respons yang sesuai
            return response()->json(['success' => true, 'message' => 'Item deleted successfully']);
        }

        // Jika item tidak ditemukan dalam keranjang belanja sesi, berikan respons error
        return response()->json(['success' => false, 'message' => 'Item not found in cart'], 404);
    }

    public function showCheckout()
    {
        $cart = session()->get('cart');
        $paymentMethods = Payment::where('status', 'on')->get();

        // Lakukan logika yang diperlukan untuk menyiapkan data untuk halaman checkout
        return view('cart.checkout', compact('cart', 'paymentMethods'));
    }

    public function calculateTotalPrice($cart)
    {
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['total_price'];
        }
        return $totalPrice;
    }

    public function processCheckout(Request $request)
    {

        // Mulai transaksi dalam database menggunakan transaksi
        DB::beginTransaction();

        try {
            // Validasi form checkout
            $request->validate([
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'district' => 'required|string|max:255',
                'village' => 'required|string|max:255',
                'zip_code' => 'required|string|max:10',
                'id_payment' => 'required|exists:payments,id',
            ]);

            // Buat transaksi baru
            $transaction = new Transaction();
            $transaction->id_user = Auth::id();
            $transaction->transaction_date = now();
            $transaction->total_price = $this->calculateTotalPrice($request->session()->get('cart')); // Implementasikan metode ini untuk menghitung total harga
            $transaction->status = 'pending'; // Status awal transaksi
            $transaction->payment_status = 'unpaid'; // Status pembayaran awal
            $transaction->address = $request->input('address');
            $transaction->province = $request->input('province');
            $transaction->city = $request->input('city');
            $transaction->district = $request->input('district');
            $transaction->village = $request->input('village');
            $transaction->zip_code = $request->input('zip_code');
            $transaction->phone = $request->input('phone');
            $transaction->id_payment = $request->input('id_payment');
            $transaction->save();

            // Simpan detail transaksi (item pembelian)
            $cart = session()->get('cart');
            foreach ($cart as $item) {
                $transactionDetail = new TransactionDetail();
                $transactionDetail->id_transaction = $transaction->id_transaction;
                $transactionDetail->id_variant = $item['variant_id'];
                $transactionDetail->id_product = $item['product_id'];
                $transactionDetail->quantity = $item['quantity'];
                $transactionDetail->price = $item['price'];
                $transactionDetail->subtotal = $item['total_price'];
                $transactionDetail->save();
            }

            // Hapus keranjang belanja dari sesi setelah checkout
            session()->forget('cart');

            // Commit transaksi dalam database
            DB::commit();

            // Redirect ke halaman sukses atau lakukan tindakan lainnya
            // return redirect()->route('checkout.success')->with('success', 'Checkout berhasil.');
            return redirect()->back()->with('success', 'Checkout berhasil.');
        } catch (ValidationException $e) {
            // Handling error dari validasi form
            // return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Terjadi kesalahan. Silakan periksa kembali formulir Anda.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke halaman checkout dengan pesan kesalahan
            return redirect()->back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }
}
