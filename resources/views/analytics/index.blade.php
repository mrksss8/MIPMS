@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Analytics') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div id="chartContainer" style="height: 400px; width: 100%;"></div>
        </div>
        <div class="col-md-6">
            <div id="chartContainers" style="height: 400px; width: 100%;"></div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                title: {
                    text: "Medicines Stocks",
                    fontFamily: "poppins",
                    fontSize: 18,
                },
                axisY: {
                    includeZero: true,

                },
                data: [{
                    fontFamily: "poppins",
                    type: "pie",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    // indexLabel: "{label} - #percent%",
                    // yValueFormatString: "฿#,##0",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

            var charts = new CanvasJS.Chart("chartContainers", {
                animationEnabled: true,
                exportEnabled: true,
                title: {
                    text: "Medicines Stocks",
                    fontFamily: "poppins",
                    fontSize: 18,
                },
                axisY: {
                    includeZero: true,

                },
                data: [{
                    fontFamily: "poppins",
                    type: "column",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    // indexLabel: "{label} - #percent%",
                    // yValueFormatString: "฿#,##0",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            charts.render();

        }
    </script>
@endsection
