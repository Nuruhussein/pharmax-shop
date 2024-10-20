<!-- resources/views/analytics/medicine_distribution.blade.php -->
<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Analytics</h1>
         <!-- Total Sales and Total Purchase Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <!-- Total Sales Card -->
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-xl font-semibold mb-4"><i class="fas fa-chart-line"></i> Total Sales</h2>
                <p class="text-2xl font-bold">{{ $totalSales }} USD</p>
            </div>

            <!-- Total Purchase Card -->
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-xl font-semibold mb-4"><i class="fas fa-shopping-cart"></i> Total Purchases</h2>
                <p class="text-2xl font-bold">{{ $totalPurchases }} USD</p>
            </div>
        </div>
        <!-- Medicine Distribution Pie Chart -->
        <div class="bg-white p-4 rounded shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Medicine Distribution</h2>
            <div class="relative w-full" style="max-width: 800px; height: 600px;">
                <canvas id="medicineDistributionChart"></canvas>
            </div>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const medicineDistribution = @json($medicineDistribution);

            new Chart(document.getElementById('medicineDistributionChart').getContext('2d'), {
                type: 'pie',
                data: {
                    labels: medicineDistribution.map(item => item.category_name),
                    datasets: [{
                        label: 'Medicine Distribution by Category',
                        data: medicineDistribution.map(item => item.total_quantity),
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <!-- Product Sales Bar Chart -->
    <div x-data="app({{ json_encode($chartData) }}, {{ json_encode($labels) }})" x-cloak class="px-4">
        <div class="max-w-lg  mx-auto py-10">
            <div class="shadow  p-6 rounded-lg bg-white">
                <div class="md:flex md:justify-between md:items-center">
                    <div>
                        <h2 class="text-xl text-gray-800 font-bold leading-tight">Product Sales</h2>
                        <p class="mb-2 text-gray-600 text-sm">Monthly Average</p>
                    </div>

                    <!-- Legends -->
                    <div class="mb-4">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-blue-600 mr-2 rounded-full"></div>
                            <div class="text-sm text-gray-700">Sales</div>
                        </div>
                    </div>
                </div>

                <div class="line my-8 relative  overflow-x-hidden">
                    <!-- Tooltip -->
                    <template x-if="tooltipOpen == true">
                        <div x-ref="tooltipContainer" class="p-0 m-0 z-10 shadow-lg rounded-lg absolute h-auto block"
                             :style="`bottom: ${tooltipY}px; left: ${tooltipX}px`"
                             >
                            <div class="shadow-xs rounded-lg bg-white p-2">
                                <div class="flex items-center justify-between text-sm">
                                    <div>Sales:</div>
                                    <div class="font-bold ml-2">
                                        <span x-html="tooltipContent"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Bar Chart -->
                    <div class="flex -mx-2 items-end mb-2">
                        <template x-for="data in chartData">

                            <div class="px-2 w-1/6">
                                <div :style="`height: ${Math.round((data / Math.max(...chartData)) * 200)}px`" 
                                     class="transition ease-in duration-200 bg-blue-600 hover:bg-blue-400 relative"
                                     @mouseenter="showTooltip($event); tooltipOpen = true" 
                                     @mouseleave="hideTooltip($event)"
                                     >
                                    <div x-text="data" class="text-center absolute top-0 left-0 right-0 -mt-6 text-gray-800 text-sm"></div>
                                </div>
                            </div>

                        </template>
                    </div>

                    <!-- Labels -->
                    <div class="border-t border-gray-400 mx-auto" :style="`height: 1px; width: ${ 100 - 1/chartData.length*100 + 3}%`"></div>
                    <div class="flex -mx-2 items-end">
                        <template x-for="label in labels">
                            <div class="px-2 w-1/6">
                                <div class="relative">
                                    <div class="text-center absolute top-0 left-0 right-0 h-2 -mt-px bg-gray-400 mx-auto" style="width: 1px"></div>
                                    <div x-text="label" class="text-center absolute top-0 left-0 right-0 mt-3 text-gray-700 text-sm"></div>
                                </div>
                            </div>
                        </template>	
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function app(chartData, labels) {
            return {
                chartData: chartData,
                labels: labels.map(month => month),

                tooltipContent: '',
                tooltipOpen: false,
                tooltipX: 0,
                tooltipY: 0,
                showTooltip(e) {
                    this.tooltipContent = e.target.textContent;
                    this.tooltipX = e.target.offsetLeft - e.target.clientWidth;
                    this.tooltipY = e.target.clientHeight + e.target.clientWidth;
                },
                hideTooltip(e) {
                    this.tooltipContent = '';
                    this.tooltipOpen = false;
                    this.tooltipX = 0;
                    this.tooltipY = 0;
                }
            }
        }
    </script>

</x-app-layout>
