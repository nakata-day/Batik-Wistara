<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - BatikWistara</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - Admin</h1>
        <div class="space-x-4">
            <a href="<?php echo e(route('catalogue.index')); ?>" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Back</a>
        </div>
    </nav>

    <!-- Add Product Page -->
    <div class="bg-gray-900 shadow-lg rounded-lg p-8 w-full max-w-3xl mx-auto mt-4 mb-4">
        <h1 class="text-3xl font-bold text-center text-white mb-6">Tambah Produk</h1>

        <form action="<?php echo e(route('product.store')); ?>" method="POST" class="bg-gray-800 p-6 rounded shadow-md space-y-4">
            <?php echo csrf_field(); ?>
            <h2 class="text-2xl text-center text-white font-bold">Add Product</h2>
            <label for="kategori_produk" class="text-white">Kategori Produk:</label>
            <select name="kategori_produk" id="kategori_produk" class="w-full border p-2 rounded">
                <option value="batik tulis">Batik Tulis</option>
                <option value="batik cap">Batik Cap</option>
            </select>

            <label for="kategori_motif" class="text-white">Kategori Motif:</label>
            <select name="kategori_motif" id="kategori_motif" class="w-full border p-2 rounded">
                <option value="motif parang">Motif Parang</option>
                <option value="motif kawung">Motif Kawung</option>
            </select>

            <label for="nama_produk" class="text-white">Nama Produk:</label>
            <input type="text" name="nama_produk" id="nama_produk" class="w-full border p-2 rounded" required>

            <label for="harga_produk" class="text-white">Harga Produk:</label>
            <input type="number" name="harga_produk" id="harga_produk" class="w-full border p-2 rounded" required>

            <label for="jumlah_stok" class="text-white">Jumlah Stok:</label>
            <input type="number" name="jumlah_stok" id="jumlah_stok" class="w-full border p-2 rounded" required>

            <button type="submit" class="w-full bg-blue-500 text-white hover:bg-blue-600 p-2 rounded">Add Product</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html><?php /**PATH D:\Apps\laragon\www\batikwistara\resources\views/add_product.blade.php ENDPATH**/ ?>