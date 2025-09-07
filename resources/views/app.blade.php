<!doctype html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    {{-- <meta charset="utf-8" /> --}}
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Piller-html - Real Estate Home HTML Template - Home One</title>
    <meta name="author" content="Piller" />
    <meta name="description" content="Piller-html - Real Estate Home HTML Template" />
    <meta name="keywords" content="Piller-html - Real Estate Home HTML Template" />
    <meta name="robots" content="INDEX,FOLLOW" />
    {{-- <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" /> --}}
    <link rel="apple-touch-icon" sizes="57x57" href="assets/frontend/img/favicons/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="assets/frontend/img/favicons/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="assets/frontend/img/favicons/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/frontend/img/favicons/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="assets/frontend/img/favicons/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="assets/frontend/img/favicons/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="assets/frontend/img/favicons/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="assets/frontend/img/favicons/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/frontend/img/favicons/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192"
        href="assets/frontend/img/favicons/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/frontend/img/favicons/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="assets/frontend/img/favicons/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/frontend/img/favicons/favicon-16x16.png" />
    <link rel="manifest" href="assets/frontend/img/favicons/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="assets/frontend/img/favicons/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="assets/frontend/css/app.min.css" />
    <link rel="stylesheet" href="assets/frontend/css/fontawesome.min.css" />
    <link rel="stylesheet" href="assets/frontend/css/style.css" />

    @inertiaHead

</head>

<body>

    @inertia

    <script src="assets/frontend/js/vendor/jquery-3.7.1.min.js"></script>
    <script src="assets/frontend/js/app.min.js"></script>
    <script src="assets/frontend/js/wow.min.js"></script>
    <script src="assets/frontend/js/nice-select.min.js"></script>
    <script src="assets/frontend/js/main.js"></script>
    @vite(['resources/js/frontend/app.js'])
</body>

</html>
