<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        @include('template.meta')
        <link href="favicon.png" rel="shortcut icon">
        <link href="apple-touch-icon.png" rel="apple-touch-icon">
        @include('template.css')
        <script src="/js/app.js" defer></script>
    </head>
    <body class="menu-position-side menu-side-left full-screen with-content-panel">
        <div class="all-wrapper with-side-panel solid-bg-all" id="root"></div>
        @include('template.js')
    </body>
</html>

@yield('modal')
