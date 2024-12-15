<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Recap - BatikWistara</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">BatikWistara</h1>
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Back</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-4">
        <h2 class="text-4xl text-center font-bold mb-4">Kinerja Penjualan Harian</h2>
        <!-- Canvas for Product Sales Chart -->
        <canvas id="dailyRecapChart" width="400" height="200"></canvas>
        <!-- Total Revenue -->
        <div class="mt-6 p-4 bg-green-100 rounded shadow text-green-800 mb-4">
            <h3 class="text-xl font-bold">Total Revenue Today: Rp{{ number_format($totalRevenue, 0, ',', '.') }}</h3>
        </div>
        <h2 class="text-4xl text-center font-bold mb-4">Grafik Pendapatan Ternakmart</h2>
        <!-- Canvas for Daily Revenue Chart -->
        <canvas id="dailyRevenueChart" width="400" height="200" class="mt-6"></canvas>
    </div>

    <div class="p-6">
        @foreach ($transactions as $transaction)
            <div class="bg-gray-100 p-4 rounded shadow-md mb-4">
                <h2 class="text-xl font-bold">Transaction ID: {{ $transaction->id }}</h2>
                <p>User: {{ $transaction->user->name }}</p>
                <p>Date: {{ $transaction->transaction_date }}</p>
                <p>Total Price: {{ $transaction->total_price }}</p>
                <h3 class="text-lg font-bold">Items:</h3>
                <ul>
                    @foreach ($transaction->items as $item)
                        <li>{{ $item->name }} - {{ $item->quantity }} x {{ $item->price }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 BatikWistara. All Rights Reserved.</p>
    </footer>

    <!-- JavaScript to Render Charts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var productNames = {!! json_encode($productSales->pluck('name')) !!};
            var productSales = {!! json_encode($productSales->pluck('total_sales')) !!};
            var dailyRevenueDates = {!! json_encode($dailyRevenue->pluck('date')->map(function($date) { return \Carbon\Carbon::parse($date)->format('Y-m-d'); })) !!};
            var dailyRevenueValues = {!! json_encode($dailyRevenue->pluck('total_revenue')) !!};

            var ctx1 = document.getElementById('dailyRecapChart').getContext('2d');
            var dailyRecapChart = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: productNames,
                    datasets: [{
                        label: 'Total Sales',
                        data: productSales,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var ctx2 = document.getElementById('dailyRevenueChart').getContext('2d');
            var dailyRevenueChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: dailyRevenueDates,
                    datasets: [{
                        label: 'Total Revenue',
                        data: dailyRevenueValues,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>