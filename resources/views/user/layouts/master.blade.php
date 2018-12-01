<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('images/favicon.ico')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <script>

    </script>
    @yield('header')
    <title>{{$title ?? 'پنل کاربری '}}</title>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div class="sk-folding-cube" v-cloak>
        <div class="sk-cube1 sk-cube"></div>
        <div class="sk-cube2 sk-cube"></div>
        <div class="sk-cube4 sk-cube"></div>
        <div class="sk-cube3 sk-cube"></div>
    </div>
    <div id="user">
        <user :nav="nav">
            <template slot="header-short-link">
                <b-nav-item href="{{route('user.home')}}" class="px-3">داشبورد</b-nav-item>
            </template>
            <template slot="header-left-short-link">
                {{--<b-nav-item class="d-md-down-none">--}}
                {{--<i class="icon-bell"></i>--}}
                {{--<b-badge pill variant="danger">50</b-badge>--}}
                {{--</b-nav-item>--}}
            </template>
            <template slot="header-user-dropdown">
                <img src="{{auth('user')->user()->avatar ? '/storage/images/avatars/'.auth('user')->user()->avatar : '/storage/images/avatar.png'}}"
                     class="img-avatar"
                     alt="{{auth('user')->user()->email}}">
                <span class="d-md-down-none">{{auth('user')->user()->name }}</span>
            </template>
            <template slot="header-user-dropdown-items">
                <b-dropdown-header tag="div" class="text-center"><strong>حساب کاربری</strong></b-dropdown-header>
                <b-dropdown-item><i class="fa fa-user"></i> پروفایل</b-dropdown-item>
                {{--<b-dropdown-header tag="div" class="text-center"><strong>تنظیمات</strong></b-dropdown-header>--}}
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-item t><i class="icon-logout"></i> خروج</b-dropdown-item>
            </template>
            <template slot="container">
                @yield('content')
            </template>
            <template slot="footer">
                <div class="mr-auto ml-auto">
                    <small class="text-secondary">طراحی و توسعه توسط <span class="">-</span></small>
                </div>
            </template>
        </user>
    </div>
    <script>
      window.Laravel = {csrfToken: '{{ csrf_token() }}'}
    </script>
    @yield('varJs')
    <script src="{{asset('js/user.js')}}"></script>
</body>
</html>