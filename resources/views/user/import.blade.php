<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">ورودی اطلاعات با اکسل</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('import_insert_user')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">نام پایه</label>
                            <select class="js-example-basic-single" name="id_paye" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_paye as $item)
                                <option value="{{$item->id_paye}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>آپلود فایل اکسل</label>
                            <input class="form-control" type="file" name="photo" id="fileToUpload">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">آپلود فایل</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection