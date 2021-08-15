<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--- Awesomes Fonts --->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css"
     integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h"
      crossorigin="anonymous">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <script src = " https://code.jquery.com/jquery-3.3.1.js " integration = "sha256-2Kok7MbOyxpgUVvAk / HJ2jigOSYS2auK4Pfzbm7uH60 =" crossorigin = "anonymous"> </script>
    <script src = " https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js "> </script>
    <script src = " https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js "> </script>
    {{-- <script src="/path/to/tinymce.min.js"></script> --}}
    <script src="https://cdn.tiny.cloud/1/lxm7motk8d62euqm7hminl3zm2okmf94ewpv68lilrw2a8kg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    {{-- <script>
      tinymce.init({
        selector: 'textarea'
      });
    </script> --}}
 


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="wrapper">
            <!-- Sidebar -->
            @include('blog.admin.layouts.parts.sidebar')

            <!-- Page Content -->
            <div class="content container-fluid bg-contant-admin  px-0">
                <nav class="navbar navbar-expand-lg  px-0 pr-0  mb-4">
                    <div class="container-fluid">
                        <button type="button" id="sidebarCollapse2" class="navbar-btn  border-0 d-xl-none" title="Открыть sitebar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </nav>
                @include('blog.admin.includes.breadcrumb')
                @yield('content')
            </div>
           
        </div>
        {{-- @include('blog.admin.widgets.modals.admin-post-delete') --}}
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('/plugins/tinymce/tinymce.min.js') }}" defer></script>
    @yield('script')
    <script type="text/javascript">
        tinymce.init({
            selector: '.tiny',
        });
    </script> 
</body>
</html>
