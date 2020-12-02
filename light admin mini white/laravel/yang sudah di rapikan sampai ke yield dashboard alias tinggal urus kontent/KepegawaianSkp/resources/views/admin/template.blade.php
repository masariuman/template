<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        @include('admin.template_partial.meta')
        <link href="/iniTemplate/dist/favicon.png" rel="shortcut icon">
        <link href="/iniTemplate/dist/apple-touch-icon.png" rel="apple-touch-icon">
        @include('admin.template_partial.css')
    </head>
    <body class="menu-position-side menu-side-left full-screen with-content-panel">
        <div class="all-wrapper with-side-panel solid-bg-all">
            <div class="layout-w">
                @include('admin.template_partial.mobile')
                @include('admin.template_partial.sidebar')
                <div class="content-w">
                    @yield('titleContent')
                    <div class="content-i masariuman-minheight100vh">
                        <div class="content-box">
                            <div class="element-wrapper">
                                <div class="element-box">
                                    @yield('content')
                                </div>
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
                    @include('admin.template_partial.footer')
                </div>
            </div>
        </div>
    @include('admin.template_partial.js')
  </body>
</html>
