<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @if (Auth::check())
            <!-- Styles -->
            <link rel="stylesheet" href="{{ asset('/backend/css/backend.css') }}?<?php echo time(); ?>">
            <!-- Scripts -->
            @routes
            <script src="{{ asset('/backend/js/manifest.js') }}?<?php echo time(); ?>" defer></script>
            <script src="{{ asset('/backend/js/vendor.js') }}?<?php echo time(); ?>" defer></script>
            <script src="{{ asset('/backend/js/app.js') }}?<?php echo time(); ?>" defer></script>
        @else
            <!-- Styles -->
            <link rel="stylesheet" href="{{ asset('/frontend/css/frontend.css') }}?<?php echo time(); ?>">
            <!-- Scripts -->
            @routes
            <script src="{{ asset('/frontend/js/manifest.js') }}?<?php echo time(); ?>" defer></script>
            <script src="{{ asset('/frontend/js/vendor.js') }}?<?php echo time(); ?>" defer></script>
            <script src="{{ asset('/frontend/js/app.js') }}?<?php echo time(); ?>" defer></script>
        @endif
    </head>
    <body class="font-sans antialiased layout-fixed sidebar-mini">
        @inertia
    </body>
</html>
