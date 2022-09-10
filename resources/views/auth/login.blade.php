<!DOCTYPE html>
<html lang="fa">

<head>@include('layout.css')</head>

<body class="bg-white h-100-vh p-t-0" style="background-image: url(https://www.karbobala.com/files/photos/1/photos/preview/p19fd8dcrrhduaq51jq31cou1ain2l.jpg);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    height: 100vh;">
    <div class="page-loader">
        <div class="spinner-border"></div>
        <span>در حال بارگذاری ...</span>
    </div>
    <div class="container h-100-vh">
        <div class="row align-items-center h-100-vh">
            <div class="col-lg-4 d-none d-lg-block p-t-b-25">
            </div>
            <div class="col-lg-5 p-t-b-25" style="text-align: center;">
                <p style="font-weight: 700;font-size: 18px;margin-bottom: 15px;color: #fff;">صفا آموز</p>
                <p style="margin-bottom: 35px;color: #fff;">{{DB::table('option')->where('name',"name_school")->first()->value}}</p>
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-with-border alert-dismissible" role="alert">
                    <i class="ti-help-alt m-l-10"></i>{{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endforeach
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="hidden" name="role" value="1">
                    <div class="form-group mb-4">
                        <input type="number" name="mobile" autocomplete="off" class="form-control form-control-lg" placeholder="نام کاربری" value="{{old('mobile')}}">
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" name="password" autocomplete="off" class="form-control form-control-lg" placeholder="رمز عبور">
                    </div>
                    <button class="btn btn-primary btn-lg btn-block btn-uppercase mb-4" style="background: #000000;border-color: #000000;">ورود</button>
                </form>
            </div>
            <div class="col-lg-3 d-none d-lg-block p-t-b-25">
            </div>
        </div>
    </div>
    @include('layout.script')
</body>

</html>