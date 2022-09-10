<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">گزارش جامع تکالیف</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('person_homework')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">نام دانش آموز</label>
                            <select class="js-example-basic-single" name="id_user" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_user as $ky=>$item)
                                <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - ".\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">نوع درس</label>
                            <select class="js-example-basic-single" name="kind" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                <option value="آموزشی">آموزشی</option>
                                <option value="مهارتی">مهارتی</option>
                                <option value="همه دروس">همه دروس</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">نمایش کارنامه</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($id_user))
<div class="alert alert-success" role="alert">کارنامه تکالیف {{\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname}}</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام درس</th>
                        <th scope="col">تعداد کل</th>
                        <th scope="col">کامل</th>
                        <th scope="col">ناقص</th>
                        <th scope="col">عدم انجام</th>
                        <th scope="col">غایب</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_course as $key=>$item)
                    <tr>
                        <th>{{++$key}}</th>
                        <th>{{$item->name}}</th>
                        <th>{{\App\Homework::where('id_course',$item->id_course)->count()}}</th>
                        <th>{{\App\Trouble::join('homework','homework.id_homework','trouble.id_homework')->where('homework.id_course',$item->id_course)->where('trouble.score','کامل')->where('trouble.id_user',$item->id)->count()}}</th>
                        <th>{{\App\Trouble::join('homework','homework.id_homework','trouble.id_homework')->where('homework.id_course',$item->id_course)->where('trouble.score','ناقص')->where('trouble.id_user',$item->id)->count()}}</th>
                        <th>{{\App\Trouble::join('homework','homework.id_homework','trouble.id_homework')->where('homework.id_course',$item->id_course)->where('trouble.score','عدم انجام')->where('trouble.id_user',$item->id)->count()}}</th>
                        <th>{{\App\Trouble::join('homework','homework.id_homework','trouble.id_homework')->where('homework.id_course',$item->id_course)->where('trouble.score','غایب')->where('trouble.id_user',$item->id)->count()}}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection