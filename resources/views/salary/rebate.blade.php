<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
@if(Auth::user()->role!=2)
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">تعریف میزان تخفیف و اقساط</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('insert_rebate')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">عنوان</label>
                            <input type="text" class="form-control" name="title" value="{{old('title')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">قیمت تخفیف</label>
                            <select class="custom-select mb-3" name="rate" dir="rtl">
                                <option value="0">انتخاب کنید</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="30">30</option>
                                <option value="35">35</option>
                                <option value="40">40</option>
                                <option value="45">45</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">تعداد اقساط</label>
                            <select class="custom-select mb-3" name="count" dir="rtl">
                                <option value="0">انتخاب کنید</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">ثبت اطلاعات</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
<div class="alert alert-success" role="alert">مشاهده لیست تخفیف و اقساط</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">درصد تخفیف</th>
                        <th scope="col">تعداد اقساط</th>
                        @if(Auth::user()->role!=2)
                        <th scope="col">ویرایش</th>
                        <th scope="col">حذف</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rebate as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{$item->title}}</td>
                        <td>{{$item->rate." %"}}</td>
                        <td>{{number_format($item->count)}}</td>
                        @if(Auth::user()->role!=2)
                        <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff"><i class="fa fa-edit (alias)"></i></td>
                        <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('update_rebate')}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="id_rebate" value="{{$item->id_rebate}}">
                                            <div class="row">
                                                <div class="col-md-12 mxt-2">
                                                    <label>عنوان</label>
                                                    <input type="text" class="form-control" name="title" value="{{$item->title}}">
                                                </div>
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>درصد تخفیف</label>
                                                    <select class="custom-select mb-3" name="rate" dir="rtl">
                                                        <option value="{{$item->rate}}">{{$item->rate}}</option>
                                                        <option value="0">0</option>
                                                        <option value="5">5</option>
                                                        <option value="10">10</option>
                                                        <option value="15">15</option>
                                                        <option value="20">20</option>
                                                        <option value="25">25</option>
                                                        <option value="30">30</option>
                                                        <option value="35">35</option>
                                                        <option value="40">40</option>
                                                        <option value="45">45</option>
                                                        <option value="50">50</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>تعداد اقساط</label>
                                                    <select class="custom-select mb-3" name="count" dir="rtl">
                                                        <option value="{{$item->count}}">{{$item->count}}</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">ویرایش اطلاعات</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <td><a class="btn subForm btn-primary" href="{{route('delete_rebate',['id_rebate'=> $item->id_rebate])}}" style="color:#fff;background: #db0909; border: 1px solid red;"><i class="fa fa-trash-o"></i></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection