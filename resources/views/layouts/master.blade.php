<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ getSetting()->nama_sistem }} | @yield('title')</title>
	<link rel="shortcut icon" href="{{ asset(getSetting()->logo_sistem_minimal) }}" type="image/x-icon">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet"
		href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<!-- JQVMap -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
	<!-- summernote -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
	<!-- Select2 -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
	{{-- custome css --}}
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
		integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
		crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
		integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
		crossorigin=""></script>
	@yield('css')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
	<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
	<link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


	<style>
		td.details-control {
			background: url('{{ asset('assets/images/up-table.png') }}') no-repeat center center;
			cursor: pointer;
		}

		tr.details td.details-control {
			background: url('{{ asset('assets/images/down-table.png') }}') no-repeat center center;
			cursor: pointer;
		}

		.btn.blue-stripe {
			border-left: 3px solid #3598dc;
		}

		.btn.yellow-stripe {
			border-left: 3px solid #dbed12;
		}

		.btn.green-stripe {
			border-left: 3px solid #02b60e;
		}

		.btn.default {
			color: #333333;
			background-color: #E5E5E5;
		}

		.btn.default:hover,
		.btn.default:focus,
		.btn.default:active,
		.btn.default.active {
			color: #333333;
			background-color: lightgray;
		}

		.custom-file-upload {
			border: 1px solid #ccc;
			display: inline-block;
			padding: 6px 12px;
			cursor: pointer;
		}
	</style>

</head>

<body class="sidebar-mini layout-footer-fixed  layout-navbar-fixed layout-fixed text-sm">
	<div class="wrapper">
		<!-- Preloader -->
		@include('layouts.shared.preloader')

		<!-- Navbar -->
		@include('layouts.shared.navbar')
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		@include('layouts.shared.sidebar')
		<!-- /.Main Sidebar Container -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					@yield('breadcrumb')
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				@yield('content')
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		{{-- footer --}}
		@include('layouts.shared.footer')

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
	</div>
	<!-- ./wrapper -->

	<script>
		const BASE_URL = "{{ url('/') }}";
	</script>

	<!-- jQuery -->
	<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<!-- ChartJS -->
	<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
	<!-- Sparkline -->
	<script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
	<!-- JQVMap -->
	<script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
	<!-- jQuery Knob Chart -->
	<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
	<!-- daterangepicker -->
	<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
	<!-- Summernote -->
	<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
	<!-- overlayScrollbars -->
	<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('assets/dist/js/demo.js') }}"></script>
	<!-- DataTables  & Plugins -->
	<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

	<!-- Select2 -->
	<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
	@yield('js')
	@include('sweetalert::alert')
	<script>
		if ('{{ env('APP_ENV') }}' == 'production') {
			document.addEventListener('contextmenu', (e) => e.preventDefault());

			function ctrlShiftKey(e, keyCode) {
				return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
			}

			document.onkeydown = (e) => {
				// Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
				if (
					event.keyCode === 123 ||
					ctrlShiftKey(e, 'I') ||
					ctrlShiftKey(e, 'J') ||
					ctrlShiftKey(e, 'C') ||
					(e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
				)
					return false;
			};
		}
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
		})

		function notifikasi(notif) {
			const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000
			});

			Toast.fire(notif);
		}
	</script>
</body>

</html>
