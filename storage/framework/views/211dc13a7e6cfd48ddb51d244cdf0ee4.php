<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - BatikWistara</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - User</h1>
        <div class="space-x-4">
            <a href="<?php echo e(route('catalogue.index')); ?>" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Catalogue</a>
            <a href="<?php echo e(route('transaction.index')); ?>" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Transaction</a>
            <a href="<?php echo e(route('logout')); ?>" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Logout</a>
        </div>
    </nav>

    <!-- Dashboard User Page -->
    <h1 class="text-2xl font-bold p-6">Welcome, <?php echo e(Auth::user()->name); ?></h1>
    <div class="p-6">
        <a href="<?php echo e(route('catalogue.index')); ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">View Catalogue</a>
        <a href="<?php echo e(route('transaction.index')); ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">View Transactions</a>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html><?php /**PATH D:\Apps\laragon\www\batikwistara\resources\views/dashboard_user.blade.php ENDPATH**/ ?>