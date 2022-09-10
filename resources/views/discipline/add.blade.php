<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">افزودن مورد انضباطی</div>
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
                <form action="{{route('insert_discipline')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">مورد انضباطی</label>
                            <select class="js-example-basic-single" name="id_discipline" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_discipline as $ky=>$item)
                                <option value="{{$item->id_discipline}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">تاریخ</label>
                            <input type="text" name="date" data-input-mask="date" class="form-control text-right" value="{{jdate('Y/m/d')}}" dir="ltr" maxlength="10" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">آیا از نمره انضباط کسر شود ؟</label>
                            <select class="custom-select mb-3" name="kind" dir="rtl">
                                <option value="بله">بله</option>
                                <option value="خیر">خیر</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">آیا پیامک ارسال شود ؟</label>
                            @if((DB::table('charge')->sum('price') - (DB::table('sms')->sum('count') * 500)) >= 5000)
                            <select class="custom-select mb-3" name="sms" dir="rtl">
                                <option value="بله">بله</option>
                                <option value="خیر">خیر</option>
                            </select>
                            @else
                            <select class="custom-select mb-3" name="sms" dir="rtl">
                                <option value="خیر">عدم موجودی شارژ پیامک</option>
                            </select>
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">توضیحات تکمیلی</label>
                            <input type="text" name="detail" class="form-control text-right">
                        </div>
                    </div>
                    <hr>
                    <label for="exampleInputEmail1">انتخاب نام دانش آموز</label>
                    <br>
                    <div class="row">
                        @foreach($all_room as $room)
                        <div class="col-md-6">
                            <div class="accordion accordion-primary custom-accordion" style="margin-bottom: 15px;">
                                <div class="accordion-row">
                                    <a href="#" class="accordion-header">
                                        <span>{{$room->name}}</span>
                                        <i class="accordion-status-icon close fa fa-chevron-up"></i>
                                        <i class="accordion-status-icon open fa fa-chevron-down"></i>
                                    </a>
                                    <div class="accordion-body">
                                        <div class="table-responsive" tabindex="1">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">انتخاب</th>
                                                        <th scope="col">نام</th>
                                                        <th scope="col">نام خانوادگی</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($all_user as $key=>$item)
                                                    @if($room->id_room==$item->id_room)
                                                    <tr>
                                                        <td><input class="form-check-input" type="checkbox" value="{{$item->id}}" name="id_user[]" style="margin-top: -4px;margin-right: 1px;"></td>
                                                        <td>{{$item->fname}}</td>
                                                        <td>{{$item->lname}}</td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">ثبت مورد</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection