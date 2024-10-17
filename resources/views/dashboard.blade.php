<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-blue-100 p-4 rounded-lg shadow">
                        <a href="{{ route('items.index') }}" class="block text-blue-800 hover:text-blue-600">
                            <h4 class="font-semibold">Total Items</h4>
                            <p class="text-2xl font-bold">{{ $totalItems }}</p>
                        </a>
                    </div>

                    <div class="bg-yellow-100 p-4 rounded-lg shadow">
                        <a href="{{ route('items.index') }}?low_stock=true" class="block text-yellow-800 hover:text-yellow-600">
                            <h4 class="font-semibold">Low Stock Items</h4>
                            <p class="text-2xl font-bold">{{ $lowStockItems }}</p>
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <h4 class="font-semibold text-center py-2 border-b">Items by Supplier</h4>
                        <div class="h-64">
                            <canvas id="supplierChart"></canvas>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <h4 class="font-semibold text-center py-2 border-b">Items by Category</h4>
                        <div class="h-64">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctxSupplier = document.getElementById('supplierChart').getContext('2d');
            const supplierChart = new Chart(ctxSupplier, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($suppliers) !!},
                    datasets: [{
                        label: 'Items by Supplier',
                        data: {!! json_encode($supplierCounts) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(200, 200, 200, 0.5)',
                            },
                            title: {
                                display: true,
                                text: 'Number of Items',
                                color: 'gray',
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(200, 200, 200, 0.5)',
                            }
                        }
                    }
                }
            });

            const ctxCategory = document.getElementById('categoryChart').getContext('2d');
            const categoryChart = new Chart(ctxCategory, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($categories) !!},
                    datasets: [{
                        label: 'Items by Category',
                        data: {!! json_encode($categoryCounts) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)'
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (context.parsed !== null) {
                                        label += ': ' + context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
