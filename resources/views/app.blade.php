<!doctype html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" type="image/png"
        href="{{ asset('assets/frontend/wp-content/uploads/2015/02/IMG-20150204-WA0006.jpg') }}">
    <title>STC Building & Properties</title>
    <meta name="description"
        content="STC Building & Properties - Constructing Excellence since 2017. Your trusted partner in building dreams and delivering quality construction solutions.">
    <meta name="keywords" content="construction, building, properties, bangladesh, dhaka, residential, commercial">

    <!-- Essential CSS for icons (keep minimal external dependencies) -->
    <link rel="stylesheet"
        href="{{ asset('assets/frontend/wp-content/themes/rttheme18/css/fontello/css/fontello092c.css?ver=4.9.26') }}"
        type="text/css" media="all">

    <!-- Custom CSS variables for consistent theming -->
    <style>
        :root {
            --primary-dark: #1a1a1a;
            --primary-darker: #0a0a0a;
            --accent-yellow: #ffd700;
            --accent-orange: #ff8c00;
            --text-light: #ffffff;
            --text-gray: #cccccc;
            --text-muted: #888888;
            --border-dark: #333333;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }
    </style>

    <style>
        /* Minimal reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #0a0a0a;
            color: #ffffff;
        }

        /* Loading spinner */
        .app-loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #0a0a0a;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid #ffd700;
            border-top: 3px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Hide loading when app is ready */
        #app:not(:empty)+.app-loading {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Vue.js App Container -->
    @inertia

    <!-- Loading Spinner -->
    <div class="app-loading">
        <div class="spinner"></div>
    </div>

    <!-- Vue.js App Scripts -->
    @vite(['resources/js/frontend/app.js'])
</body>

</html>
(t.readyCallback = function() {
t.DOMReady = !0;
}),
t.supports.everything ||
((n = function() {
t.readyCallback();
}),
a.addEventListener ?
(a.addEventListener("DOMContentLoaded", n, !1), e.addEventListener("load", n, !1)) :
(e.attachEvent("onload", n),
a.attachEvent("onreadystatechange", function() {
"complete" === a.readyState && t.readyCallback();
})),
(n = t.source || {}).concatemoji ? c(n.concatemoji) : n.wpemoji && n.twemoji && (c(n.twemoji), c(n
.wpemoji)));
})(window, document, window._wpemojiSettings);
</script>
<style type="text/css">
    img.wp-smiley,
    img.emoji {
        display: inline !important;
        border: none !important;
        box-shadow: none !important;
        height: 1em !important;
        width: 1em !important;
        margin: 0 0.07em !important;
        vertical-align: -0.1em !important;
        background: none !important;
        padding: 0 !important;
    }
</style>
<link rel="stylesheet" id="layerslider-css"
    href="{{ asset('assets/frontend/wp-content/plugins/LayerSlider/static/layerslider/css/layersliderd3c7.css?ver=6.5.1') }}"
    type="text/css" media="all" />
<link rel="stylesheet" id="ls-google-fonts-css"
    href="https://fonts.googleapis.com/css?family=Lato:100,300,regular,700,900%7COpen+Sans:300%7CIndie+Flower:regular%7COswald:300,regular,700&amp;subset=latin%2Clatin-ext"
    type="text/css" media="all" />
<link rel="stylesheet" id="jquery-ui-css"
    href="{{ asset('assets/frontend/wp-content/plugins/candidate-application-form/css/jquery-ui092c.css?ver=4.9.26') }}"
    type="text/css" media="all" />
<link rel="stylesheet" id="jquery.ui.theme-css"
    href="{{ asset('assets/frontend/wp-content/plugins/candidate-application-form/js/themes/base/jquery.ui.theme092c.css?ver=4.9.26') }}"
    type="text/css" media="all" />
<link rel="stylesheet" id="af-style-ic-css"
    href="{{ asset('assets/frontend/wp-content/plugins/candidate-application-form/css/style-ic092c.css?ver=4.9.26') }}"
    type="text/css" media="all" />
<link rel="stylesheet" id="af-mediaform-css"
    href="{{ asset('assets/frontend/wp-content/plugins/candidate-application-form/css/mediaform092c.css?ver=4.9.26') }}"
    type="text/css" media="all" />
<link rel="stylesheet" id="rs-plugin-settings-css"
    href="{{ asset('assets/frontend/wp-content/plugins/revslider/public/assets/css/settings9009.css?ver=5.4.5.1') }}"
    type="text/css" media="all" />
<style id="rs-plugin-settings-inline-css" type="text/css">
    .tp-caption a {
        color: #ff7302;
        text-shadow: none;
        -webkit-transition: all 0.2s ease-out;
        -moz-transition: all 0.2s ease-out;
        -o-transition: all 0.2s ease-out;
        -ms-transition: all 0.2s ease-out;
    }

    .tp-caption a:hover {
        color: #ffa902;
    }
</style>
<link rel="stylesheet" id="normalize-css"
    href="{{ asset('assets/frontend/wp-content/themes/rttheme18/css/normalize092c.css?ver=4.9.26') }}" type="text/css"
    media="all" />
<link rel="stylesheet" id="theme-framework-css"
    href="{{ asset('assets/frontend/wp-content/themes/rttheme18/css/rt-css-framework092c.css?ver=4.9.26') }}"
    type="text/css" media="all" />
<link rel="stylesheet" id="fontello-css"
    href="{{ asset('assets/frontend/wp-content/themes/rttheme18/css/fontello/css/fontello092c.css?ver=4.9.26') }}"
    type="text/css" media="all" />
<link rel="stylesheet" id="jackbox-css"
    href="{{ asset('assets/frontend/wp-content/themes/rttheme18/js/lightbox/css/jackbox.min092c.css?ver=4.9.26') }}"
    type="text/css" media="all" />
<link rel="stylesheet" id="theme-style-all-css"
    href="{{ asset('assets/frontend/wp-content/themes/rttheme18/css/style092c.css?ver=4.9.26') }}" type="text/css"
    media="all" />
<link rel="stylesheet" id="jquery-owl-carousel-css"
    href="{{ asset('assets/frontend/wp-content/themes/rttheme18/css/owl.carousel092c.css?ver=4.9.26') }}"
    type="text/css" media="all" />
<link rel="stylesheet" id="flex-slider-css-css"
    href="{{ asset('assets/frontend/wp-content/themes/rttheme18/css/flexslider092c.css?ver=4.9.26') }}" type="text/css"
    media="all" />
<link rel="stylesheet" id="progression-player-css"
    href="{{ asset('assets/frontend/wp-content/themes/rttheme18/js/video_player/progression-player092c.css?ver=4.9.26') }}"
    type="text/css" media="all" />
<link rel="stylesheet" id="progression-skin-minimal-light-css"
    href="{{ asset('assets/frontend/wp-content/themes/rttheme18/js/video_player/skin-minimal-light092c.css?ver=4.9.26') }}"
    type="text/css" media="all" />
<link rel="stylesheet" id="isotope-css-css"
    href="{{ asset('assets/frontend/wp-content/themes/rttheme18/css/isotope092c.css?ver=4.9.26') }}" type="text/css"
    media="all" />
<link rel="stylesheet" id="jquery-colortip-css"
    href="{{ asset('assets/frontend/wp-content/themes/rttheme18/css/colortip-1.0-jquery092c.css?ver=4.9.26') }}"
    type="text/css" media="all" />
<link rel="stylesheet" id="animate-css"
    href="{{ asset('assets/frontend/wp-content/themes/rttheme18/css/animate092c.css?ver=4.9.26') }}" type="text/css"
    media="all" />
<!--[if IE 7]>
<link rel="stylesheet" id="theme-ie7-css"
    href="https://uniqueom.com/wp-content/themes/rttheme18/css/ie7.css?ver=4.9.26" type="text/css" media="all" />
<![endif]-->
<!--[if lt IE 9]>
<link rel="stylesheet" id="theme-ltie9-css"
    href="https://uniqueom.com/wp-content/themes/rttheme18/css/before_ie9.css?ver=4.9.26" type="text/css"
    media="all" />
<![endif]-->
<link rel="stylesheet" id="theme-skin-css"
    href="{{ asset('assets/frontend/wp-content/themes/rttheme18/css/blue-style092c.css') }}" type="text/css"
    media="all" />
<style id="theme-skin-inline-css" type="text/css">
    .retina#logo {
        background: url("{{ asset('assets/frontend/wp-content/uploads/2015/02/logo-banner.png') }}") no-repeat scroll 0 0 / 100% auto transparent;
        -moz-background-size: 100%;
        -webkit-background-size: 100%;
        -o-background-size: 100%;
        background-size: 100%;
    }

    .retina#logo img {
        display: none;
    }

    #navigation_bar>ul>li>a {
        font-family: "PT Sans Narrow", sans-serif;
        font-weight: normal !important;
    }

    .flex-caption,
    .pricing_table .table_wrap ul>li.caption,
    .pricing_table .table_wrap.highlight ul>li.caption,
    .banner p,
    .sidebar .featured_article_title,
    .footer_widgets_row .featured_article_title,
    .latest-news a.title,
    h1,
    h2,
    h3,
    h4,
    h5 {
        font-family: "PT Sans Narrow", sans-serif;
        font-weight: normal !important;
    }

    body,
    #navigation_bar>ul>li>a span,
    .product_info h5,
    .product_item_holder h5,
    #slogan_text {
        font-family: "PT Sans", sans-serif;
        font-weight: 400 !important;
    }

    .testimonial .text,
    blockquote p {
        font-family: "PT Serif", sans-serif;
        font-weight: normal !important;
    }

    h3 {
        font-size: 22px;
    }

    h6 {
        font-size: 17px;
    }

    body {
        font-size: 15px;
    }

    #row-166114-1 {
        padding-top: 20px;
    }

    #row-166114-1 {
        padding-bottom: 20px;
    }

    @media only screen and (max-width: 767px) {
        #row-166114-1 {
            padding-left: 0px;
            padding-right: 0px;
        }
    }

    #space-166114-129499 {
        height: 10px;
    }

    #space-166114-131353 {
        height: 10px;
    }

    #space-166114-110514 {
        height: 30px;
    }

    #space-166114-115052 {
        height: 30px;
    }

    #space-166114-43877 {
        height: 10px;
    }

    #space-166114-158231 {
        height: 30px;
    }

    #row-166114-2 {
        padding-top: 30px;
    }

    #row-166114-2 {
        padding-bottom: 30px;
    }

    @media only screen and (max-width: 767px) {
        #row-166114-2 {
            padding-left: 0px;
            padding-right: 0px;
        }
    }

    #row-166114-149190 {
        padding-top: 40px;
    }

    #row-166114-149190 {
        padding-bottom: 20px;
    }

    @media only screen and (max-width: 767px) {
        #row-166114-149190 {
            padding-left: 0px;
            padding-right: 0px;
        }
    }

    #space-166114-54098 {
        height: 20px;
    }

    @media only screen and (min-width: 960px) {
        .header-design2 .default_position #navigation_bar>ul>li>a {
            line-height: 80px;
        }

        .header-design2 #logo img {
            max-height: 60px;
        }

        .header-design2 #logo h1,
        .header-design2 #logo h1 a {
            padding: 0;
            line-height: 60px;
        }

        .header-design2 .section_logo>section {
            display: table;
            height: 60px;
        }

        .header-design2 #logo>a {
            display: table-cell;
            vertical-align: middle;
        }
    }

    p {
        text-align: justify;
    }

    #sticky_logo {
        max-width: 250px;
        width: 250px;
    }
</style>
<link rel="stylesheet" id="menu-css"
    href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow&amp;subset=latin%2Clatin-ext&amp;ver=4.9.26"
    type="text/css" media="all" />
<link rel="stylesheet" id="body-css"
    href="http://fonts.googleapis.com/css?family=PT+Sans%3A400%2C400italic&amp;ver=4.9.26" type="text/css"
    media="all" />
<link rel="stylesheet" id="serif-css" href="http://fonts.googleapis.com/css?family=PT+Serif&amp;ver=4.9.26"
    type="text/css" media="all" />
<link rel="stylesheet" id="theme-style-css"
    href="{{ asset('assets/frontend/wp-content/themes/rttheme18/style092c.css?ver=4.9.26') }}" type="text/css"
    media="all" />
<script type="text/javascript">
    /* <![CDATA[ */
    var LS_Meta = {
        v: "6.5.1"
    };
    /* ]]> */
</script>
<script type="text/javascript" data-cfasync="false"
    src="{{ asset('assets/frontend/wp-content/plugins/LayerSlider/static/layerslider/js/greensockb3a6.js?ver=1.19.0') }}">
</script>
<script type="text/javascript" src="{{ asset('assets/frontend/wp-includes/js/jquery/jqueryb8ff.js?ver=1.12.4') }}">
</script>
<script type="text/javascript"
    src="{{ asset('assets/frontend/wp-includes/js/jquery/jquery-migrate.min330a.js?ver=1.4.1') }}"></script>
<script type="text/javascript" data-cfasync="false"
    src="{{ asset('assets/frontend/wp-content/plugins/LayerSlider/static/layerslider/js/layerslider.kreaturamedia.jqueryd3c7.js?ver=6.5.1') }}">
</script>
<script type="text/javascript" data-cfasync="false"
    src="{{ asset('assets/frontend/wp-content/plugins/LayerSlider/static/layerslider/js/layerslider.transitionsd3c7.js?ver=6.5.1') }}">
</script>
<script type="text/javascript" src="{{ asset('assets/frontend/wp-includes/js/plupload/moxie.mine34c.js?ver=1.3.5') }}">
</script>
<script type="text/javascript"
    src="{{ asset('assets/frontend/wp-includes/js/plupload/plupload.min6c17.js?ver=2.1.9') }}"></script>
</head>

<body>

    @inertia

    {{-- plugins --}}
    <script src="{{ asset('plugins/js/jquery.min.js') }}"></script>
    {{-- script --}}
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>

    {{-- ------------------------------------------------------------------------- --}}
    {{-- ------------------------------------------------------------------------- --}}
    {{-- ------------------------------------------------------------------------- --}}
    {{-- <script type="text/javascript">
        document.getElementsByTagName("html")[0].className.replace(/\no-js\b/, "js");
        window.onerror = function() {
            document.getElementById("rt_loading").removeAttribute("class");
        };
    </script> --}}

    {{-- <div id="rt_loading" class="rt_loading"></div> --}}
    <!-- background wrapper -->
    <div id="container">

        <!-- header -->
        {{-- @include('frontend.layouts.includes.header') --}}
        <!-- / end tag #header -->
        <!-- content holder -->
        @yield('content')
        <!-- / end div .content_holder -->
    </div>
    <!-- end div #container -->
    <!-- footer -->
    <!-- FOOTER AREA START -->
    {{-- @include('frontend.layouts.includes.footer') --}}
    <!-- FOOTER AREA END -->
    <!-- / footer -->
    <style type="text/css">
        .footer_widgets_row {
            display: none;
        }

        .featured_article_title {
            font-size: 22px;
        }
    </style>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-includes/js/jquery/ui/core.mine899.js?ver=1.11.4') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-includes/js/jquery/ui/widget.mine899.js?ver=1.11.4') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-includes/js/jquery/ui/mouse.mine899.js?ver=1.11.4') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-includes/js/jquery/ui/draggable.mine899.js?ver=1.11.4') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-includes/js/jquery/ui/resizable.mine899.js?ver=1.11.4') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-includes/js/jquery/ui/button.mine899.js?ver=1.11.4') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-includes/js/jquery/ui/position.mine899.js?ver=1.11.4') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-includes/js/jquery/ui/dialog.mine899.js?ver=1.11.4') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-content/themes/rttheme18/js/jquery.easing.1.3092c.js?ver=4.9.26') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-content/themes/rttheme18/js/jquery.tools.min092c.js?ver=4.9.26') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-content/themes/rttheme18/js/waypoints.min092c.js?ver=4.9.26') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-content/themes/rttheme18/js/video_player/mediaelement-and-player.min092c.js?ver=4.9.26') }}">
    </script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-content/themes/rttheme18/js/lightbox/js/jackbox-packed.min092c.js?ver=4.9.26') }}">
    </script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-content/themes/rttheme18/js/colortip-1.0-jquery092c.js?ver=4.9.26') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-content/themes/rttheme18/js/jquery.flexslider092c.js?ver=4.9.26') }}"></script>
    <script type="text/javascript">
        /* <![CDATA[ */
        var rt_theme_params = {
            ajax_url: "{{ route('ajax.handler') }}",
            rttheme_template_dir: "{{ asset('assets/frontend/wp-content/themes/rttheme18') }}",
            sticky_logo: "on",
            content_animations: "on",
            page_loading: "on",
        };
        /* ]]> */
    </script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-content/themes/rttheme18/js/script092c.js?ver=4.9.26') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/wp-includes/js/comment-reply.min092c.js?ver=4.9.26') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/frontend/wp-includes/js/wp-embed.min092c.js?ver=4.9.26') }}">
    </script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/wp-content/themes/rttheme18/js/owl.carousel.min092c.js?ver=4.9.26') }}"></script>

    {{-- ------------------------------------------------------------------------- --}}
    {{-- ------------------------------------------------------------------------- --}}
    {{-- ------------------------------------------------------------------------- --}}




    {{-- resource & vite --}}
    @vite(['resources/js/frontend/app.js'])
</body>

</html>
