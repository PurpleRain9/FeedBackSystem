<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dica Feedback</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('noti.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css" rel="stylesheet" />
    {{-- DataTable Cdn --}}

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="toBack d-flex mt-5 me-3">
            <a href="{{ url('/') }}" class="btn btn-primary fw-bold"><i class="fa-solid fa-caret-left"></i>
                Back</a>
        </div>
        <div class="row mt-5">
            {{-- {{ dd($yearly) }} --}}
            <div class="teb-table col-md-6 ms-0">
                <!-- Tabs navs -->
                <ul class="nav nav-tabs nav-fill mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="ex2-tab-1" data-mdb-toggle="tab" href="#ex2-tabs-1"
                            role="tab" aria-controls="ex2-tabs-1" aria-selected="true">Daily Feedback</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="ex2-tab-2" data-mdb-toggle="tab" href="#ex2-tabs-2" role="tab"
                            aria-controls="ex2-tabs-2" aria-selected="false">Monthly Feedback</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="ex2-tab-3" data-mdb-toggle="tab" href="#ex2-tabs-3" role="tab"
                            aria-controls="ex2-tabs-3" aria-selected="false">Yearly Feedback</a>
                    </li>
                </ul>
                <!-- Tabs navs -->

                <!-- Tabs content -->
                <div class="tab-content" id="ex2-content">
                    <div class="tab-pane fade show active" id="ex2-tabs-1" role="tabpanel" aria-labelledby="ex2-tab-1">
                        <div class="dailySelect_div">
                            <div class="form-group">
                                <form action="" id="dailySearchForm">
                                    <div class="form-group row mb-3">

                                        <div class="col-md-4 dailyInDiv">
                                            <input type="month" name="dailyToYMVal" id="dailyToYMVal"
                                                class="form-control" value="{{ date('Y-m') }}">
                                        </div>
                                        <div class="col-sm-4 col-md-4 dailySearchDiv">
                                            <button type="submit" name="submit" class="btn btn-sm btn-primary py-2"
                                                id="dailyYMValBtn"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>

                                        @php
                                            // dd($_SERVER);
                                        @endphp
                                        <div class="col-sm-4 col-md-4 dailyExDiv">
                                            <a class="btn btn-success" id="excel_dalily_download" onclick="showDate()" href="{{ route('data.dailyExcel') }}"><i
                                                    class="fa-solid fa-download"></i> Excel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <table class="table align-middle mb-0 bg-white" id="dailyTable">

                            <thead class="bg-light">
                                <tr>
                                    <th>Daily</th>
                                    <th>Excellent</th>
                                    <th>Normal</th>
                                    <th>Bad</th>
                                </tr>
                            </thead>
                            <tbody id="dailyBody">
                                {{-- {{ dd(date('m')) }} --}}
                                @foreach ($dailies as $key => $day)
                                    <tr>
                                        @if (date('m') == date('m', strtotime($day->date)))
                                            {{-- <td>{{ date('j', strtotime($day->date)) }}</td> --}}
                                            <td>{{ $day->date }}</td>
                                            <td>{{ $day->good }}</td>
                                            <td>{{ $day->normal }}</td>
                                            <td>{{ $day->bad }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="ex2-tabs-2" role="tabpanel" aria-labelledby="ex2-tab-2">
                        <div class="dailySelect_div">
                            <div class="form-group">
                                <form action="" id="Montserchform">
                                    <div class="form-group row mb-3">
                                        <div class="col-md-4">
                                            <input type="text" name="monthsSearch" id="year"
                                                class="form-control" placeholder="search year" value="{{ date('Y') }}">
                                        </div>
                                        <div class="col-sm-4 col-md-4 monthSearchDiv">
                                            <button type="submit" name="submit" class="btn btn-sm btn-primary py-2"
                                                id="month_search_btn"><i
                                                    class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                        <div class="col-sm-4 col-md-4 monthExDIv">
                                            <a class="btn btn-success" id="excel_monthly_download" onclick="showMonth()" href="{{ route('data.exportExcel') }}"><i
                                                    class="fa-solid fa-download"></i> Excel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table  table align-middle mb-0 bg-white" id="months_table">
                            <thead class="bg-light">
                                <tr>
                                    <th>Months</th>
                                    <th>Excellent</th>
                                    <th>Normal</th>
                                    <th>Bad</th>
                                </tr>
                            </thead>
                            <tbody id="monthlyBody">

                                @foreach ($monthly as $month)
                                    <tr>

                                        <td>{{ $month->date }}</td>
                                        <td>{{ $month->good }}</td>
                                        <td>{{ $month->normal }}</td>
                                        <td>{{ $month->bad }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="ex2-tabs-3" role="tabpanel" aria-labelledby="ex2-tab-3">
                        <div class="dailySelect_div">
                            <div class="form-group">
                                <form action="" id="yearlySearch">
                                    <div class="form-group row mb-3">
                                        <div class="col-sm-4 col-md-4 dailyInDiv">
                                            <input type="text" name="yearlySearch" id="yearlySearchVal"
                                                class="form-control" value="{{ date('Y') }}">
                                        </div>
                                        <div class="col-sm-4 col-md-4 dailySearchDiv">
                                            <button type="submit" name="submit" class="btn btn-sm btn-primary py-2"
                                                id="yearSearchDiv"><i
                                                    class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                        <div class="col-sm-4 col-md-4 dailyExDiv">
                                            <a class="btn btn-success" id="excel_yearly_download" onclick="showYear()" href="{{ route('data.yearlyExcel') }}"><i
                                                    class="fa-solid fa-download"></i> Excel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table  table align-middle mb-0 bg-white" id="Yearly_table">
                            <thead class="bg-light">
                                <tr>
                                    <th>Yearly</th>
                                    <th>Excellent</th>
                                    <th>Normal</th>
                                    <th>Bad</th>
                                </tr>
                            </thead>
                            <tbody id="yearlyBody">

                                @foreach ($yearly as $year)
                                    <tr>
                                        <td>{{ $year->date }}</td>
                                        <td>{{ $year->good }}</td>
                                        <td>{{ $year->normal }}</td>
                                        <td>{{ $year->bad }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Tabs content -->
            </div>
            <div class="col-md-6">
                <div class="">
                    <div class="col-md-12">
                        <select class="form-select" id="chartSelect" aria-label="Default select example">
                            <option value="line">Line Chart</option>
                            <option value="bar">Bar Chart</option>
                            <option value="pie">Pie Chart</option>
                            <option value="donut">Donut Chart</option>
                        </select>
                    </div>
                </div>
                <div id="feedback-data">
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    {{-- echart js cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.3.3/dist/echarts.min.js"></script>
    {{-- Chartjs js cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        let url_path = window.location.origin + window.location.pathname; 
        console.log(url_path);
        function showDate() {
            let date = document.getElementById('dailyToYMVal').value;
            date = date.split('-');
            // console.log(window);
            let url_path = window.location.origin + window.location.pathname; 
            document.getElementById('excel_dalily_download').href = "{{ route('data.dailyExcel') }}" + '?month='+date[1]+'&year='+date[0];
            console.log(document.getElementById('excel_dalily_download').href);

        }
        function showMonth() {
            let month = document.getElementById('year').value;
            console.log(month);
            let url_path = window.location.origin + window.location.pathname;
            document.getElementById('excel_monthly_download').href = "{{ route('data.exportExcel') }}" + '?year='+month;
            console.log(document.getElementById('excel_monthly_download').href);
        }

        function showYear() {
            let yearserch = document.getElementById('yearlySearchVal').value;
            console.log(yearserch);
            let url_path = window.location.origin + window.location.pathname;
            document.getElementById('excel_yearly_download').href = "{{ route('data.yearlyExcel') }}" + '?year=' +yearserch;
            console.log(document.getElementById('excel_yearly_download').href);
        }
        function montlyChart() {
            // Initialize the echarts instance based on the prepared dom
            var myChart = echarts.init(document.getElementById('feedback-data'));
            let chartOne = @php echo $feedbackChartOne; @endphp;
            let chartTwo = @php echo $feedbackChartTwo; @endphp;
            let chartThree = @php echo $feedbackChartThree; @endphp;
            let mgs = @php echo $monthlyGood; @endphp;
            let mns = @php echo $monthlyNormal; @endphp;
            let mbs = @php echo $monthlyBad; @endphp;
            

            // For Pie Excellent
            var pieDataOne = [];
            mgs.forEach((mg, i) => {
                mgObj = {
                    name: mg[0],
                    value: mg[1]
                }
                pieDataOne[i] = mgObj;
            });
            // console.log(pieDataOne);

            // Pie For Normal
            var pieDataTwo = [];
            mns.forEach((mn, i) => {
                mnObj = {
                    name: mn[0],
                    value: mn[1]
                }
                pieDataTwo[i] = mnObj;
            })
            // console.log(pieDataTwo);

            var pieDataThree = [];
            mbs.forEach((mb, i) => {
                mbObj = {
                    name: mb[0],
                    value: mb[1]
                }
                pieDataThree[i] = mbObj;
            });
            // console.log(pieDataThree);

            // Specify the configuration items and data for the chart
            var line = {
                title: {

                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ['Excellent', 'Normal', 'Bad']
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                xAxis: {
                    text: 'Months',
                    type: 'category',
                    data: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October',
                        'November', 'December'
                    ],
                    boundaryGap: false,
                },
                yAxis: {
                    type: 'value'
                },
                series: [{
                        color: 'green',
                        name: 'Excellent',
                        type: 'line',
                        stack: 'Total',
                        data: chartOne
                    },
                    {
                        color: 'gray',
                        name: 'Normal',
                        type: 'line',
                        stack: 'Total',
                        data: chartTwo
                    },
                    {
                        color: 'red',
                        name: 'Bad',
                        type: 'line',
                        stack: 'Total',
                        data: chartThree
                    },
                ]
            };

            var bar = {
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                legend: {},
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [{
                    type: 'category',
                    data: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                        'September', 'October',
                        'November', 'December'
                    ],
                }],
                yAxis: [{
                    type: 'value'
                }],
                series: [{
                        name: 'Excellent',
                        type: 'bar',
                        color: 'green',
                        emphasis: {
                            focus: 'series'
                        },
                        data: chartOne
                    },
                    {
                        name: 'Normal',
                        color: 'gray',
                        type: 'bar',
                        emphasis: {
                            focus: 'series'
                        },
                        data: chartTwo
                    },
                    {
                        name: 'Bad',
                        type: 'bar',
                        color: 'red',
                        emphasis: {
                            focus: 'series'
                        },
                        data: chartThree
                    },
                ]
            };

            var pie = {
                title: {
                    text: 'Emoji Of Monthly',
                    subtext: 'Pie Data',
                    left: 'center'
                },
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    bottom: 10,
                    left: 'center'
                },
                series: [{
                        name: 'Excellent',
                        type: 'pie',
                        radius: '20%',
                        center: ['50%', '25%'],
                        datasetIndex: 1,
                        data: pieDataOne,
                    },
                    {
                        name: 'Normal',
                        type: 'pie',
                        radius: '20%',
                        center: ['50%', '50%'],
                        datasetIndex: 2,

                        data: pieDataTwo,
                    },
                    {
                        name: 'Bad',
                        type: 'pie',
                        radius: '20%',
                        center: ['50%', '75%'],
                        datasetIndex: 3,
                        data: pieDataThree,
                    },

                ],
                media: [{
                        query: {
                            minAspectRatio: 1
                        },
                        option: {
                            series: [{
                                    center: ['25%', '50%']
                                },
                                {
                                    center: ['50%', '50%']
                                },
                                {
                                    center: ['75%', '50%']
                                }
                            ]
                        }
                    },
                    {
                        option: {
                            series: [{
                                    center: ['50%', '25%']
                                },
                                {
                                    center: ['50%', '50%']
                                },
                                {
                                    center: ['50%', '75%']
                                }
                            ]
                        }
                    }
                ]
            };

            var donut = {
                title: {
                    text: 'Emoji Of Monthly',
                    subtext: 'Doughnut Data',
                    left: 'center'
                },
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    bottom: 10,
                    left: 'center'
                },
                series: [{
                        name: 'Excellent',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        itemStyle: {
                            borderRadius: 10,
                            borderColor: '#fff',
                            borderWidth: 2
                        },
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '40',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        radius: '30%',
                        center: ['50%', '25%'],
                        datasetIndex: 1,
                        data: pieDataOne,
                    },
                    {
                        name: 'Normal',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        itemStyle: {
                            borderRadius: 10,
                            borderColor: '#fff',
                            borderWidth: 2
                        },
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '40',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        radius: '30%',
                        center: ['50%', '50%'],
                        datasetIndex: 2,

                        data: pieDataTwo,
                    },
                    {
                        name: 'Bad',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        itemStyle: {
                            borderRadius: 10,
                            borderColor: '#fff',
                            borderWidth: 2
                        },
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '40',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        radius: '30%',
                        center: ['50%', '75%'],
                        datasetIndex: 3,
                        data: pieDataThree,
                    }
                ],
                media: [{
                        query: {
                            minAspectRatio: 1
                        },
                        option: {
                            series: [{
                                    center: ['25%', '50%']
                                },
                                {
                                    center: ['50%', '50%']
                                },
                                {
                                    center: ['75%', '50%']
                                }
                            ]
                        }
                    },
                    {
                        option: {
                            series: [{
                                    center: ['50%', '25%']
                                },
                                {
                                    center: ['50%', '50%']
                                },
                                {
                                    center: ['50%', '75%']
                                }
                            ]
                        }
                    }
                ]
            };
            myChart.setOption(line);
            // Display the chart using the configuration items and data just specified.
            $(document).ready(function() {
                // $('#feedback-data').html('');
                $('#chartSelect').on('change', function() {
                    let chartVal = $('#chartSelect').val()
                    // console.log(chartVal);
                    // myChart.destory();
                    if (chartVal === 'line') {

                        myChart.setOption(line, true);

                    }
                    if (chartVal === 'bar') {
                        // myChart.setOption(line).destory()
                        myChart.setOption(bar, true);

                    }
                    if (chartVal === 'pie') {
                        // myChart.setOption(line).destory()
                        myChart.setOption(pie, true);
                    }
                    if (chartVal === 'donut') {
                        // myChart.setOption(line).destory()
                        myChart.setOption(donut, true);
                    }

                });
            });
        }

        function dailyChart() {

            // Initialize the echarts instance based on the prepared dom
            var myChart = echarts.init(document.getElementById('feedback-data'));
            let chartOne = @php echo $DaliyChartOne; @endphp;
            let chartTwo = @php echo $DaliyChartTwo; @endphp;
            let chartThree = @php echo $DaliyChartThree; @endphp;
            let date = @php echo $date; @endphp;
            let dateChange = Object.values(date);
            let changeOne = Object.values(chartOne);
            let changeTwo = Object.values(chartTwo);
            let changeThree = Object.values(chartThree);
            console.log(changeOne);

            var dPieChart = [];
            chartOne.forEach((dp, i) => {
                dpo = {
                    name: dp[0],
                    value: dp[1]
                }
                dPieChart[i] = dpo;
            })
            console.log(dPieChart);
            var dPieChartTwo = [];
            chartTwo.forEach((dpt, i) => {
                dptwo = {
                    name: dpt[0],
                    value: dpt[1]
                }
                dPieChartTwo[i] = dptwo;
            })
            // console.log(dPieChartTwo);

            var dPieChartThree = [];
            chartThree.forEach((dph, i) => {
                dpthree = {
                    name: dph[0],
                    value: dph[1]
                }
                dPieChartThree[i] = dpthree;
            })
            // console.log(dPieChartThree);



            // Specify the configuration items and data for the chart
            var line = {
                title: {

                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ['Excellent', 'Normal', 'Bad']
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                xAxis: {
                    text: 'Months',
                    type: 'category',
                    data: dateChange,
                    boundaryGap: false,
                },
                yAxis: {
                    type: 'value'
                },
                series: [{
                        color: 'green',
                        name: 'Excellent',
                        type: 'line',
                        stack: 'Total',
                        data: changeOne
                    },
                    {
                        color: 'gray',
                        name: 'Normal',
                        type: 'line',
                        stack: 'Total',
                        data: changeTwo
                    },
                    {
                        color: 'red',
                        name: 'Bad',
                        type: 'line',
                        stack: 'Total',
                        data: changeThree
                    },
                ]
            };

            var bar = {
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                legend: {},
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [{
                    type: 'category',
                    data: dateChange
                }],
                yAxis: [{
                    type: 'value'
                }],
                series: [{
                        name: 'Excellent',
                        type: 'bar',
                        color: 'green',
                        emphasis: {
                            focus: 'series'
                        },
                        data: changeOne
                    },
                    {
                        name: 'Normal',
                        color: 'gray',
                        type: 'bar',
                        emphasis: {
                            focus: 'series'
                        },
                        data: changeTwo
                    },
                    {
                        name: 'Bad',
                        type: 'bar',
                        color: 'red',
                        emphasis: {
                            focus: 'series'
                        },
                        data: changeThree
                    },
                ]
            };

            var pie = {
                title: {
                    text: 'Emoji Of Monthly',
                    subtext: 'Pie Data',
                    left: 'center'
                },
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    bottom: 10,
                    left: 'center'
                },
                series: [{
                        name: 'Excellent',
                        type: 'pie',
                        radius: '20%',
                        center: ['50%', '25%'],
                        datasetIndex: 1,
                        data: dPieChart,
                    },
                    {
                        name: 'Normal',
                        type: 'pie',
                        radius: '20%',
                        center: ['50%', '50%'],
                        datasetIndex: 2,

                        data: dPieChartTwo,
                    },
                    {
                        name: 'Bad',
                        type: 'pie',
                        radius: '20%',
                        center: ['50%', '75%'],
                        datasetIndex: 3,
                        data: dPieChartThree,
                    },

                ],
                media: [{
                        query: {
                            minAspectRatio: 1
                        },
                        option: {
                            series: [{
                                    center: ['25%', '50%']
                                },
                                {
                                    center: ['50%', '50%']
                                },
                                {
                                    center: ['75%', '50%']
                                }
                            ]
                        }
                    },
                    {
                        option: {
                            series: [{
                                    center: ['50%', '25%']
                                },
                                {
                                    center: ['50%', '50%']
                                },
                                {
                                    center: ['50%', '75%']
                                }
                            ]
                        }
                    }
                ]
            };

            var donut = {
                title: {
                    text: 'Emoji Of Monthly',
                    subtext: 'Doughnut Data',
                    left: 'center'
                },
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    bottom: 10,
                    left: 'center'
                },
                series: [{
                        name: 'Excellent',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        itemStyle: {
                            borderRadius: 10,
                            borderColor: '#fff',
                            borderWidth: 2
                        },
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '40',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        radius: '30%',
                        center: ['50%', '25%'],
                        datasetIndex: 1,
                        data: dPieChart,
                    },
                    {
                        name: 'Normal',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        itemStyle: {
                            borderRadius: 10,
                            borderColor: '#fff',
                            borderWidth: 2
                        },
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '40',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        radius: '30%',
                        center: ['50%', '50%'],
                        datasetIndex: 2,

                        data: dPieChartTwo,
                    },
                    {
                        name: 'Bad',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        itemStyle: {
                            borderRadius: 10,
                            borderColor: '#fff',
                            borderWidth: 2
                        },
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '40',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        radius: '30%',
                        center: ['50%', '75%'],
                        datasetIndex: 3,
                        data: dPieChartThree,
                    }
                ],
                media: [{
                        query: {
                            minAspectRatio: 1
                        },
                        option: {
                            series: [{
                                    center: ['25%', '50%']
                                },
                                {
                                    center: ['50%', '50%']
                                },
                                {
                                    center: ['75%', '50%']
                                }
                            ]
                        }
                    },
                    {
                        option: {
                            series: [{
                                    center: ['50%', '25%']
                                },
                                {
                                    center: ['50%', '50%']
                                },
                                {
                                    center: ['50%', '75%']
                                }
                            ]
                        }
                    }
                ]
            };
            myChart.setOption(line);
            // Display the chart using the configuration items and data just specified.
            $(document).ready(function() {
                // $('#feedback-data').html('');
                $('#chartSelect').on('change', function() {
                    let chartVal = $('#chartSelect').val()
                    // console.log(chartVal);
                    // myChart.destory();
                    if (chartVal === 'line') {

                        myChart.setOption(line, true);

                    }
                    if (chartVal === 'bar') {
                        // myChart.setOption(line).destory()
                        myChart.setOption(bar, true);

                    }
                    if (chartVal === 'pie') {
                        // myChart.setOption(line).destory()
                        myChart.setOption(pie, true);
                    }
                    if (chartVal === 'donut') {
                        // myChart.setOption(line).destory()
                        myChart.setOption(donut, true);
                    }

                });
            });

        }

        function yearlyChart() {

            // Initialize the echarts instance based on the prepared dom
            var myChart = echarts.init(document.getElementById('feedback-data'));
            let chartOne = @php echo $yearlyChartOne; @endphp;
            let chartTwo = @php echo $yearlyCharTwo; @endphp;
            let chartThree = @php echo $yearlyCharThree; @endphp;

            let forpieOne = @php echo $yearlyPieCharOne; @endphp;
            let forpieTwo = @php echo $yearlyPieCharTwo; @endphp;
            let forpieThree = @php echo $yearlyPieCharThree; @endphp;
            // console.log(forpieOne);
            let date = @php echo $yearDate; @endphp;
            let dateChange = Object.values(date);
            console.log(dateChange);
            let changeOne = Object.values(chartOne);
            let changeTwo = Object.values(chartTwo);
            let changeThree = Object.values(chartThree);
        
            console.log(changeOne);

            var dPieChart = [];
            forpieOne.forEach((dp, i) => {
                dpo = {
                    name: dp[0],
                    value: dp[1]
                }
                dPieChart[i] = dpo;
            })
            // console.log(dPieChart);
            var dPieChartTwo = [];
            forpieTwo.forEach((dpt, i) => {
                dptwo = {
                    name: dpt[0],
                    value: dpt[1]
                }
                dPieChartTwo[i] = dptwo;
            })
            // console.log(dPieChartTwo);

            var dPieChartThree = [];
            forpieThree.forEach((dph, i) => {
                dpthree = {
                    name: dph[0],
                    value: dph[1]
                }
                dPieChartThree[i] = dpthree;
            })
            // console.log(dPieChartThree);



            // Specify the configuration items and data for the chart
            var line = {
                title: {

                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ['Excellent', 'Normal', 'Bad']
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                xAxis: {
                    text: 'Months',
                    type: 'category',
                    data: dateChange,
                    boundaryGap: false,
                },
                yAxis: {
                    type: 'value'
                },
                series: [{
                        color: 'green',
                        name: 'Excellent',
                        type: 'line',
                        stack: 'Total',
                        data: changeOne
                    },
                    {
                        color: 'gray',
                        name: 'Normal',
                        type: 'line',
                        stack: 'Total',
                        data: changeTwo
                    },
                    {
                        color: 'red',
                        name: 'Bad',
                        type: 'line',
                        stack: 'Total',
                        data: changeThree
                    },
                ]
            };

            var bar = {
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                legend: {},
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [{
                    type: 'category',
                    data: dateChange
                }],
                yAxis: [{
                    type: 'value'
                }],
                series: [{
                        name: 'Excellent',
                        type: 'bar',
                        color: 'green',
                        emphasis: {
                            focus: 'series'
                        },
                        data: chartOne
                    },
                    {
                        name: 'Normal',
                        color: 'gray',
                        type: 'bar',
                        emphasis: {
                            focus: 'series'
                        },
                        data: changeTwo
                    },
                    {
                        name: 'Bad',
                        type: 'bar',
                        color: 'red',
                        emphasis: {
                            focus: 'series'
                        },
                        data: changeThree
                    },
                ]
            };

            var pie = {
                title: {
                    text: 'Emoji Of Monthly',
                    subtext: 'Pie Data',
                    left: 'center'
                },
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    bottom: 10,
                    left: 'center'
                },
                series: [{
                        name: 'Excellent',
                        type: 'pie',
                        radius: '20%',
                        center: ['50%', '25%'],
                        datasetIndex: 1,
                        data: dPieChart,
                    },
                    {
                        name: 'Normal',
                        type: 'pie',
                        radius: '20%',
                        center: ['50%', '50%'],
                        datasetIndex: 2,

                        data: dPieChartTwo,
                    },
                    {
                        name: 'Bad',
                        type: 'pie',
                        radius: '20%',
                        center: ['50%', '75%'],
                        datasetIndex: 3,
                        data: dPieChartThree,
                    },

                ],
                media: [{
                        query: {
                            minAspectRatio: 1
                        },
                        option: {
                            series: [{
                                    center: ['25%', '50%']
                                },
                                {
                                    center: ['50%', '50%']
                                },
                                {
                                    center: ['75%', '50%']
                                }
                            ]
                        }
                    },
                    {
                        option: {
                            series: [{
                                    center: ['50%', '25%']
                                },
                                {
                                    center: ['50%', '50%']
                                },
                                {
                                    center: ['50%', '75%']
                                }
                            ]
                        }
                    }
                ]
            };

            var donut = {
                title: {
                    text: 'Emoji Of Monthly',
                    subtext: 'Doughnut Data',
                    left: 'center'
                },
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    bottom: 10,
                    left: 'center'
                },
                series: [{
                        name: 'Excellent',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        itemStyle: {
                            borderRadius: 10,
                            borderColor: '#fff',
                            borderWidth: 2
                        },
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '40',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        radius: '30%',
                        center: ['50%', '25%'],
                        datasetIndex: 1,
                        data: dPieChart,
                    },
                    {
                        name: 'Normal',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        itemStyle: {
                            borderRadius: 10,
                            borderColor: '#fff',
                            borderWidth: 2
                        },
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '40',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        radius: '30%',
                        center: ['50%', '50%'],
                        datasetIndex: 2,

                        data: dPieChartTwo,
                    },
                    {
                        name: 'Bad',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        itemStyle: {
                            borderRadius: 10,
                            borderColor: '#fff',
                            borderWidth: 2
                        },
                        label: {
                            show: false,
                            position: 'center'
                        },
                        emphasis: {
                            label: {
                                show: true,
                                fontSize: '40',
                                fontWeight: 'bold'
                            }
                        },
                        labelLine: {
                            show: false
                        },
                        radius: '30%',
                        center: ['50%', '75%'],
                        datasetIndex: 3,
                        data: dPieChartThree,
                    }
                ],
                media: [{
                        query: {
                            minAspectRatio: 1
                        },
                        option: {
                            series: [{
                                    center: ['25%', '50%']
                                },
                                {
                                    center: ['50%', '50%']
                                },
                                {
                                    center: ['75%', '50%']
                                }
                            ]
                        }
                    },
                    {
                        option: {
                            series: [{
                                    center: ['50%', '25%']
                                },
                                {
                                    center: ['50%', '50%']
                                },
                                {
                                    center: ['50%', '75%']
                                }
                            ]
                        }
                    }
                ]
            };
            myChart.setOption(line);
            // Display the chart using the configuration items and data just specified.
            $(document).ready(function() {
                // $('#feedback-data').html('');
                $('#chartSelect').on('change', function() {
                    let chartVal = $('#chartSelect').val()
                    // console.log(chartVal);
                    // myChart.destory();
                    if (chartVal === 'line') {

                        myChart.setOption(line, true);

                    }
                    if (chartVal === 'bar') {
                        // myChart.setOption(line).destory()
                        myChart.setOption(bar, true);

                    }
                    if (chartVal === 'pie') {
                        // myChart.setOption(line).destory()
                        myChart.setOption(pie, true);
                    }
                    if (chartVal === 'donut') {
                        // myChart.setOption(line).destory()
                        myChart.setOption(donut, true);
                    }

                });
            });

        }

        dailyChart()
        
        document.getElementById("ex2-tab-1").addEventListener("click", () => {
            dailyChart()
            
        });

        document.getElementById("ex2-tab-2").addEventListener("click", () => {
            montlyChart()
            $('#chartSelect').val('line')
           
        });

        document.getElementById("ex2-tab-3").addEventListener("click", () => {
            yearlyChart()
            $('#chartSelect').val('line')
        });

        // document.getElementById("")
    </script>
    <script>
        $(document).ready(function() {


            // For Daily Search
            $(document).on('submit', '#Montserchform', function(e) {
                e.preventDefault()
                var yearVal = $('#year').val()
                // console.log(yearVal);
                $('#monthlyBody').html('')

                $.ajax({
                    type: "GET",
                    url: "{{ route('month.search') }}",
                    data: {
                        'yearVal': yearVal
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log(response)
                        if (response.length == 0) {
                            var no_result = `
                                <h3 class= "text-center text-danger my-3" style="margin-left:150px; position: absolute" id="">Data Not Found</h3>
                            `
                            $('#monthlyBody').html(no_result);
                            // console.log('No');

                        } else {
                            var output = " ";
                            $.each(response, function(key, value) {

                                output += `
                                    <tr>
                                       
                                            <td>${value.date}</td>
                                            <td>${value.good}</td>
                                            <td>${value.normal}</td>
                                            <td>${value.bad}</td>
                                        
                                    </tr>
                                `
                            });
                            $('#monthlyBody').html(output);
                        }

                    }
                });

            });

            //For Monthly Search
            $(document).on('submit', '#dailySearchForm', function(e) {
                e.preventDefault()
                var dailyToYMVal = $('#dailyToYMVal').val();
                // console.log(dailyToYMVal);
                const yearMonthArray = dailyToYMVal.split("-");
                // console.log(yearMonthArray);
                $('#dailyBody').html()

                $.ajax({
                    type: "GET",
                    url: "{{ route('daily.search') }}",
                    data: {
                        'yearMonthArray': yearMonthArray
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log(response)
                        if (response.length == 0) {
                            var no_result = `
                                <h3 class= "text-center text-danger my-3" style="margin-left:150px; position: absolute" id="Nodata">Data Not Found</h3>
                            `
                            $('#dailyBody').html(no_result);
                            // console.log('No');

                        } else {
                            var output = " ";
                            $.each(response, function(key, value) {
                                // inportact
                                // const dateDayname = new Date(value.date);
                                // const day = dateDayname.getDate()
                                output += `
                                
                                    <tr>
                                        <td>${value.date}</td>
                                        <td>${value.good}</td>
                                        <td>${value.normal}</td>
                                        <td>${value.bad}</td>
                                    </tr>
                                `
                            });
                            $('#dailyBody').html(output);
                        }
                    }
                });

            });

            //For Yearly Search
            $(document).on('submit', '#yearlySearch', function(e) {
                e.preventDefault()
                var yearlySearchVal = $('#yearlySearchVal').val()
                console.log(yearlySearchVal);
                $('#yearlyBody').html('');
                $.ajax({
                    type: "GET",
                    url: "{{ route('year.search') }}",
                    data: {
                        'yearlySearchVal': yearlySearchVal
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        if (response.length == 0) {
                            var no_result = `
                                <h3 class= "text-center text-danger my-3" style="margin-left:150px; position: absolute" id="">Data Not Found</h3>
                            `
                            $('#yearlyBody').html(no_result);
                            // console.log('No');

                        } else {
                            var output = " ";
                            $.each(response, function(key, value) {
                                // inportact
                                // const dateDayname = new Date(value.date);
                                // const day = dateDayname.getDate()
                                output += `
                                
                                    <tr>
                                        <td>${value.date}</td>
                                        <td>${value.good}</td>
                                        <td>${value.normal}</td>
                                        <td>${value.bad}</td>
                                    </tr>
                                `
                            });
                            $('#yearlyBody').html(output);
                        }
                    }
                });
            })

        })
    </script>
</body>

</html>
