<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        @include('template.meta')
        <link href="favicon.png" rel="shortcut icon">
        <link href="apple-touch-icon.png" rel="apple-touch-icon">
        @include('template.css')
    </head>
    <body class="menu-position-side menu-side-left full-screen with-content-panel">
        <div class="all-wrapper with-side-panel solid-bg-all">
            <div class="layout-w">
                @include('template.mobile')
                @include('template.menu')
                <div class="content-w">
                    @yield('titleContent')
                    <div class="content-i masariuman-minheight100vh">
                        <div class="content-box">
                            <div class="element-wrapper">
                                @yield('content')
                            </div>
                            {{-- mode malam --}}
                            <div class="floated-colors-btn floated-chat-btn">
                                <div class="os-toggler-w">
                                    <div class="os-toggler-i">
                                        <div class="os-toggler-pill"></div>
                                    </div>
                                </div>
                                <span>Mode </span><span>Malam</span>
                            </div>
                            {{-- end mode malam --}}
                        </div>
                    </div>
                    @include('template.footer')
                </div>
            </div>
        </div>
        @include('template.js')
    </body>
</html>

@yield('modal')
