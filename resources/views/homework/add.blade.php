<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">افزودن تکلیف جدید</div>
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
                <form action="{{route('insert_homework')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">عنوان تکلیف</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">نام درس</label>
                            <select class="js-example-basic-single" name="id_course" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_course as $ky=>$item)
                                <option value="{{$item->id_course}}">{{$item->name." - ".\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">تاریخ شروع</label>
                            <input type="text" name="date1" data-input-mask="date" class="form-control text-right" dir="ltr" maxlength="10" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">زمان شروع</label>
                            <div class="input-group clockpicker-autoclose-demo">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                </div>
                                <input type="text" name="clock1" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">تاریخ پایان</label>
                            <input type="text" name="date2" data-input-mask="date" class="form-control text-right" dir="ltr" maxlength="10" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">زمان پایان</label>
                            <div class="input-group clockpicker-autoclose-demo">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                </div>
                                <input type="text" name="clock2" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">آپلود فایل</label>
                            <input type="file" name="file" class="form-control text-right">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">توضیحات</label>
                            <textarea type="text" class="form-control" name="detail"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن تکلیف</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection