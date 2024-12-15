<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - BatikWistara</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - Admin</h1>
        <div class="space-x-4">
            <a href="{{ route('product.index') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Back</a>
        </div>
    </nav>

    <!-- Edit Product Page -->
    <div class="bg-gray-900 shadow-lg rounded-lg p-8 w-full max-w-3xl mx-auto mt-4 mb-4">
        <h1 class="text-3xl font-bold text-center text-white mb-6">Edit Produk</h1>

        <form action="{{ route('product.update', $product->id) }}" method="POST" class="bg-gray-800 p-6 rounded shadow-md space-y-4">
            @csrf
            @method('PUT')
            <h2 class="text-2xl text-center text-white font-bold">Edit Product</h2>
            <label for="kategori_produk" class="text-white">Kategori Produk:</label>
            <select name="kategori_produk" id="kategori_produk" class="w-full border p-2 rounded">
                <option value="batik tulis" {{ $product->kategori_produk == 'batik tulis' ? 'selected' : '' }}>Batik Tulis</option>
                <option value="batik cap" {{ $product->kategori_produk == 'batik cap' ? 'selected' : '' }}>Batik Cap</option>
            </select>

            <label for="kategori_motif" class="text-white">Kategori Motif:</label>
            <select name="kategori_motif" id="kategori_motif" class="w-full border p-2 rounded">
                <option value="motif parang" {{ $product->kategori_motif == 'motif parang' ? 'selected' : '' }}>Motif Parang</option>
                <option value="motif kawung" {{ $product->kategori_motif == 'motif kawung' ? 'selected' : '' }}>Motif Kawung</option>
            </select>

            <label for="nama_produk" class="text-white">Nama Produk:</label>
            <input type="text" name="nama_produk" id="nama_produk" value="{{ $product->nama_produk }}" class="w-full border p-2 rounded" required>

            <label for="harga_produk" class="text-white">Harga Produk:</label>
            <input type="number" name="harga_produk" id="harga_produk" value="{{ $product->harga_produk }}" class="w-full border p-2 rounded" required>

            <label for="jumlah_stok" class="text-white">Jumlah Stok:</label>
            <input type="number" name="jumlah_stok" id="jumlah_stok" value="{{ $product->jumlah_stok }}" class="w-full border p-2 rounded" required>

            <button type="submit" class="w-full bg-blue-500 text-white hover:bg-blue-600 p-2 rounded">Update Product</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html>