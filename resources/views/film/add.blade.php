<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">{{"افزودن فیلم جدید"}}</div>
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
                <form action="{{route('insert_film')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام درس</label>
                        <select class="js-example-basic-single" name="id_course" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_course as $item)
                            <option value="{{$item->id_course}}">{{$item->name." - ".\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان فیلم</label>
                        <input type="text" class="form-control" name="name">
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">آدرس فیلم</label>
                        <input type="text" class="form-control" name="url">
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">شماره جلسه</label>
                        <input type="number" class="form-control" name="session">
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">زمان فیلم به دقیقه</label>
                        <input type="number" class="form-control" name="time">
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">آیا نمایش داده شود ؟</label>
                        <select class="js-example-basic-single" name="status" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            <option value="1">بله</option>
                            <option value="0">خیر</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن فیلم</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection