<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:description" content="@yield('description')">
    {{-- keywords --}}
    <meta property="og:image" content="{{ asset('assets/photos/lokersulawesi-32x32.jpeg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="https://lokersulawesi.com">
    <link rel="icon" href="{{ asset('assets/photos/lokersulawesi-32x32.jpeg') }}" sizes="32x32" />
    <link rel="icon" href="{{ asset('assets/photos/lokersulawesi-192x192.jpeg') }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ asset('assets/photos/lokersulawesi-192x192.jpeg') }}" sizes="180x180" />

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5543298433003530"
     crossorigin="anonymous"></script>

    <title>@yield('title', 'LOKER SULAWESI')</title>

    @yield('meta')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Start MDBootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet" />
    <!-- End MDBootstrap -->

    <style>
        :root {
            --width-page: 480px;
        }

        * {
            padding: 0;
            margin: 0;
            font-size: 12px;
            letter-spacing: 0.03em;
            font-family: Nunito, sans-serif;
        }

        html,
        body {
            max-width: 100%;
            overflow: unset;
            margin: 0;
            line-height: inherit;
            height: 100%;
        }

        #wrapper {
            height: 100%;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .btn-menubar {
            display: flex;
            flex-direction: column;
            -webkit-box-align: center;
            align-items: center;
            --tw-text-opacity: 1;
            color: rgba(30, 136, 229, var(--tw-text-opacity));
            border-radius: 0.375rem;
            cursor: pointer;
            font-weight: 600;
            width: auto;
            border-style: none;
            padding: 0.75rem;
            background-color: rgba(0, 0, 0, 0);
            font-size: 0.75rem;
            line-height: 1rem;
        }

        .menubar-footer {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            margin-top: 0px;
            margin-bottom: 0px;
            max-width: 100%;
            --tw-bg-opacity: 1;
            background-color: rgba(255, 255, 255, var(--tw-bg-opacity));
            width: var(--width-page);
            margin: 0rem auto;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        .navbar-wrap {
            --tw-bg-opacity: 1;
            background-color: rgba(255, 255, 255, var(--tw-bg-opacity));
            --tw-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            display: block;
            position: fixed;
            max-width: 100%;
            width: var(--width-page);
            margin-left: auto;
            margin-right: auto;
            left: 0px;
            right: 0px;
            bottom: 0px;
            z-index: 10;
            border-style: solid;
            border-width: 1px 0px 0px;
            --tw-border-opacity: 1;
            border-color: rgba(224, 224, 224, var(--tw-border-opacity));
        }

        .body-wrap {
            background: rgb(255, 255, 255);
            width: var(--width-page);
            max-width: 100%;
            margin: 0px auto;
            min-height: 100%;
        }

        .body {
            display: flex;
            flex-direction: column;
            flex: 1 1 0%;
        }

        .body-header {
            background: #333333;
            padding: 5px;
            position: relative;
            width: var(--width-page);
            max-width: 100%;
            z-index: 0;
        }

        .body-header-content {
            color: #fff;
            text-align: center;
            margin: 7px 0px;
        }

        .body-content {
            display: flex;
            -webkit-box-pack: center;
            justify-content: center;
            flex-direction: column;
            padding-top: 15px;
            padding-bottom: 50px
        }

        body {
            background-image: url('{{ asset('assets/images/background2.jpg') }}');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {
            padding-left: 0px;
            padding-right: 0px;
        }

        .color-2 {
            color: #5f5f5f !important;
        }

        .menu-active {
            color: #f6be17 !important;
        }

        .color-1 {
            color: #333333 !important;
        }

        .bg-second2 {
            background-color: #f6be17 !important;
        }

        .bg-primary1 {
            background-color: #333333 !important;
        }

        .is-invalid {
            margin-bottom: 0px !important;
        }

        .copy {
            cursor: pointer
        }

        .bold {
            font-weight: bold;
        }
    </style>

    @yield('css')
</head>

<body>
    <div id="wrapper">
        <div class="body-wrap">
            <div class="body">
                <div class="body-content">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('templates.menubar-footer-loker')

        @include('jobs.modal-filter')

    </div>


    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- MDB -->
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>

    <!-- JQUERY -->
    <script src='{{ asset('js/jquery-3.4.1.min.js') }}'></script>

    <script src="{{ asset('js/bootstrap4.min.js') }}"></script>

    @yield('js')
</body>

</html>
