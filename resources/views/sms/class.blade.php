<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">ارسال پیامک کلاسی</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('insert_class')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام کلاس</label>
                        <select class="js-example-basic-single" name="id_room" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_room as $item)
                            <option value="{{$item->id_room}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">متن پیام</label>
                        <textarea type="text" class="form-control" name="msg" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">ارسال پیامک</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">ارسال پیامک پایه ای</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('insert_class')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام پایه</label>
                        <select class="js-example-basic-single" name="id_paye" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_paye as $item)
                            <option value="{{$item->id_paye}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">متن پیام</label>
                        <textarea type="text" class="form-control" name="msg" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">ارسال پیامک</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">ارسال پیامک مدرسه ای</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('insert_class')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">متن پیام</label>
                        <textarea type="text" class="form-control" name="msg" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">ارسال پیامک</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection