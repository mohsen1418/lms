<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="alert alert-success" role="alert">گزارش مشاورات</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('report_consultant')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputPassword1">نام کلاس</label>
                            <select class="js-example-basic-single" name="id_room" dir="rtl" onchange="submit().form">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_room as $item)
                                <option value="{{$item->id_room}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($id_room))
<div class="alert alert-success" role="alert">اسامی کلاس {{\App\Room::where('id_room',$id_room)->first()->name}}</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">کل</th>
                        <th scope="col">دانش آموز</th>
                        <th scope="col">اولیا</th>
                        <th scope="col">هر دو</th>
                        <th scope="col">آخرین زمان</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_user as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{$item->fname}}</td>
                        <td>{{$item->lname}}</td>
                        <td>{{\App\Consultant::where('id_user',$item->id)->where('Present',"دانش آموز")->count()}}</td>
                        <td>{{\App\Consultant::where('id_user',$item->id)->where('Present',"اولیا")->count()}}</td>
                        <td>{{\App\Consultant::where('id_user',$item->id)->where('Present',"هر دو")->count()}}</td>
                        <td>{{\App\Consultant::where('id_user',$item->id)->count()}}</td>
                        @if(\App\Consultant::where('id_user',$item->id)->count()>0)
                        <td>{{\App\Consultant::where('id_user',$item->id)->first()->date}}</td>
                        @else
                        <td>-</td>
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