<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <!--bootstrap-icons-->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
     <!-- datatable -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
 
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light theme-color shadow-sm">
            <div class="container" style="max-width: 98%;">
                <div style="float: left;">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <div style="float: right;">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->


                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                                        class="rounded-circle">{{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li class="text-center theme-color"><a class="dropdown-item" href="#">Profile</a>
                                    </li>
                                    <li>

                                    </li>
                                    <li class="text-center theme-color"><a class="dropdown-item"
                                            href="{{ route('logout') }}" onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a></li>
                                </ul>
                            </li>

                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        @guest
        @if (Route::has('login'))
        <main class="py-3">
            <div class="col py-3">
                @yield('content')
            </div> 
        </main>
        @endif

        
        @else
        <main class="main-margin">
            <div class="container-fluid">
                <div class="row flex-nowrap">
                    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 theme-color ">
                        <div
                            class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                                id="menu">
                                <li class="nav-item">
                                    <a href="/home" class="nav-link align-middle px-0">
                                        <i class="fs-4 bi-speedometer2"></i></i> <span
                                            class="ms-1 d-none d-sm-inline">Dashboard</span>
                                    </a>
                                </li>
                                
                                <li>
                                    {{-- <li>
                                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                            <i class="fs-4 bi-bootstrap"></i> <span
                                                class="ms-1 d-none d-sm-inline">Backlink tool</span></a>
                                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                            <li class="w-100">
                                                <a href="website-url-list" class="nav-link px-0"> <span
                                                        class="d-none d-sm-inline">Web</span> urls</a>
                                            </li>
                                            <li>
                                                <a href="link-url-list" class="nav-link px-0"> <span
                                                        class="d-none d-sm-inline">Link</span> urls</a>
                                            </li>
                                        </ul>
                                    </li> --}}
                                    <a href="/stock" class="nav-link px-0 align-middle">
                                        <i class="fs-4 bi-table"></i> <span
                                            class="ms-1 d-none d-sm-inline">Stock</span></a>
                                </li>
                              <li> <a href="/sells" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i> <span
                                    class="ms-1 d-none d-sm-inline">Sells</span></a>
                        </li>
                        <li> <a href="/customers" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span
                                class="ms-1 d-none d-sm-inline">Customers</span></a>
                    </li>  
                            </ul>
                            <hr>

                        </div>
                    </div>
                    <div class="col py-3">
                        @yield('content')
                    </div>
                </div>
            </div>

        </main>
        @endguest
        <div class="theme-color main-margin">
            <div class="container">
                <footer class="py-3 my-4">
                    {{-- <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
                    </ul> --}}
                    <p class="text-center text-muted">© 2021 {{ config('app.name', 'Laravel') }}</p>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script>
        $(document).ready( function () {
            $.noConflict();
        $('#myTable').DataTable();
         } );
         function downloadFile(filePath) {
          var link = document.createElement('a');
          link.href = filePath;
          link.download = filePath.substr(filePath.lastIndexOf('/') + 1);
          link.click();
          }
        </script>
        @if (session('status'))
        <script>
             Swal.fire({
    toast: true,
    icon: 'success',
    title: "{{ session('status') }}",
    animation: false,
    position: 'top-end',
    animation: true,
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
       </script>
       {{session()->forget('status');}}
       @endif
    </div>
    @stack('scriptBottom')
</body>

</html>