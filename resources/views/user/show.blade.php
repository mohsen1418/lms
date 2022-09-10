<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="alert alert-success" role="alert">انتخاب کلاس</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('show_user')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام کلاس</label>
                        <select class="js-example-basic-single" name="id_room" dir="rtl" onchange="submit().form">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_room as $item)
                            <option value="{{$item->id_room}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="alert alert-success" role="alert">انتخاب پایه</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('show_user')}}" method="POST">
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
@if(isset($class) || isset($paye))
@if(isset($class))
<div class="alert alert-success" role="alert">اسامی کلاس {{$class}}</div>
@else
<div class="alert alert-success" role="alert">اسامی پایه {{$paye}}</div>
@endif
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">کد ملی</th>
                        <th scope="col">نام پدر</th>
                        <th scope="col">موبایل پدر</th>
                        <th scope="col">موبایل مادر</th>
                        <th scope="col">شماره منزل</th>
                        @if(\App\Role::role()->student_password==1)
                        <th scope="col">گذرواژه</th>
                        @endif
                        <th scope="col">عکس</th>
                        @if(\App\Role::role()->student_update==1)
                        <th scope="col">ویرایش</th>
                        @endif
                        @if(\App\Role::role()->student_delete==1)
                        <th scope="col">حذف</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 0; ?>
                    @foreach ($user as $key=>$item)
                    <tr>
                        <th scope="row">{{++$row}}</th>
                        <td>{{$item->fname}}</td>
                        <td>{{$item->lname}}</td>
                        <td>{{$item->mobile}}</td>
                        <td>{{$item->f_fname}}</td>
                        <td>{{$item->f_number}}</td>
                        <td>{{$item->m_number}}</td>
                        <td>{{$item->tel}}</td>
                        @if(\App\Role::role()->student_password==1)
                        <td>{{$item->pass}}</td>
                        @endif
                        @if($item->avatar!="")
                        <td>
                            <figure class="avatar"><img src="{{"https://lms.andishesafa.ir/ps1/admin/main/public/avatar/".$item->avatar}}" class="rounded-circle"></figure>
                        </td>
                        @else
                        <td>
                            <figure class="avatar"><img src="https://www.pngall.com/wp-content/uploads/5/User-Profile-PNG-Free-Download.png" class="rounded-circle"></figure>
                        </td>
                        @endif
                        @if(\App\Role::role()->student_update==1)
                        <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff"><i class="fa fa-edit (alias)"></i></td>
                        <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('update_user')}}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            @if(isset($class))
                                            <input type="hidden" name="id_room" value="{{$id_room}}">
                                            @endif
                                            @if(isset($paye))
                                            <input type="hidden" name="id_paye" value="{{$id_paye}}">
                                            @endif
                                            <div class="row">
                                                <div class="col-md-6 mxt-2">
                                                    <label>نام</label>
                                                    <input type="text" class="form-control" name="fname" value="{{$item->fname}}">
                                                </div>
                                                <div class="col-md-6 mxt-2 m-t-10">
                                                    <label>نام خانوادگی</label>
                                                    <input type="text" class="form-control" name="lname" value="{{$item->lname}}">
                                                </div>
                                                <div class="col-md-6 mxt-2 m-t-10">
                                                    <label>نام پدر</label>
                                                    <input type="text" class="form-control" name="f_fname" value="{{$item->f_fname}}">
                                                </div>
                                                <div class="col-md-6 mxt-2 m-t-10">
                                                    <label>نام خانوادگی مادر</label>
                                                    <input type="text" class="form-control" name="m_lname" value="{{$item->m_lname}}">
                                                </div>
                                                <div class="col-md-6 mxt-2 m-t-10">
                                                    <label>کد ملی</label>
                                                    <input type="text" class="form-control" name="mobile" value="{{$item->mobile}}">
                                                </div>
                                                <div class="col-md-6 mxt-2 m-t-10">
                                                    <label>تاریخ تولد</label>
                                                    <input type="text" name="date" class="form-control text-right" dir="ltr" value="{{$item->date}}">
                                                </div>
                                                <div class="col-md-6 mxt-2 m-t-10">
                                                    <label>موبایل پدر</label>
                                                    <input type="text" class="form-control" name="f_number" value="{{$item->f_number}}">
                                                </div>
                                                <div class="col-md-6 mxt-2 m-t-10">
                                                    <label>موبایل مادر</label>
                                                    <input type="text" class="form-control" name="m_number" value="{{$item->m_number}}">
                                                </div>
                                                <div class="col-md-6 mxt-2 m-t-10">
                                                    <label>موبایل ولی پیگیر</label>
                                                    <input type="text" class="form-control" name="p_number" value="{{$item->p_number}}">
                                                </div>
                                                <div class="col-md-6 mxt-2 m-t-10">
                                                    <label>شغل پدر</label>
                                                    <input type="text" class="form-control" name="f_job" value="{{$item->f_job}}">
                                                </div>
                                                <div class="col-md-6 mxt-2 m-t-10">
                                                    <label>شغل مادر</label>
                                                    <input type="text" class="form-control" name="m_job" value="{{$item->m_job}}">
                                                </div>
                                                <div class="col-md-6 mxt-2 m-t-10">
                                                    <label>شماره منزل</label>
                                                    <input type="text" class="form-control" name="tel" value="{{$item->tel}}">
                                                </div>
                                                <div class="col-md-6 mxt-2 m-t-10">
                                                    <label>کد پستی</label>
                                                    <input type="text" class="form-control" name="zipcode" value="{{$item->zipcode}}">
                                                </div>
                                                <div class="col-md-6 mxt-2 m-t-10">
                                                    <label>گذرواژه</label>
                                                    <input type="text" class="form-control" name="password" value="{{$item->pass}}">
                                                </div>
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>محل کار پدر</label>
                                                    <input type="text" class="form-control" name="f_adr" value="{{$item->f_adr}}">
                                                </div>
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>محل کار مادر</label>
                                                    <input type="text" class="form-control" name="m_adr" value="{{$item->m_adr}}">
                                                </div>
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>آدرس منزل</label>
                                                    <input type="text" class="form-control" name="adr" value="{{$item->adr}}">
                                                </div>
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>عکس پروفایل</label>
                                                    <input class="form-control" type="file" name="photo" id="fileToUpload">
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
                        @if(\App\Role::role()->student_delete==1)
                        <td><a class="btn subForm btn-primary" href="{{route('delete_user',['id'=> $item->id])}}" style="color:#fff;background: #db0909; border: 1px solid red;"><i class="fa fa-trash-o"></i></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection