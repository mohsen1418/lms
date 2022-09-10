<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
@if(\App\Role::role()->course_add==1)
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">افزودن متن پیامک جدید</div>
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
                <form action="{{route('insert_msg')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">متن پیام</label>
                            <textarea type="text" class="form-control" name="detail" rows="5"></textarea>
                        </div>
                    <button type="submit" class="btn btn-primary">ثبت اطلاعات</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
<div class="alert alert-success" role="alert">متن پیامک های ذخیره شده</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">متن پیامک</th>
                        <th scope="col">ویرایش</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_msg as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{$item->detail}}</td>
                        <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff"><i class="fa fa-edit (alias)"></i></td>
                        <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('update_msg')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_msg" value="{{$item->id_msg}}">
                                            <div class="row">
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>نام کلاس</label>
                                                    <textarea type="text" class="form-control" name="detail" rows="5">{{$item->detail}}</textarea>
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
                        <th><a href="{{route('delete_msg',['id_msg'=> $item->id_msg])}}"> <button style="background: #c92616;border-color: #c92616;" type="submit" class="btn btn-primary"><i class="fa fa-trash-o"></i></button></a></th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection