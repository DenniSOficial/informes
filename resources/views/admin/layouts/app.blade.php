<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Sistema de Informes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

        @yield('css')

        <!-- Bootstrap Css -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body data-topbar="colored">
        
        <!-- Begin page -->
        <div id="layout-wrapper">

            @include("admin.layouts.partial.topbar")

            @include("admin.layouts.partial.sidebar")

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    
                    <!-- Page-Title -->
                    @yield('content')
                    <!-- end page-content-wrapper -->
                </div>
                <!-- End Page-content -->
                
                @include("admin.layouts.partial.footer")
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
        

        <!-- JAVASCRIPT -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('plugins/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('plugins/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('plugins/node-waves/waves.min.js') }}"></script>

        <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

        @yield('js')
        
        <script src="{{ asset('js/app.js') }}"></script>

    </body>
</html>
