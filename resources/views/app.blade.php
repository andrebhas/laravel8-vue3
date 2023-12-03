<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="format-detection" content="telephone=no">

        <title>PT. ABC ERP</title>
        <meta name="keywords" content="MBSS ERP" />
        <meta name="description" content="MBSS ERP" />

        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

        <!-- CSS -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    </head>

    <body>
        <div id="app"></div>
    </body>

    <script src="{{ mix('js/app.js') }}"></script>
</html>
