<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('add_product');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_produk' => 'required|in:batik tulis,batik cap',
            'kategori_motif' => 'required|in:motif parang,motif kawung',
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|integer',
            'jumlah_stok' => 'required|integer',
        ]);

        Product::create($data);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function productList()
    {
        $products = Product::all();
        return view('product', compact('products'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'kategori_produk' => 'required|in:batik tulis,batik cap',
            'kategori_motif' => 'required|in:motif parang,motif kawung',
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|integer',
            'jumlah_stok' => 'required|integer',
        ]);

        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }

    // Method for product performance
    public function performance()
    {
        // Implement the logic for product performance
        $productSales = DB::table('transaction_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_sales'))
            ->groupBy('product_id')
            ->orderBy('total_sales', 'desc')
            ->get();

        return view('product_performance', compact('productSales'));
    }
}