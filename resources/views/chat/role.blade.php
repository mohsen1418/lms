<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="alert alert-success" role="alert">سطح دسترسی پیام رسان صفا آموز</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('role_chat')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputPassword1">نام و نام خانوادگی</label>
                            <select class="js-example-basic-single" name="id_user" dir="rtl" onchange="submit().form">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_user as $item)
                                <option value="{{$item->id}}">{{$item->fname." ".$item->lname}}</option>
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
    <div class="col-md-12">
        <div class="alert alert-success" role="alert"> دسترسی های {{\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname}}</div>
        <form action="{{route('insert_role_chat')}}" method="POST">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @csrf
                        @foreach($all_room as $item)
                        <input name="id_user" value="{{$id_user}}" type="hidden">
                        <input name="id_room[]" value="{{$item->id_room}}" type="hidden">
                        <div class="form-group col-md-3">
                            <label>{{$item->name}}</label>
                            <select class="custom-select mb-3" name="kind[]" dir="rtl">
                                @if(\App\Access::where('id_user',$id_user)->where('id_room',$item->id_room)->where('kind',0)->count()!=0)
                                <option value="0">خیر</option>
                                <option value="1">بله</option>
                                @else
                                <option value="1">بله</option>
                                <option value="0">خیر</option>
                                @endif
                            </select>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary">ثبت تغییرات</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
</div>
@endif
@endsection