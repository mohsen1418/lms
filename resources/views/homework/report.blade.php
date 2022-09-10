<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert" >گزارش جامع تکالیف</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('report_homework')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام درس</label>
                        <select class="js-example-basic-single" name="id_course" dir="rtl" onchange="submit().form">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_course as $ky=>$item)
                            <option value="{{$item->id_course}}">{{$item->name." - ".\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($id_course))
<div class="alert alert-success" role="alert">تکالیف درس {{\App\Course::where('id_course',$id_course)->first()->name." - کلاس ".\App\Room::where('id_room',\App\course::where('id_course',$id_course)->first()->id_room)->first()->name}}</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">تعداد کل</th>
                        <th scope="col">کامل</th>
                        <th scope="col">ناقص</th>
                        <th scope="col">عدم انجام</th>
                        <th scope="col">غایب</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_user as $key=>$item)
                    <tr>
                        <th>{{++$key}}</th>
                        <th>{{$item->fname}}</th>
                        <th>{{$item->lname}}</th>
                        <th>{{\App\Homework::where('id_course',$id_course)->count()}}</th>
                        <th>{{\App\Trouble::join('homework','homework.id_homework','trouble.id_homework')->where('homework.id_course',$id_course)->where('trouble.score','کامل')->where('trouble.id_user',$item->id)->count()}}</th>
                        <th>{{\App\Trouble::join('homework','homework.id_homework','trouble.id_homework')->where('homework.id_course',$id_course)->where('trouble.score','ناقص')->where('trouble.id_user',$item->id)->count()}}</th>
                        <th>{{\App\Trouble::join('homework','homework.id_homework','trouble.id_homework')->where('homework.id_course',$id_course)->where('trouble.score','عدم انجام')->where('trouble.id_user',$item->id)->count()}}</th>
                        <th>{{\App\Trouble::join('homework','homework.id_homework','trouble.id_homework')->where('homework.id_course',$id_course)->where('trouble.score','غایب')->where('trouble.id_user',$item->id)->count()}}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection