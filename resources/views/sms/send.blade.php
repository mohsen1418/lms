<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">ارسال پیامک فردی</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('send_sms')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام کلاس</label>
                        <select class="js-example-basic-single" name="id_room" dir="rtl" onchange="submit().form">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_room as $item)
                            <option value="{{$item->id_room}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($id_room))
<div class="alert alert-success" role="alert">اسامی دانش آموزان کلاس {{\App\Room::where('id_room',$id_room)->first()->name}}</div>
<div class="card">
    <div class="card-body">
        <form action="{{route('insert_sms')}}" method="POST">
            @csrf
            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">متن پیام</label>
                <textarea type="text" class="form-control" name="msg" rows="5"></textarea>
            </div>
            <div class="form-group col-md-12">
                <label for="exampleInputPassword1">پیام های از پیش نوشته شده</label>
                <select class="js-example-basic-single" name="detail" dir="rtl">
                    <option value="">انتخاب کنید</option>
                    @foreach($all_msg as $item)
                    <option value="{{$item->detail}}">{{$item->detail}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="exampleInputPassword1">انتخاب نام دانش آموز</label>
            </div>
            <div class="table-responsive" tabindex="1">
            <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">انتخاب</th>
                            <th scope="col">ردیف</th>
                            <th scope="col">نام</th>
                            <th scope="col">نام خانوادگی</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_user as $key=>$item)
                        <tr>
                            <td><input class="form-check-input" type="checkbox" value="{{$item->id}}" name="id_user[]" style="margin-top: -8px;margin-right: -8px;"></td>
                            <th scope="row">{{++$key}}</th>
                            <td>{{$item->fname}}</td>
                            <td>{{$item->lname}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">ارسال پیامک</button>
        </form>
    </div>
</div>
@endif
@endsection