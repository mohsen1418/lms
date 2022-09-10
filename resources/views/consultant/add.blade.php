<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="alert alert-success" role="alert">مشاورات</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('add_consultant')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputPassword1">نام دانش آموز</label>
                            <select class="js-example-basic-single" name="id_user" dir="rtl" onchange="submit().form">
                                @if(isset($id_user))
                                <option value="{{$id_user}}">{{\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname." - ".\App\Paye::join('users','users.id_paye','paye.id_paye')->where('users.id',$id_user)->first()->name}}</option>
                                @else
                                <option value="">انتخاب کنید</option>
                                @endif
                                @foreach($all_user as $item)
                                <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - "}}{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($id_user))
<div class="row">
    <div class="col-md-6">
        <div class="alert alert-success" role="alert">جزئیات جلسه</div>
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
                <form action="{{route('insert_consultant')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id_user" value="{{$id_user}}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">حاضرین</label>
                            <select class="js-example-basic-single" name="Present" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                <option value="دانش آموز">دانش آموز</option>
                                <option value="اولیا">اولیا</option>
                                <option value="هر دو">هر دو</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">نوع جلسه</label>
                            <select class="js-example-basic-single" name="kind" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                <option value="حضوری">حضوری</option>
                                <option value="تلفنی">تلفنی</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">مدت زمان جلسه به دقیقه</label>
                            <input type="number" name="time" class="form-control text-right" dir="ltr">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">تاریخ</label>
                            <input type="text" name="date" data-input-mask="date" class="form-control text-right" value="{{jdate('Y/m/d')}}" dir="ltr" maxlength="10" autocomplete="off">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleFormControlTextarea1">دستور جلسه</label>
                            <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="10" name="text"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">ثبت اطلاعات</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="alert alert-success" role="alert">آرشیو جلسات پیشین</div>
        @foreach($all_consultant as $item)
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">حاضرین</label>
                        <input type="text" disabled value="{{$item->Present}}" class="form-control text-right" dir="ltr">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">نوع جلسه</label>
                        <input type="text" disabled value="{{$item->kind}}" class="form-control text-right" dir="ltr">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">مدت زمان جلسه به دقیقه</label>
                        <input type="text" disabled value="{{$item->time}}" class="form-control text-right" dir="ltr">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">تاریخ</label>
                        <input type="text" disabled value="{{$item->date}}" class="form-control text-right" dir="ltr">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleFormControlTextarea1">دستور جلسه</label>
                        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="10" name="text">{{$item->text}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection