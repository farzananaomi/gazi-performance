<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('head-title', 'Dashboard') | GAZI Pipes Performance</title>

    <meta name="theme-color" content="#008d4c">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#008d4c">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#008d4c">

    <link rel="icon" sizes="192x192" href="{{ asset('img/gazi-group.png') }}">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Pace -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/black/pace-theme-barber-shop.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>

    <!-- Bootstrap 3.3.6 -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('css/skins/_all-skins.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.standalone.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.22/daterangepicker.min.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap3-wysiwyg/0.3.3/bootstrap3-wysihtml5.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/flat/green.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.6/select2-bootstrap.min.css">

    <style>
        html, body {
            height: 100% !important;
        }
        .sort-ctrl {
            font-size: 10px;
        }
        .sort-ctrl.sort-active {
            font-size: inherit;
            color: rgba(34, 139, 34, 0.75);
        }
        .select2-container {
            display: block;
        }
        .form-inline .select2-container {
            display: inline-block;
        }
        .select2-container .select2-selection--single {
            height: 38px;
            border: 1px solid #d2d6de;
            border-radius: 0;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px;
        }
        .select2-container--open .select2-dropdown--below {
            border: 1px solid #d2d6de;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 30px;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #d2d6de;
        }

        .user-panel>.image>img {
            width: 100%;
            max-width: 45px;
            height: 45px;
        }

        @media (max-width: 480px) {
            [class^="col-"], [class*=" col-"] {
                display:block;
                float:none;
                width: 100%
            }
            .singularity-credit-text {
                display: none;
            }
        }
    </style>
@section('styles')
@show

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>G</b>G</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>GAZI</b>GROUP</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        {{--@if(!empty(@auth('sales')->user()->employee->profile_image))--}}
                            {{--<img src="{{ route('imagecache', ['small', @auth('sales')->user()->employee->profile_image]) }}" class="user-image" alt="User Image">--}}
                        {{--@else--}}
                            {{--<img src="{{ asset('img/image_not_found.png') }}" class="user-image" alt="User Image">--}}
                        {{--@endif--}}
                        {{--<span class="hidden-xs">{{ @auth('sales')->user()->employee->fullname }}</span>--}}
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        {{--<li class="user-header">--}}

                            {{--@if(!empty(@auth('sales')->user()->employee->profile_image))--}}
                                {{--<img src="{{ route('imagecache', ['small', @auth('sales')->user()->employee->profile_image]) }}" class="img-circle" alt="User Image">--}}
                            {{--@else--}}
                                {{--<img src="{{ asset('img/image_not_found.png') }}" class="img-circle" alt="User Image">--}}
                            {{--@endif--}}
                            {{--<p>--}}
                                {{--{{ @auth('sales')->user()->employee->fullname }} - {{ @auth('sales')->user()->designation->name }}--}}
                            {{--</p>--}}
                        {{--</li>--}}
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        {{--<div class="user-panel">--}}
            {{--<div class="pull-left image">--}}

                {{--@if(!empty(@auth('sales')->user()->employee->profile_image))--}}
                    {{--<img src="{{ route('imagecache', ['small', @auth('sales')->user()->employee->profile_image]) }}" class="img-circle" alt="User Image">--}}
                {{--@else--}}
                    {{--<img src="{{ asset('img/image_not_found.png') }}" class="img-circle" alt="User Image">--}}
                {{--@endif--}}
            {{--</div>--}}
            {{--<div class="pull-left info">--}}
                {{--<p style="margin-left: -8px;margin-top: 8px;">{{ @auth('sales')->user()->employee->fullname }}</p>--}}
            {{--</div>--}}
        {{--</div>--}}
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="{{ ''  }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-barcode"></i> <span>Products</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('products.index') }}"><i class="fa fa-barcode"></i> List All Products</a></li>
                    <li><a href="{{ route('products.create') }}"><i class="fa fa-plus"></i> Add Product</a></li>

                    <li><a href="{{ route('products.prices.index') }}"><i class="fa fa-money"></i> Price Charts</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i> <span>Recipes</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('recipes.index') }}"><i class="fa fa-list"></i> List All Recipes</a></li>
                    <li><a href="{{ route('recipes.create') }}"><i class="fa fa-plus"></i> Add Recipe</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-asterisk"></i> <span>Ingredients</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('ingredients.index') }}"><i class="fa fa-asterisk"></i> List All Ingredients</a></li>
                    <li><a href="{{ route('ingredients.create') }}"><i class="fa fa-plus"></i> Add Ingredient</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o"></i> <span>Overheads</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('overheads.index') }}"><i class="fa fa-circle-o"></i> List All Overhead</a></li>
                    <li><a href="{{ route('overhead_groups.create') }}"><i class="fa fa-plus"></i> Add Overhead</a></li>
                    <li><a href="{{ route('overheads.create') }}"><i class="fa fa-plus"></i> Add Overhead Breakdown</a></li>
                    <li><a href="{{ route('overheads.costs.index') }}"><i class="fa fa-money"></i> Overhead Costs</a></li>
                </ul>
            </li>
            <li><a href="{{ route('sales.index') }}"><i class="fa fa-money"></i> Sales Data</a></li>
            <li><a href="{{ route('reports') }}"><i class="fa fa-area-chart"></i> Reports</a></li>

            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-shopping-cart"></i> <span>Products</span> <i class="fa fa-angle-left pull-right"></i>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="{{ route('sales.products.index') }}"><i class="fa fa-shopping-cart"></i> List All Products</a></li>--}}
                    {{--<li><a href="{{ route('sales.product_prices.index') }}"><i class="fa fa-money"></i> Product Pricing</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-building" aria-hidden="true"></i> <span>Dealers</span> <i class="fa fa-angle-left pull-right"></i>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="{{ route('sales.dealers.index') }}"><i class="fa fa-circle-o"></i> List Dealers</a></li>--}}
                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Dealer Assignments</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-calendar" aria-hidden="true"></i> <span>Daily Routes</span> <i class="fa fa-angle-left pull-right"></i>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="{{ route('sales.daily-route.index') }}"><i class="fa fa-plus"></i> Assign Route</a></li>--}}
                    {{--<li><a href="{{ route('sales.check-ins.index') }}"><i class="fa fa-like"></i> Check Ins</a></li>--}}
                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Dealer Assignments</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li><a href="{{ route('sales.orders.index') }}"><i class="fa fa-book"></i> <span>Orders</span></a></li>--}}
            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-cog" aria-hidden="true"></i> <span>Misc</span> <i class="fa fa-angle-left pull-right"></i>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="{{ route('sales.apks.index') }}"><i class="fa fa-mobile"></i> APKs</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}

        </ul>
        <a href="" style="display: block; width: 230px; position: absolute; bottom: 0;">
            <img src="{{ asset('img/gazi-group.png') }}" alt="GAZI Group" style="width: 200px;display: block; margin: auto auto 10px;">
        </a>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @section('content-header')
        @show
    </section>

    <!-- Main content -->
    <section class="content">
        @section('content')
        @show
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer clearfix">
    {{--<div class="pull-right hidden-xs">--}}
    {{--<b>Version</b> 2.3.3--}}
    {{--</div>--}}
    <strong class="singularity-credit-text">Developed By <a href="http://www.singularitybd.com/" target="_blank">Singularity Interactive</a>.</strong>
    <a href="http://www.singularitybd.com/" target="_blank" style="float: right;margin: -10px 20px -9px;width: 250px;"><img src="http://gazivm.com/img/singularity-credit.png" alt="" style="width: 250px;"></a>
</footer>
</div>
<!-- jQuery 2.2.0 -->
<script src="//code.jquery.com/jquery-2.2.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="//cdnjs.cloudflare.com/ajax/libs/knockout/3.4.0/knockout-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/knockout/3.4.0/knockout-min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!-- Chart.js charts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<!-- Sparkline -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>

<!-- iCheck -->
<script src="//cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<!-- datepicker -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
<!-- daterangepicker -->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.22/daterangepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap3-wysiwyg/0.3.3/bootstrap3-wysihtml5.all.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>
<!-- Slimscroll -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="//cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/app.min.js') }}"></script>

<script type="text/javascript">
    Date.prototype.monthNames = [
        "January", "February", "March",
        "April", "May", "June",
        "July", "August", "September",
        "October", "November", "December"
    ];

    Date.prototype.getMonthName = function() {
        return this.monthNames[this.getMonth()];
    };
    Date.prototype.getShortMonthName = function () {
        return this.getMonthName().substr(0, 3);
    };
    $(document).ready(function() {
        $(".select2").select2();
    });

</script>
@section('scripts')
@show
</body>
</html>
