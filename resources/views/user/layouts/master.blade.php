<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{"    " }}</title>
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/perfect-scrollbar.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/morris.css')}}" rel="stylesheet">
    <link href="{{asset('css/c3.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/dashboard1.css')}}" rel="stylesheet">
    <link href="{{asset('css/default.css')}}" id="theme" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/jquery.multiplecombobox.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="fix-header fix-sidebar card-no-border">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">پنل کاربری</p>
        </div>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header text-center p-0">
                    <a class="navbar-brand" href="index.html">
                        <b>
                            {{--<img src="../images/logo-icon.jpg" alt="homepage" class="dark-logo"/>--}}
                            {{--<img src="../images/logo-icon.jpg" alt="homepage" class="light-logo"/>--}}
                        </b>
                        <span>
                            <img src="{{asset('storage/images/logo-icon.jpg')}}" alt="پنل کاربری" class="dark-logo"/>
                            {{--<img src="../images/logo-icon.jpg" class="light-logo" alt="homepage"/>--}}
                        </span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i
                                        class="fa fa-bars"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item hidden-xs-down search-box"><a class="nav-link hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i
                                        class="fa fa-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="fa fa-times"></i></a></form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false"><img src="{{asset('storage/images/users/1.jpg')}}" alt="خوش آمدید" class=""/> <span
                                        class="hidden-md-down">{{auth()->user()->name}} &nbsp;</span> </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li><a class="waves-effect waves-dark" href="/" aria-expanded="false"><i class="fa fa-tachometer"></i><span
                                        class="hide-menu">خانه</span></a>
                        </li>
                        <li><a class="waves-effect waves-dark" href="/user/todoLists" aria-expanded="false"><i class="fa fa-shopping-cart"></i><span
                                        class="hide-menu">لیست کارها</span></a>
                        </li>
                        <li><a class="waves-effect waves-dark" href="/user/tasks" aria-expanded="false"><i class="fa fa-shopping-cart"></i><span
                                        class="hide-menu">وظایف</span></a>
                        </li>

                        <li><a class="waves-effect waves-dark btn btn-danger" href="/user/logout" aria-expanded="false"><i class="fa fa-sign-ou"></i><span
                                        class="hide-menu"> خروج </span></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-12 align-self-center">
                        @yield('content')
                    </div>
                </div>

            </div>

        </div>
    </div>
    <script>
      window.Laravel = {csrfToken: '{{ csrf_token() }}'}
    </script>
    <script src="/js/app.js"></script>
</body>

</html>