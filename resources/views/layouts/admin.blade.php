<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--  CSRF Token  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lucky Starter') }}</title>

    {{--  CSS Styles  --}}
    <link href="{{ asset('assets/admin/css/app.css') }}" rel="stylesheet">

    {{--  Vendor JS Assets  --}}
    <script src="{{ asset('assets/admin/js/vendor.js') }}"></script>

    {{--  Javascript Assets  --}}
    <script src="{{ asset('assets/admin/js/app.js') }}" defer></script>
</head>
<body>

@include('admin.partials.notifications')

<div id="app">
    <div class="header py-4">
        <div class="container">
            <div class="d-flex">
                <a class="header-brand" href="{{ route('admin.home') }}">
                    <img src="{{ asset('assets/images/logo.svg') }}" class="header-brand-img" alt="logo">
                </a>

                <div class="d-flex order-lg-2 ml-auto">
                    <div class="dropdown mt-auto">
                        <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                            <span class="d-none d-lg-block">
                                    <span class="text-default">{{ auth()->user()->name }}</span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#">
                                <i class="dropdown-icon fe fe-settings"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                <i class="dropdown-icon fe fe-log-out"></i> @lang('Sign out')
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>

                <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse"
                   data-target="#headerMenuCollapse">
                    <span class="header-toggler-icon"></span>
                </a>
            </div>
        </div>
    </div>


    <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
        <div class="container">
            @include('admin.partials.menu')
        </div>
    </div>

    <main class="py-4">

        @yield('content')

        @stack('javascript')
    </main>
</div>

</body>
</html>