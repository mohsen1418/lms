<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert" style="background:#1b7866 !important;color:#fff;">{{"ارسال پیام جدید"}}</div>
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
                <form action="{{route('insert_message')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="date" type="hidden" value="{{now()->timestamp}}" />
                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان پیام</label>
                        <input type="text" class="form-control" name="title" value="{{old('title')}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام کلاس</label>
                        <select class="js-example-basic-single" name="id_room" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_room as $ky=>$item)
                            <option value="{{$item->id_room}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">متن پیام</label>
                        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="10">{{old('title')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>آپلود فایل مرتبط</label>
                        <input class="form-control" type="file" name="photo" id="fileToUpload">
                    </div>
                    <button type="submit" class="btn btn-primary">ارسال پیام</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection