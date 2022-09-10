<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert" >کلاس بندی دانش آموزان</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('class_user')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام پایه</label>
                        <select class="js-example-basic-single" name="id_paye" dir="rtl" onchange="submit().form">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_paye as $item)
                            <option value="{{$item->id_paye}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($id_paye))
<div class="row">
    <div class="col-md-6">
        <div class="alert alert-success" role="alert">پایه {{\App\Paye::where('id_paye',$id_paye)->first()->name}} - بدون کلاس</div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" tabindex="1">
                    <form action="{{route('update_room')}}" method="POST">
                        @csrf
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ردیف</th>
                                    <th scope="col">نام</th>
                                    <th scope="col">نام خانوادگی</th>
                                    <th scope="col">کلاس</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_user_no as $key=>$item)
                                <input type="hidden" name="id_paye" value="{{$id_paye}}">
                                <input type="hidden" name="id_user[]" value="{{$item->id}}">
                                <tr>
                                    <th scope="row">{{++$key}}</th>
                                    <td>{{$item->fname}}</td>
                                    <td>{{$item->lname}}</td>
                                    <td>
                                        <select class="js-example-basic-single" name="id_room[]" dir="rtl">
                                            @if(\App\User::where('id',$item->id)->first()->id_room=="")
                                            <option value="">انتخاب کنید</option>
                                            @else
                                            <option value="{{\App\User::where('id',$item->id)->first()->id_room}}">{{\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                                            @endif
                                            @foreach($all_room as $item)
                                            <option value="{{$item->id_room}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">ثبت اطلاعات</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="alert alert-success" role="alert">پایه {{\App\Paye::where('id_paye',$id_paye)->first()->name}} - کلاس بندی شده</div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" tabindex="1">
                    <form action="{{route('update_room')}}" method="POST">
                        @csrf
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ردیف</th>
                                    <th scope="col">نام</th>
                                    <th scope="col">نام خانوادگی</th>
                                    <th scope="col">کلاس</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_user_yes as $key=>$item)
                                <input type="hidden" name="id_paye" value="{{$id_paye}}">
                                <input type="hidden" name="id_user[]" value="{{$item->id}}">
                                <tr>
                                    <th scope="row">{{++$key}}</th>
                                    <td>{{$item->fname}}</td>
                                    <td>{{$item->lname}}</td>
                                    <td>
                                        <select class="js-example-basic-single" name="id_room[]" dir="rtl">
                                            @if(\App\User::where('id',$item->id)->first()->id_room=="")
                                            <option value="">انتخاب کنید</option>
                                            @else
                                            <option value="{{\App\User::where('id',$item->id)->first()->id_room}}">{{\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                                            @endif
                                            @foreach($all_room as $item)
                                            <option value="{{$item->id_room}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">ثبت اطلاعات</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection