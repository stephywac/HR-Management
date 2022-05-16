
<!DOCTYPE html>
<html lang="en">
	<head><base href="">
		<title>Hr Management- Webandcrafts</title>
		<meta charset="utf-8" />
		<meta name="description" content="Hr management use for candidate testing" />
		<meta name="keywords" content="Hr management" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Hr management -webandcrfats" />
		<meta property="og:url" content="https://webandcrafts.com/" />
		<meta property="og:site_name" content="Hr Management|Webandcrafts" />
		<link rel="canonical" href="https://webandcrafts.com/" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		@include('admin.layouts.css_header')
   		@stack('css')
	</head>
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
	<div class="container">
       
      </div>
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				@include('admin.layouts.sidebar')

				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					@include('admin.layouts.header')

					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Toolbar-->
						
						<!--end::Toolbar-->
						<!--begin::Post-->
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<div id="kt_content_container" class="container-xxl">
							  @yield('content')
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					@include('admin.layouts.footer')

					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<!--begin::Drawers-->
		<!--begin::Activities drawer-->
		
		<!--end::Modal - Users Search-->
		<!--end::Modals-->
		@include('admin.layouts.js_footer')
	</body>
	<!--end::Body-->
</html>