<nav class="navbar">
        <div class="container-fluid">
            <div class="header-logo">
                <a href="{{route('home')}}">
                    <img src="{{ asset('assets/media/image/logo.png')}}" alt="...">
                    <span class="logo-text d-none d-lg-block">{{DB::table('option')->where('name',"title")->first()->value}}</span>
                </a>
            </div>
            <div class="header-body">
            <ul class="navbar-nav">
                <li class="nav-item d-lg-none d-sm-block">
                    <a href="#" class="nav-link side-menu-open">
                        <i class="ti-menu"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
