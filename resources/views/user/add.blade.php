<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">افزودن دانش آموز جدید</div>
        <div class="card">
            <div class="card-body">
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
                <form action="{{route('insert_user')}}" method="POST">
                    @csrf
                    <div class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">نام <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="fname" value="{{old('fname')}}">
                        </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">نام خانوادگی <span style="color: red;">*</span></label>
                        <input type="text" class="form-control" name="lname" value="{{old('lname')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">نام پدر</label>
                        <input type="text" class="form-control" name="f_fname" value="{{old('f_fname')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">نام خانوادگی مادر</label>
                        <input type="text" class="form-control" name="m_lname" value="{{old('m_lname')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">نام پایه<span style="color: red;">*</span></label>
                        <select class="js-example-basic-single" name="id_paye" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_paye as $ky=>$item)
                            <option value="{{$item->id_paye}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">کد ملی <span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="mobile" value="{{old('mobile')}}">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">تاریخ تولد</label>
                            <input type="text" name="date" class="form-control text-right" dir="ltr">
                        </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">شغل پدر</label>
                        <input type="text" class="form-control" name="f_job" value="{{old('f_job')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">محل کار پدر</label>
                        <input type="text" class="form-control" name="f_adr" value="{{old('f_adr')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">شغل مادر</label>
                        <input type="text" class="form-control" name="m_job" value="{{old('m_job')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">محل کار مادر</label>
                        <input type="text" class="form-control" name="m_adr" value="{{old('m_adr')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">شماره موبایل پدر</label>
                        <input type="number" class="form-control" name="f_number" value="{{old('f_number')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">شماره موبایل مادر</label>
                        <input type="number" class="form-control" name="m_number" value="{{old('m_number')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">شماره ولی پیگیر</label>
                        <input type="number" class="form-control" name="p_number" value="{{old('p_number')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">شماره منزل</label>
                        <input type="number" class="form-control" name="tel" value="{{old('tel')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">آدرس منزل</label>
                        <input type="text" class="form-control" name="adr" value="{{old('adr')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">کد پستی</label>
                        <input type="text" class="form-control" name="zipcode" value="{{old('zipcode')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">رمز عبور <span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="password" value="{{old('password')}}">
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن کاربر جدید</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection