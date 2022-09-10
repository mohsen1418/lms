<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">خروجی اطلاعات با اکسل</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('user_export')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputPassword1">نام پایه</label>
                            <select class="js-example-basic-single" name="id_room" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_room as $item)
                                <option value="{{$item->id_room}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">خروجی اکسل</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection