<x-app-layout>
    @push('head-scripts')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6 ">
                <a href="{{route('fms.index')}}" class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y" style="background-color: #C5CAE9;">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">{{\App\Models\Fms::count()}}</div>
                                <div class="mt-1 text-base  font-bold text-gray-600">
                                    Digital Files
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=edfZvVT6w125&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:;" class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y" style="background-color: #E1F5FE;">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">{{\Spatie\MediaLibrary\MediaCollections\Models\Media::count()}}</div>
                                <div class="mt-1 text-base  font-bold text-gray-600">
                                    Digitized Scan Files
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=42918&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{route('fms.index',['filter[type]'=> 'sphone_snet_br'])}}" class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y" style="background-color: #E8F5E9;">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{\App\Models\Fms::where('type','sphone_snet_br')->count()}}
                                </div>
                                <div class="mt-1 text-base  font-bold text-gray-600">
                                    SPHONE/SNET Br
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=53871&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{route('fms.index',['filter[type]'=> 'sfiber_br'])}}" class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y" style="background-color: #FFFDE7;">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{\App\Models\Fms::where('type','sfiber_br')->count()}}
                                </div>
                                <div class="mt-1 text-base  font-bold text-gray-600">
                                    SFIBER Br
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=47051&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>


                <a href="{{route('fms.index',['filter[type]'=> 'revenue_br'])}}" class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white" style="background-color: #FBE9E7;">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{\App\Models\Fms::where('type','revenue_br')->count()}}
                                </div>
                                <div class="mt-1 text-base  font-bold text-gray-600">
                                    REVENUE Br
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=uMqpHOMmc9di&format=png" alt="revenue br" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>


                <a href="{{route('fms.index',['filter[type]'=> 'recovery_br'])}}" class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y" style="background-color: #F9FBE7;">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{\App\Models\Fms::where('type','recovery_br')->count()}}
                                </div>
                                <div class="mt-1 text-base  font-bold text-gray-600">
                                    RECOVERY Br
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=Fj1kL6hV4KOk&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>

            </div>

            <div class="grid grid-cols-2 gap-6">
                <div class="bg-white rounded-lg shadow-lg p-4 mt-4" id="chart_bar"  ></div>
                <div class="bg-white rounded-lg shadow-lg p-4 mt-4" id="chart" ></div>
            </div>



            <script>


                var options_bar = {
                    series: [{
                        name: "",
                        data: [6, 3, 1, 1]
                    }],
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    title: {
                        text: 'Digitization By Category',
                        align: 'left'
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            horizontal: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        categories: ['SPHONE/SNET Br', 'SFIBER Br', 'REVENUE Br', 'RECOVERY Br']
                    },
                    colors: [
                        function ({ value, seriesIndex, dataPointIndex }) {
                            // Generate a random color for each bar
                            return '#' + Math.floor(Math.random() * 16777215).toString(16);
                        },
                        function ({ value, seriesIndex, dataPointIndex }) {
                            // Generate a random color for each bar
                            return '#' + Math.floor(Math.random() * 16777215).toString(16);
                        },
                        function ({ value, seriesIndex, dataPointIndex }) {
                            // Generate a random color for each bar
                            return '#' + Math.floor(Math.random() * 16777215).toString(16);
                        },
                        function ({ value, seriesIndex, dataPointIndex }) {
                            // Generate a random color for each bar
                            return '#' + Math.floor(Math.random() * 16777215).toString(16);
                        }
                    ]
                };

                var chart_bar = new ApexCharts(document.querySelector("#chart_bar"), options_bar);
                chart_bar.render();

                var options = {
                    series: [{
                        name: "",
                        data: [@foreach($weeks as $key => $value) {{$value}}, @endforeach]
                    }],
                    chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                            enabled: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'straight'
                    },
                    title: {
                        text: 'Digitization File Trends by Week',
                        align: 'left'
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                    },
                    xaxis: {
                        categories: ['1st Week', '2nd Week', '3rd Week', '4th Week'],
                    }
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();





            </script>
{{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">--}}


{{--                <x-welcome />--}}


{{--            </div>--}}
        </div>
    </div>

</x-app-layout>
