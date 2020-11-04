<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <base href="{{asset('')}}">
    <!-- css -->
    <link href="backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="backend/css/datepicker3.css" rel="stylesheet">
    <link href="backend/css/styles.css" rel="stylesheet">
    <!--Icons-->
    <script src="backend/js/lumino.glyphs.js"></script>
    <script src="https://kit.fontawesome.com/5efd05f2e8.js" crossorigin="anonymous"></script>t
</head>
<body>

@include('backend.master.header');
@include('backend.master.sidebar');
@if(session()->has('error'))
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 error-msg">
        <div class="alert alert-danger">
            <h4 style="margin: 0">{{session('error')}}</h4>
        </div>
    </div>
@endif
@if(session()->has('success'))
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 success-msg">
        <div class="alert alert-success">
            <h4 style="margin: 0">{{session('success')}}</h4>
        </div>
    </div>
@endif
@yield('content');

<!-- javascript -->
<script src="backend/js/jquery-1.11.1.min.js"></script>
<script src="backend/js/bootstrap.min.js"></script>
<script src="backend/js/chart.min.js"></script>
<script src="backend/js/easypiechart.js"></script>
<script src="backend/js/easypiechart-data.js"></script>
<script src="backend/js/bootstrap-datepicker.js"></script>
<script src="backend/js/chart-data.js"></script>
@yield('script')
@yield('script_variant')

</body>
</html>
