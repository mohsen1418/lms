<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">{{"نمایش فیلم ها"}}</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('report_film')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام درس</label>
                        <select class="js-example-basic-single" name="id_course" dir="rtl" onchange="submit().form">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_course as $item)
                            <option value="{{$item->id_course}}">{{$item->name}}{{" - (کلاس "}}{{\App\Room::where('id_room',$item->id_room)->first()->name}}{{")"}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($all_film))
<div class="alert alert-success" role="alert">گزارش درس {{DB::table('courses')->where('id_course',$course)->first()->name}} - کلاس {{DB::table('room')->where('id_room',$id_room)->first()->name}}</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام دانش آموز</th>
                        @foreach($all_film as $key=>$item)
                        <th scope="col">جلسه {{++$key}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_user as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <th scope="row">{{$item->fname." ".$item->lname}}</th>
                        @foreach($all_film as $item1)
                        @if($item1->status==1)
                        @if(DB::table('visits')->where('id_film',$item1->id_film)->where('id_user',$item->id)->count()>0)
                        <th scope="row"><i class="icon fa fa-check" style="color:green"></i></th>
                        @else
                        <th scope="row"><i class="icon fa fa-times" style="color:red"></i></th>
                        @endif
                        @else
                        <th scope="row"><i class="icon fa fa-eye-slash" style="color:blue"></i></th>
                        @endif
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endif
@endsection