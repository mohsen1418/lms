<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
@if(\App\Role::role()->course_add==1)
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">{{"افزودن درس جدید"}}</div>
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
                <form action="{{route('insert_course')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">نام کلاس</label>
                            <select class="js-example-basic-single" name="id_room" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_room as $ky=>$item)
                                <option value="{{$item->id_room}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">نام دبیر</label>
                            <select class="js-example-basic-single" name="id_teacher" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_teacher as $ky=>$item)
                                <option value="{{$item->id}}">{{$item->fname." ".$item->lname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">نام درس</label>
                            <input type="text" class="form-control" name="name">
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">نوع کلاس</label>
                            <select class="js-example-basic-single" name="kind" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                <option value="آموزشی">آموزشی</option>
                                <option value="مهارتی">مهارتی</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن درس</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@foreach($all_room as $room)
<div class="alert alert-success" role="alert">لیست دروس کلاس {{$room->name}}</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام دبیر</th>
                        <th scope="col">نام درس</th>
                        <th scope="col">نوع کلاس</th>
                        <th scope="col">تعداد فیلم</th>
                        <th scope="col">مشاهده</th>
                        @if(\App\Role::role()->course_update==1)
                        <th scope="col">ویرایش</th>
                        @endif
                        @if(\App\Role::role()->course_delete==1)
                        <th scope="col">حذف</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 0; ?>
                    @foreach ($all_course as $key=>$course)
                    <tr>
                        @if($room->id_room==$course->id_room)
                        <th scope="row">{{++$row}}</th>
                        @if(\App\User::where('id',$course->id_teacher)->count()>0)
                        <th scope="row">{{\App\User::where('id',$course->id_teacher)->first()->fname." ".\App\User::where('id',$course->id_teacher)->first()->lname}}</th>
                        @else
                        <th scope="row">-</th>
                        @endif
                        <th scope="row">{{$course->name}}</th>
                        <th scope="row">{{$course->kind}}</th>
                        <th scope="row">{{\App\Film::where('id_course',$course->id_course)->count()}}</th>
                        <th><a href="{{route('view',['id_course'=>$course->id_course])}}"> <button type="submit" class="btn btn-primary" style="background: #761b78;border-color: #761b78;"><i class="fa  fa-eye"></i></button></a></th>
                        @if(\App\Role::role()->course_delete==1)
                        <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff"><i class="fa fa-edit (alias)"></i></td>
                        <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('update_course')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_course" value="{{$course->id_course}}">
                                            <div class="row">
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>نام درس</label>
                                                    <input type="text" class="form-control" name="name" value="{{$course->name}}">
                                                </div>
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>نام کلاس</label>
                                                    <select class="js-example-basic-single" name="kind" dir="rtl">
                                                        @if($course->kind=="آموزشی")
                                                        <option value="آموزشی">آموزشی</option>
                                                        <option value="مهارتی">مهارتی</option>
                                                        @else
                                                        <option value="مهارتی">مهارتی</option>
                                                        <option value="آموزشی">آموزشی</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>نام دبیر</label>
                                                    <select class="js-example-basic-single" name="id_teacher" dir="rtl">
                                                        @if($course->id_teacher!=null)
                                                        <option value="{{$course->id_teacher}}">{{\App\User::where('id',$course->id_teacher)->first()->fname." ".\App\User::where('id',$course->id_teacher)->first()->lname}}</option>
                                                        @else
                                                        <option value="">انتخاب کنید</option>
                                                        @endif
                                                        @foreach($all_teacher as $teacher)
                                                        <option value="{{$teacher->id}}">{{$teacher->fname." ".$teacher->lname}}</option>
                                                        @endforeach
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
                        @endif
                        @if(\App\Role::role()->course_delete==1)
                        <th><a href="{{route('delete_course',['id_course'=> $course->id_course])}}"> <button style="background: #c92616;border-color: #c92616;" type="submit" class="btn btn-primary"><i class="fa fa-trash-o"></i></button></a></th>
                        @endif
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endforeach
@endsection