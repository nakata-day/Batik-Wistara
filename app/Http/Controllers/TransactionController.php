<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        $transactions = Transaction::with('items', 'user')->get();
        return view('transaction', compact('transactions'));
    }

    // Form untuk membuat transaksi
    public function create()
    {
        $products = Product::all();
        return view('shopping', compact('products'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $transaction = DB::transaction(function () use ($data) {
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'transaction_date' => now(),
                'total_price' => 0,
            ]);

            $totalPrice = 0;

            foreach ($data['products'] as $productData) {
                $product = Product::find($productData['id']);
                $quantity = $productData['quantity'];
                $price = $product->harga_produk * $quantity;

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'name' => $product->nama_produk,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);

                $totalPrice += $price;
            }

            $transaction->update(['total_price' => $totalPrice]);

            return $transaction;
        });

        return redirect()->route('transaction.index')->with('success', 'Transaction created successfully.');
    }

    // Menghapus transaksi
    public function destroy(Transaction $transaction)
    {
        DB::transaction(function () use ($transaction) {
            foreach ($transaction->items as $item) {
                $product = $item->product;
                $product->jumlah_stok += $item->quantity;
                $product->save();
            }

            $transaction->delete();
        });

        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dihapus!');
    }

    public function productPerformance(Request $request)
    {
        // Ambil parameter filter dari request
        $day = $request->input('day');
        $month = $request->input('month');
        $year = $request->input('year');

        // Query dasar untuk menghitung total penjualan produk
        $query = TransactionItem::selectRaw('name, SUM(quantity) as total_sales')
            ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id') // Pastikan join dengan tabel transaksi jika diperlukan
            ->groupBy('name');

        // Terapkan filter berdasarkan hari, bulan, atau tahun jika ada
        if ($day) {
            $query->whereDay('transactions.created_at', $day); // Filter berdasarkan hari
        }
        if ($month) {
            $query->whereMonth('transactions.created_at', $month); // Filter berdasarkan bulan
        }
        if ($year) {
            $query->whereYear('transactions.created_at', $year); // Filter berdasarkan tahun
        }

        // Eksekusi query
        $productSales = $query->get();

        // Kirim data ke view
        return view('product_performance', compact('productSales', 'day', 'month', 'year'));
    }

    public function recapTransaction(Request $request)
    {
        // Ambil parameter filter dari request
        $day = $request->input('day');
        $month = $request->input('month');
        $year = $request->input('year');

        // Query dasar untuk mengambil data transaksi dengan user dan item
        $query = Transaction::with('user', 'items');

        // Terapkan filter jika semua parameter tanggal, bulan, dan tahun diisi
        if ($day && $month && $year) {
            $query->whereDate('transaction_date', '=', "$year-$month-$day");
        }

        // Eksekusi query
        $transactions = $query->get();

        // Hitung total pendapatan
        $totalRevenue = $transactions->sum('total_price');

        // Kirim data ke view
        $title = ($day && $month && $year)
            ? "Rekap Pendapatan Transaksi TernakMart pada " . date('d F Y', strtotime("$year-$month-$day"))
            : "Rekap Pendapatan Transaksi TernakMart";

        return view('recap', compact('transactions', 'totalRevenue', 'title', 'day', 'month', 'year'));
    }

    // Method for daily recap
    public function dailyRecap()
    {
        // Implement the logic for daily recap
        $transactions = Transaction::whereDate('transaction_date', now()->toDateString())->get();
        $totalRevenue = $transactions->sum('total_price');
        $productSales = DB::table('transaction_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_sales'))
            ->groupBy('product_id')
            ->get();
        $dailyRevenue = DB::table('transactions')
            ->select(DB::raw('DATE(transaction_date) as date'), DB::raw('SUM(total_price) as total_revenue'))
            ->groupBy('date')
            ->get();

        return view('daily_recap', compact('transactions', 'totalRevenue', 'productSales', 'dailyRevenue'));
    }

    public function recap(Request $request)
    {
        $transactions = Transaction::with('items', 'user')->get();
        $totalRevenue = $transactions->sum('total_price'); // Calculate total revenue
        $title = 'Rekap Transaksi'; // Define the title variable
        return view('recap', compact('transactions', 'title', 'totalRevenue'));
    }
}