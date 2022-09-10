<!DOCTYPE html>
<html lang="fa">

<head>@include('layout.css')</head>

<body class="bg-white h-100-vh p-t-0" style="background: #ffd14f;">
<div class="page-loader">
    <div class="spinner-border"></div>
    <span>در حال بارگذاری ...</span>
</div>
<div class="container h-100-vh">
    <div class="row align-items-center h-100-vh">
        <div class="col-lg-10 offset-lg-1 p-t-b-25">
            <div class="d-flex m-b-20">
                <h3 class="m-0">فرم ثبت نام سامانه</h3>
            </div>
            <p>برای ادامه وارد شوید.</p>
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
            <form action="{{ route('done') }}" method="POST">
                @csrf
                <div class="form-group mb-4">
                    <input type="text" name="name" autocomplete="off" class="form-control form-control-lg" placeholder="نام و نام خانوادگی" value="{{old('name')}}">
                </div>
                <div class="form-group mb-4">
                    <input type="number" name="mobile" autocomplete="off" class="form-control form-control-lg" placeholder="کد پرسنلی" value="{{old('mobile')}}">
                </div>
                <div class="form-group mb-4">
                                <select class="form-control" name="team" style="height: 45px;">
                                        <option value="">لطفا گروه مورد نظر را انتخاب کنید</option>
                                        <option value="شورا و 5و6">شورا و 5و6</option>
                                        <option value="جوانان 1">جوانان 1</option>
                                        <option value="جوانان 2">جوانان 2</option>
                                        <option value="صفا 156">صفا 156</option>
                                        <option value="صفا 17">صفا 17</option>
                                        <option value="صفا 18">صفا 18</option>
                                        <option value="صفا 19">صفا 19</option>
                                        <option value="صفا 20">صفا 20</option>
                                        <option value="صفا 21">صفا 21</option>
                                        <option value="22 اسدالله">22 اسدالله</option>
                                        <option value="22 حیدر کرار">22 حیدر کرار</option>
                                        <option value="22 امیر المومنین">22 امیر المومنین</option>
                                </select>                 
                            </div>

                <button type="submit" class="btn btn-primary btn-lg btn-block btn-uppercase mb-4">ثبت نام کاربر</button>
            </form>
            <p class="text-left">
                    <a href="{{ route('login') }}" class="text-underline" style="color:#646464">وارد شوید</a>
                </p>
        </div>
    </div>
</div>
@include('layout.script')
</body>

</html>
