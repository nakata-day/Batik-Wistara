<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CatalogueController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter filter dan search dari request
        $kategoriProduk = $request->input('kategori_produk');
        $kategoriMotif = $request->input('kategori_motif');
        $search = $request->input('search');

        // Query produk dengan kondisi filter dan pencarian
        $query = Product::query();

        if ($kategoriProduk) {
            $query->where('kategori_produk', $kategoriProduk);
        }

        if ($kategoriMotif) {
            $query->where('kategori_motif', $kategoriMotif);
        }

        if ($search) {
            $query->where('nama_produk', 'LIKE', '%' . $search . '%');
        }

        $products = $query->get();

        // Kirim data ke view 'catalogue'
        return view('catalogue', compact('products', 'kategoriProduk', 'kategoriMotif', 'search'));
    }
}