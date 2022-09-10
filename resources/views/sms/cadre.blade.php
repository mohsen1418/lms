<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="alert alert-success" role="alert">ارسال پیامک به کادر مدرسه</div>
<div class="card">
    <div class="card-body">
        <form action="{{route('insert_sms')}}" method="POST">
            @csrf
            <input type="hidden" value="1" name="cadre">
            <div class="form-group col-md-12">
                <label for="exampleInputEmail1">متن پیام</label>
                <textarea type="text" class="form-control" name="msg" rows="5"></textarea>
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
@endsection