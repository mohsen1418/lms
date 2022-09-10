<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">{{"گزارش موارد انضباطی"}}</div>
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
                <form action="{{route('show_discipline')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">نام دانش آموز</label>
                            <select class="js-example-basic-single" name="id_user" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_user as $ky=>$item)
                                @if(\App\Room::where('id_room',$item->id_room)->count()>0)
                                <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - کلاس "}}{{\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - کلاس "}}{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                                @endif @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">تاریخ شروع</label>
                            <input type="text" name="date1" class="form-control text-right" dir="ltr">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">تاریخ پایان</label>
                            <input type="text" name="date2" class="form-control text-right" dir="ltr">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">مشاهده گزارش</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($all_enzebati))
<div class="alert alert-success" role="alert">کارنامه انضباطی {{\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname}} - از تاریخ {{$date1." الی ".$date2}}</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col">نمره</th>
                        <th scope="col">تاثیر</th>
                        <th scope="col">توضیحات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_enzebati as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{\App\Discipline::where('id_discipline',$item->id_discipline)->first()->name}}</td>
                        <td>{{$item->date}}</td>
                        <td>{{\App\Discipline::where('id_discipline',$item->id_discipline)->first()->score}}</td>
                        <td>{{$item->kind}}</td>
                        <td>{{$item->detail}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">نمره انضباط</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{20-$score}}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection