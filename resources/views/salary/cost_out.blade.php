<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert" >تعریف فاکتور هزینه</div>
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
                <form action="{{route('salary_cost_insert')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
                    <input type="hidden" name="kind" value="1">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">عنوان</label>
                            <input type="text" class="form-control" name="title" value="{{old('title')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">مبلغ</label>
                            <input type="text" class="form-control" name="rate" value="{{old('rate')}}" onkeyup="javascript:this.value=itpro(this.value);">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">تاریخ</label>
                            <input type="text" class="form-control" name="date" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">منبع تامین</label>
                            <select class="custom-select mb-3" name="source" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                <option value="مجتمع">مجتمع</option>
                                <option value="بانی">بانی</option>
                                <option value="تنخواه">تنخواه</option>
                                <option value="درآمد های مدرسه">درآمد های مدرسه</option>
                                <option value="غیره">غیره</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">شماره پیگیری</label>
                            <input type="number" class="form-control" name="issue_track" value="{{old('issue_track')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">تصویر فاکتور</label>
                            <input class="form-control" type="file" name="photo" id="fileToUpload">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">توضیحات</label>
                            <input type="text" class="form-control" name="description" value="{{old('description')}}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">ثبت فاکتور</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection