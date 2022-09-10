<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
@if(Auth::user()->role!=2)
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert" >زمان بندی قرارداد مالی</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('insert_time')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">تاریخ</label>
                            <input type="text" name="date" class="form-control text-right" dir="ltr">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">ساعت شروع</label>
                            <div class="input-group clockpicker-autoclose-demo">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" value="11:00" name="time_in">
                            </div> </small>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">ساعت پایان</label>
                            <div class="input-group clockpicker-autoclose-demo">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-clock-o"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" value="19:00" name="time_out">
                            </div> </small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">ثبت اطلاعات</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
<div class="alert alert-success" role="alert">مشاهده زمان های ثبت شده</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col">ساعت شروع</th>
                        <th scope="col">ساعت پایان</th>
                        <th scope="col">نام کاربر</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($time as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{$item->date}}</td>
                        <td>{{$item->time_in}}</td>
                        <td>{{$item->time_out}}</td>
                        @if(\App\User::where('id',$item->id_user)->count()>0)
                        <td>{{\App\User::where('id',$item->id_user)->first()->fanme." ".\App\User::where('id',$item->id_user)->first()->lanme}}</td>
                        @else
                        <td></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection