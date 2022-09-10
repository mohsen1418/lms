<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
@if(\App\Role::role()->course_add==1)
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">{{"افزودن کلاس جدید"}}</div>
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
                <form action="{{route('insert_room')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">نام کلاس</label>
                            <input type="text" class="form-control" name="name">
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">نام پایه</label>
                            <select class="js-example-basic-single" name="id_paye" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_paye as $item)
                                <option value="{{$item->id_paye}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن کلاس</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
<div class="alert alert-success" role="alert">اسامی کلاس ها</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام پایه</th>
                        <th scope="col">نام کلاس</th>
                        @if(\App\Role::role()->course_update==1)
                        <th scope="col">ویرایش</th>
                        @endif
                        @if(\App\Role::role()->course_delete==1)
                        <th scope="col">حذف</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_room as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{\App\Paye::where('id_paye',$item->id_paye)->select('name')->first()->name}}</td>
                        <td>{{$item->name}}</td>
                        @if(\App\Role::role()->course_update==1)
                        <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff"><i class="fa fa-edit (alias)"></i></td>
                        <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('update_class')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_room" value="{{$item->id_room}}">
                                            <div class="row">
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>نام کلاس</label>
                                                    <input type="text" class="form-control" name="name" value="{{$item->name}}">
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
                        @endif
                        @if(\App\Role::role()->course_delete==1)
                        <th><a href="{{route('delete_room',['id_room'=> $item->id_room])}}"> <button style="background: #c92616;border-color: #c92616;" type="submit" class="btn btn-primary"><i class="fa fa-trash-o"></i></button></a></th>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection