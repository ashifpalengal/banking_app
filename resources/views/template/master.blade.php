<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Banking App</title>

    @php
        $path = asset('/');
    @endphp

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ $path }}global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
	<link href="{{ $path = asset('/') }}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="{{ $path = asset('/') }}assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="{{ $path = asset('/') }}assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="{{ $path = asset('/') }}assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="{{ $path = asset('/') }}assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ $path }}global_assets/js/main/jquery.min.js"></script>
	<script src="{{ $path }}global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="{{ $path }}global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
    <script src="{{ $path }}global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="{{ $path }}global_assets/js/plugins/forms/selects/select2.min.js"></script>

	<script src="{{ $path }}global_assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script src="{{ $path }}global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script src="{{ $path }}global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="{{ $path }}global_assets/js/plugins/ui/moment/moment.min.js"></script>
	<script src="{{ $path }}global_assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="{{ $path }}global_assets/js/plugins/forms/styling/uniform.min.js"></script>

    <script src="{{ $path }}global_assets/js/plugins/notifications/pnotify.min.js"></script>
	<script src="{{ $path }}assets/js/app.js"></script>
    <script src="{{ $path }}global_assets/js/demo_pages/datatables_basic.js"></script>
	<script src="{{ $path }}global_assets/js/demo_pages/dashboard.js"></script>
    <script src="{{ $path }}global_assets/js/demo_pages/form_layouts.js"></script>
	<!-- /theme JS files -->

</head>

<body>

    <!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
			<a href="#" class="d-inline-block">
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>
	</div>
	<!-- /main navbar -->

	<!-- Page content -->
	<div class="page-content">

		<!-- main sidebar -->
        @include('template.sidebar')
        <!-- /main sidebar -->

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- page header -->
            @include('template.header')
            <!-- /page header -->

			<!-- Content area -->
			<div class="content">
				@yield('content')
			</div>
			<!-- /content area -->

			<!-- footer -->
            @include('template.footer')
            <!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
