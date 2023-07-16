
<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<meta charset="utf-8" />
		<title>Konveksi | @yield('title')</title>
		<meta name="description" content="Updates and statistics" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

		<link href="{{ asset("assets/backend/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.5") }}" rel="stylesheet" type="text/css" />

		<link href="{{ asset('assets/backend/plugins/global/plugins.bundle.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/backend/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/backend/css/style.bundle.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />

		<link rel="shortcut icon" href="{{asset('assets/backend/media/logos/favicon.ico')}}" />
        @stack('styles')
	</head>

	<body id="kt_body" class="header-mobile-fixed subheader-enabled aside-enabled aside-fixed aside-secondary-enabled page-loading">

		<div id="kt_header_mobile" class="header-mobile">
			<a href="#">
				<img alt="Logo" src="{{asset('assets/backend/media/logos/logo-letter-2.png')}}" class="logo-default max-h-30px" />
			</a>
			<div class="d-flex align-items-center">
				<button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
					<span></span>
				</button>
			</div>
			<!--end::Toolbar-->
		</div>

		<div class="d-flex flex-column flex-root">

			<div class="d-flex flex-row flex-column-fluid page">

                {{-- DISINI SIDEBAR --}}
                @include('backend.layouts.sidebar')

				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                        {{-- BEGIN HEADER --}}
                        @include('backend.layouts.header')

						<div class="d-flex flex-column-fluid">
                            {{-- BEGIN CONTENT --}}
                            @yield('content')

						</div>
					</div>
					<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
							<div class="text-dark order-2 order-md-1">
								<span class="text-muted font-weight-bold mr-2">{{ date('Y') }} ©</span>
								<a href="javascript:;" class="text-dark-75 text-hover-primary">tclothbandung</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
			</span>
		</div>

		<script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#1BC5BD", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#6993FF", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#1BC5BD", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#E1E9FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<script src="{{asset('assets/backend/plugins/global/plugins.bundle.js?v=7.0.5')}}"></script>
		<script src="{{asset('assets/backend/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5')}}"></script>
		<script src="{{asset('assets/backend/js/scripts.bundle.js?v=7.0.5')}}"></script>
		<script src="{{asset('assets/backend/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.5')}}"></script>
		<script src="{{asset('assets/backend/js/pages/widgets.js?v=7.0.5')}}"></script>
		<script>
			function select2refresh($el) {
				$el.select2({
					placeholder: "Select an option",
					allowClear: true,
					width: '100%'
				});
			}
		</script>
		<script>
			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			})
		</script>
		<script>
			$('.form-delete').on('click', function (e) {
				e.preventDefault();
				var $form = $(this);
				$('#confirm').modal({
					backdrop: 'static',
					keyboard: false
				}).on('click', '#delete-btn', function () {
					$form.submit();
				});
			});
		</script>
		@if (Session::has('error-notif'))
			<script>
				swal.fire({
					text: "{{ Session::get('error-notif') }}",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				})
			</script>
		@endif
		@if (Session::has('success-notif'))
			<script>
				swal.fire({
					text: "{{ Session::get('success-notif') }}",
					icon: "success",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				})
			</script>
		@endif
        @stack('scripts')
	</body>
</html>