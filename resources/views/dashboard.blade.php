<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- cards -->
    <div class="px-10 align-middle mb-5 items-center">
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
            <div class="shadow rounded-lg py-3 px-5 bg-white text-center">
                <h6 class="text-2xl">Zones</h6>
                <h4 class="text-black text-4xl font-bold">{{ $zone_count }}</h4>
                <p><span class="text-teal-500 font-bold">Total number of zones</p>
            </div>
            <div class="shadow rounded-lg py-3 px-5 bg-white text-center">
                <h6 class="text-2xl">Residents</h6>
                <h4 class="text-black text-4xl font-bold">{{ $resident_count }}</h4>
                <p><span class="text-teal-500 font-bold">Total number of residents</p>
            </div>
            <div class="shadow rounded-lg py-3 px-5 bg-white text-center">
                <h6 class="text-2xl">Scheduled Today</h6>
                <h4 class="text-black text-4xl font-bold">{{ $appointment_count }}</h4>
                <p><span class="text-teal-500 font-bold">Total number of appointments today</p>
            </div>
        </div>
    </div>

    {{-- CHARTS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2">
        <div class="w-full sm:px-6 lg:px-8">
            <div class="shadow-lg rounded-lg overflow-hidden">
                <div class="py-3 px-5 text-xs font-medium tracking-wide bg-gray-800 dark:bg-gray-700 flex justify-center text-white uppercase dark:text-white">
                    Indigency Request Count (CURRENT YEAR)
                </div>
                <canvas class="p-10" id="chartLine"></canvas>
            </div>
        </div>
    
        <div class="w-full sm:px-6 lg:px-8">
            <div class="shadow-lg rounded-lg overflow-hidden">
                <div class="py-3 px-5 text-xs font-medium tracking-wide bg-gray-800 dark:bg-gray-700 flex justify-center text-white uppercase dark:text-white">
                    Top 6 zones by Population
                </div>
                <canvas class="p-10" id="chartBar"></canvas>
            </div>
        </div>
    </div>
    
      
    <!-- Required chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      
    <!-- Chart line -->
    <script>
    var may = '{{ $may_count }}';
    var june = '{{ $june_count }}';
    var july = '{{ $july_count }}';
    var august = '{{ $august_count }}';

    const labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const data = {
        labels: labels,
        datasets: [
        {
            label: "Indigency Request",
            backgroundColor: "hsl(252, 82.9%, 67.8%)",
            borderColor: "hsl(252, 82.9%, 67.8%)",
            data: [0, 0, 0, 0, may, june, july, august, 0, 0, 0 ,0],
        },
        ],
    };
    
    const configLineChart = {
        type: "line",
        data,
        options: {},
    };
    
    var chartLine = new Chart(
        document.getElementById("chartLine"),
        configLineChart
    );
    </script>

    <!-- Chart bar -->
    <script>
        const labelsBarChart = [
        '{{ $zone1 }}',
        '{{ $zone2 }}',
        '{{ $zone3 }}',
        '{{ $zone4 }}',
        '{{ $zone5 }}',
        '{{ $zone6 }}',
        ];
        const dataBarChart = {
        labels: labelsBarChart,
        datasets: [
            {
            label: "Population",
            backgroundColor: "hsl(252, 82.9%, 67.8%)",
            borderColor: "hsl(252, 82.9%, 67.8%)",
            data: ['{{ $zone1_count }}', '{{ $zone2_count }}', '{{ $zone3_count }}', '{{ $zone4_count }}', '{{ $zone5_count }}', '{{ $zone6_count }}'],
            },
        ],
        };
    
        const configBarChart = {
        type: "bar",
        data: dataBarChart,
        options: {},
        };
    
        var chartBar = new Chart(
        document.getElementById("chartBar"),
        configBarChart
        );
    </script>
</x-app-layout>
