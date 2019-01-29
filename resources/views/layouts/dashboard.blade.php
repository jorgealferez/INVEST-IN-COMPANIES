<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
        <title>Admin Pro Admin Template - The Ultimate Bootstrap 4 Admin Template</title>
        <!-- Bootstrap Core CSS -->
        <link href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
        <!-- This page CSS -->
        <!-- chartist CSS -->
        <link href="/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
        <link href="/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
        <!--c3 CSS -->
        <link href="/plugins/c3-master/c3.min.css" rel="stylesheet">
        <!--Toaster Popup message CSS -->
        <link href="/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
        <!-- Dashboard 1 Page CSS -->
        <link href="css/pages/dashboard1.css" rel="stylesheet">
        <!-- You can change the theme colors from here -->
        <link href="css/colors/default-dark.css" id="theme" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    </head>

    <body class="fix-header fix-sidebar card-no-border">

        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Admin Pro</p>
            </div>
        </div>

        <div id="main-wrapper">

            @include('dashboard.header')

            @include('dashboard.sidebar')
            <div class="page-wrapper">
                @yield('content')
                @include('dashboard.footer')
            </div>

        </div>

        <script src="/plugins/jquery/jquery.min.js"></script>
        <script src="/plugins/bootstrap/js/popper.min.js"></script>
        <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/perfect-scrollbar.jquery.min.js"></script>
        <script src="js/waves.js"></script>
        <script src="js/sidebarmenu.js"></script>
        <script src="js/custom.min.js"></script>
        <script src="/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script src="/plugins/chartist-js/dist/chartist.min.js"></script>
        <script src="/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
        <script src="/plugins/d3/d3.min.js"></script>
        <script src="/plugins/c3-master/c3.min.js"></script>
        <script src="/plugins/toast-master/js/jquery.toast.js"></script>
        <script src="js/dashboard1.js"></script>
        <script src="/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    </body>

</html>
