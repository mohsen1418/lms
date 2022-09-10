<!DOCTYPE html>
<html lang="fa">
<head>@include('layout.css')</head>
<body>
    <div class="page-loader" style="background:#1b3f78 ;color:#fff">
        <div class="spinner-border"></div>
        <span style="color:#fff">در حال بارگذاری ...</span>
    </div>
    @include('layout.head')
    @include('layout.menu')
    <main class="main-content">
        <div class="container-fluid">
            @yield('content')
            </div>
    </main>
   @include('layout.script')
</body>
</html>