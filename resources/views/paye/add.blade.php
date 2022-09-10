<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
@if(\App\Role::role()->course_add==1)
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">افزودن پایه جدید</div>
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
                <form action="{{route('insert_paye')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">نام پایه</label>
                        <input type="text" class="form-control" name="name">
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن پایه</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
<div class="alert alert-success" role="alert">اسامی پایه ها</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام پایه</th>
                        @if(\App\Role::role()->course_update==1)
                        <th scope="col">ویرایش</th>
                        @endif
                        @if(\App\Role::role()->course_delete==1)
                        <th scope="col">حذف</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_paye as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
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
                                        <form action="{{route('update_paye')}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="id_paye" value="{{$item->id_paye}}">
                                            <div class="row">
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>نام پایه</label>
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
                        <th><a href="{{route('delete_paye',['id_paye'=> $item->id_paye])}}"> <button style="background: #c92616;border-color: #c92616;" type="submit" class="btn btn-primary"><i class="fa fa-trash-o"></i></button></a></th>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection