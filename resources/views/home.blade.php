@extends('layouts.app')

@section('title')
Home
@endsection

@section('js_after')
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Dashboard
                </div>
            </div>
            <!-- Page title actions -->
        </div>
    </div>
    @include('errors.formerror')
    <div class="row row-cards">
        <div class="col-12">
            <form id="neoForm" action="{{route('neostates')}}" method="post" class="card" enctype='multipart/form-data'>
                @csrf
                <div class="card-header">
                    <h3 class="card-title">Get Asteroid - Neo Stats</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label required">Start Date</label>
                                <div>
                                    <input type="date" id="start_date" name="start_date" class="form-control" placeholder="Select date" max="<?php echo date('Y-m-d'); ?>" required>
                                    <small class="form-hint"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label required">End Date</label>
                                <div>
                                    <input type="date" id="end_date" name="end_date" class="form-control" placeholder="Select date" max="<?php echo date('Y-m-d'); ?>" required>
                                    <small class="form-hint"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <div class="d-flex">
                        <a href="javascript:void(0);" id="clearForm" class="btn btn-link">Clear</a>
                        <button type="submit" id="submitBtn" class="btn btn-primary ms-auto">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div><br>
    <div class="row row-cards" id="neoResultDiv" style="display: none;">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" id="neoResult">
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row" id="chartDiv">
        <div class="col-12">
            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#neoForm').on('submit', function(e) {
            $('#submitBtn').prop('disabled', true);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function( data ) {
                    if(data.data)
                    {
                        $('#neoResult').html(data.data);
                        $('#chartDiv').show();
                        getChart(data.chartdata);
                    }
                    else
                    {
                        $('#neoResult').html(data);
                        $('#chartDiv').hide();
                    }
                    $('#neoResultDiv').show();
                    $('#submitBtn').prop('disabled', false);
                }
            });
        });
        $('#clearForm').click(function(){
            $('#neoResultDiv').hide();
            $('#neoForm')[0].reset();
            $('#chartDiv').hide();
        });
        function getChart(stats){
            var data = [];
            for (i = 0; i < stats.length; ++i) {
                data.push({ x: new Date(stats[i].year,stats[i].month,stats[i].date), y: stats[i].count});
            }
            console.log(data);
            var chart = new CanvasJS.Chart("chartContainer",
            {
                title:{
                    text: "Asteroids Line Chart"
                },
                axisX:{
                    title: "Date",
                    valueFormatString: "DD/MM/YY",
                    gridThickness: 2
                },
                axisY: {
                    title: "Asteroids"
                },
                data: [
                    {
                        type: "area",
                        dataPoints:data
                    }
                ]
            });
            chart.render();
        }
    });
</script>
@endsection
