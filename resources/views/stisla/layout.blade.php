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
    <link rel="stylesheet" href="{{ mix('/css/sweetalert.css') }}">
    <style type="text/css">
        .table tbody>tr>th,
        .table tbody>tr>td {
            vertical-align: middle;
        }
    </style>

    <!-- Page Specific CSS File -->
    @stack('styles')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ mix('/css/stisla.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/loader.css') }}">
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <!-- Navbar -->
            @include('stisla.components.navbar')

            <!-- Sidebar -->
            @include('stisla.components.sidebar')


            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('page_header', 'Home')</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="#">Forms</a></div>
                            <div class="breadcrumb-item">Advanced Forms</div>
                        </div>
                    </div>

                    <div class="section-body">
                        @yield('content')
                    </div>
                </section>
            </div>

            <!-- Footer -->
            @include('stisla.components.footer')
        </div>
    </div>

    <!-- /#spinner preload -->
    <div class="loader loader-default" data-text></div>

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
    <script src="{{ mix('/js/sweetalert.js') }}"></script>
    <script src="{{ mix('/js/stisla-scripts.js') }}"></script>

    <!-- JS Libraries -->
    @stack('jslib')

    <!-- Page Specific JS File -->
    @stack('scripts')

    <!-- Template JS File -->
    <script src="{{ mix('/js/ajaxForm.js') }}"></script>
    <script src="{{ mix('/js/stisla.js') }}"></script>
    <script>
        $(document).ready(function() {
            // moment.tz.setDefault('Asia/Jakarta')
            moment.locale('id')

            $('form.ajaxForm').submit(function(e) {
                e.preventDefault()
                var form = e.target
                var data = new FormData(form)
                $.each(form.files, function(k, v) {
                    data.append('photos', form.files[k])
                })

                $(this).ajaxForm({
                    data: data,
                    beforeSend: function() {
                        $('.loader').addClass('is-active');
                    },
                    afterSend: function() {
                        $('.loader').removeClass('is-active');
                    }
                })
            })

            $('body').on('click', 'a.delete', function(e) {
                e.preventDefault()
                $(this).ajaxDelete()
            })

            $('a#logout').click(function(e) {
                e.preventDefault()
                Swal.fire({
                    title: 'Ready to Leave?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Logout!',
                }).then(() => {
                    $.post($('a#logout').attr('href'))
                    // return fetch($('a#logout').attr('href'), {
                    //     method: 'POST'
                    // })
                })
            })
        })


        let numberFormat = function(num) {
            var regex = parseFloat(num, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
            return regex.slice(0, -3);
        }

        let nFormatter = function(number, digit = 1) {
            let SI_SYMBOL = ["", "k", "M", "G", "T", "P", "E"]
            const tier = Math.log10(number) / 3 | 0
            if (tier == 0)
                return number

            const suffix = SI_SYMBOL[tier],
                scale = Math.pow(10, tier * 3),
                scaled = number / scale

            return scaled.toFixed(digit) + suffix
        }

        console.info('%cI\'m watching you bitch !', [
            'color: black',
            'font-size: 30px',
            'text-shadow: 2px 2px black',
            'padding: 10px',
        ].join(';'));
    </script>
</body>

</html>