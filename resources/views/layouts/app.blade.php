<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../../../">
    <title>Hr Management-Webandcrafts</title>
    <meta charset="utf-8" />
    <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Hr-management Webandcrfts" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Hr-management" />
    <link rel="canonical" href="https://webandcrafts.com/" />
    <link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.png')}}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!-- <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.0.js"></script> -->
    <style>
        .error
        {
            color:red;
        }
    </style>
    
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/1.jpg">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="https://webandcrafts.com/" class="mb-12">
                    <img alt="Logo" src="assets/media/logos/logo.png" class="h-40px" />
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                @yield('content')
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-column-auto p-10">
                <!--begin::Links-->
                <div class="d-flex align-items-center fw-bold fs-6">
                    <a href="https://webandcrafts.com/" class="text-muted text-hover-primary px-2">Webandcrafts</a>

                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
        </script>

<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{asset('assets/js/custom/authentication/sign-in/general.js')}}"></script>
<script>
    $(function() {
        
        $('div.alert').delay(3000).slideUp(300);
        $("#kt_sign_in_form").validate({
            rules: {
                email: {
                    required: true,
                        maxlength: 50,
                        email: true,
                    },
                    password: {
                    required: true,
                        maxlength: 50,
                       
                    },

                },
                messages: {
                    email: {
                        required: "Please enter valid email",
                        email: "Please enter valid email",
                        maxlength: "The email name should less than or equal to 50 characters",
                    },
                    password: {
                        required: "Please enter valid  password",
                        email: "Please enter valid password",
                        maxlength: "The email name should less than or equal to 50 characters",
                    },

                },
            })

        })
    </script>
</body>
<!--end::Body-->

</html>