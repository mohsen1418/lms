<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert" style="background:#1b7866 !important;color:#fff;text-align:center">{{"افزودن اسلایدر جدید"}}</div>
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
                <form action="{{route('insert_slider')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان</label>
                        <input type="text" class="form-control" name="title" value="{{old('title')}}">
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">آپلود فایل</label>
                        <input class="form-control" type="file" name="photo" id="fileToUpload"><br>
                        <a style="color: #e71313;font-weight: 700;" href="https://lms.andishesafa.ir/ps1/admin/main/slider/16355049682.jpg" target="_blanck"> جهت دانلود سایز اصلی اسلایدر این فایل را دانلود کنید </a>
                    </div>
            <button type="submit" class="btn btn-primary">افزودن اسلایدر</button>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="alert alert-success" role="alert" style="background:#1b7866 !important;color:#fff;text-align:center">لیست اسلایدر ها</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none; touch-action: none;">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">نمایش اسلایدر</th>
                        <th scope="col">وضعیت اسلایدر</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($slider as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{$item->title}}</td>
                        <td><a href="{{'https://lms.andishesafa.ir/ps1/admin/main/slider/'.$item->photo}}" target="_blanck" class="btn subForm btn-primary" style="background: #1512a5;border-color: #1512a5;color:#fff">مشاهده</td>
                        @if($item->status==1)
                        <th><a href="{{route('update_status_slider',['id_slider'=> $item->id_slider])}}"> <button type="submit" class="btn btn-primary">نمایش</button></a></th>
                        @else
                        <th><a href="{{route('update_status_slider',['id_slider'=> $item->id_slider])}}"> <button style="background: #da0101;border-color: #da0101;" type="submit" class="btn btn-primary">پنهان</button></a></th>
                        @endif
                        <th><a href="{{route('delete_slider',['id_slider'=> $item->id_slider])}}"> <button style="background: #c92616;border-color: #c92616;" type="submit" class="btn btn-primary">حذف</button></a></th> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection