<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ManageProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        try {
            $products = Product::all();
            return view('admin.product.index', compact('products'));
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')->with('error', 'Failed to fetch products.');
        }
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $imagePath = $request->file('image')->store('product_images', 'public');

            $validatedData['image_url'] = $imagePath;

            Product::create($validatedData);

            return redirect()->route('admin.product.index')->with('success', 'Product created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Terjadi kesalahan. Silakan periksa kembali formulir Anda.');
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')->with('error', 'Failed to create product.');
        }
    }

    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('admin.product.show', compact('product'));
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')->with('error', 'Product not found.');
        }
    }

    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('admin.product.edit', compact('product'));
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')->with('error', 'Product not found.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('product_images', 'public');
                $validatedData['image_url'] = $imagePath;

                Storage::disk('public')->delete($product->image_url);
            }

            $product->update($validatedData);

            return redirect()->route('admin.product.index')->with('success', 'Product updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'Terjadi kesalahan. Silakan periksa kembali formulir Anda.');
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')->with('error', 'Failed to update product.');
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.product.index')->with('error', 'Failed to delete product.');
        }
    }
}
