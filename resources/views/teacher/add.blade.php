<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">{{"افزودن دبیر جدید"}}</div>
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
                <form action="{{route('insert_teacher')}}" method="POST">
                    @csrf
                    <div class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">نام </label>
                        <input type="text" class="form-control" name="fname" value="{{old('fname')}}">
                        </small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">نام خانوادگی</label>
                        <input type="text" class="form-control" name="lname" value="{{old('lname')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">شماره موبایل</label>
                        <input type="number" class="form-control" name="mobile" value="{{old('mobile')}}">
                        </small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">رمز عبور</label>
                        <input type="number" class="form-control" name="password" value="{{old('password')}}">
                        </small>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن دبیر</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-success" role="alert">اسامی دبیران</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">نام کاربری</th>
                        <th scope="col">گذرواژه</th>
                        <th scope="col">ویرایش</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_teacher as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{$item->fname}}</td>
                        <td>{{$item->lname}}</td>
                        <td>{{$item->mobile}}</td>
                        <td>{{$item->pass}}</td>
                        <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff"><i class="fa fa-edit (alias)"></i></td>
                        <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('update_teacher')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <div class="row">
                                            <div class="col-md-12 mxt-2">
                                                    <label>نام</label>
                                                    <input type="text" class="form-control" name="fname" value="{{$item->fname}}">
                                                </div>
                                                <div class="col-md-12 mxt-2">
                                                    <label>نام خانوادگی</label>
                                                    <input type="text" class="form-control" name="lname" value="{{$item->lname}}">
                                                </div>
                                                <div class="col-md-12 mxt-2">
                                                    <label>نام کاربری</label>
                                                    <input type="text" class="form-control" name="mobile" value="{{$item->mobile}}">
                                                </div>
                                                <div class="col-md-12 mxt-2">
                                                    <label>گذرواژه جدید</label>
                                                    <input type="text" class="form-control" name="password" value="{{$item->pass}}">
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">ویرایش گذرواژه</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <td><a class="btn subForm btn-primary" href="{{route('delete_user',['id'=> $item->id])}}" style="color:#fff;background: #db0909; border: 1px solid red;"><i class="fa fa-trash-o"></i></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection