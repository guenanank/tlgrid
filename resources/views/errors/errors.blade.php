<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" prefix="og: https://ogp.me/ns#">

<head itemscope itemtype="https://schema.org/WebSite">

    <base href="{{ url('/') }}" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta name="googlebot-news" content="noindex, nofollow" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Home') &mdash; {{ config('app.name') }} </title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ mix('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/fontawesome.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ mix('/css/stisla.css') }}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="page-error">
                    @yield('content')
                </div>
                <div class="simple-footer mt-5">
                    Copyright &copy; <a href="https://gridnetwork.id/">{{ env('APP_NAME') }}&nbsp;{{ date('Y') }} </a>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ mix('/js/jquery.js') }}"></script>
    <script>
        (function($) {
            "use strict"
            const baseUrl = $('base').attr('href')
            const token = $('meta[name="csrf-token"]').attr('content')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token,
                    _token: token
                }
            });
        })(jQuery)
    </script>
    <script src="{{ mix('/js/popper.js') }}"></script>
    <script src="{{ mix('/js/tooltip.js') }}"></script>
    <script src="{{ mix('/js/bootstrap.js') }}"></script>
    <script src="{{ mix('/js/nicescroll.js') }}"></script>
    <script src="{{ mix('/js/moment.js') }}"></script>
    <script src="{{ mix('/js/stisla-scripts.js') }}"></script>

    <script>
        console.info('%cI\'m watching you bitch !', [
            'color: black',
            'font-size: 30px',
            'text-shadow: 2px 2px black',
            'padding: 10px',
        ].join(';'));
    </script>
</body>

</html>