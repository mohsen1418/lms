<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert" >گزارش به صورت کلاسی</div>
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
                <form action="{{route('class_persuasion')}}" method="POST">
                    @csrf
                    <input name="date" value="{{time()}}" type="hidden"/>
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام کلاس</label>
                        <select class="js-example-basic-single" name="id_room" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_room as $ky=>$item)
                            <option value="{{$item->id_room}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">جستجو</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($all_user))
<div class="alert alert-success" role="alert">اسامی دانش آموزان</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">نام پایه</th>
                        <th scope="col">نام کلاس</th>
                        <th scope="col">امتیاز اجرینه</th>
                        <th scope="col">امتیاز زجرینه</th>
                        <th scope="col">مجموع</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($all_user as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{$item->fname}}</td>
                        <td>{{$item->lname}}</td>
                        <td>{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</td>
                        <td>{{\App\Room::where('id_room',$item->id_room)->first()->name}}</td>
                        <td>{{\App\Persuasion::join('besharat','persuasion.id_persuasion','=','besharat.id_persuasion')->where('besharat.id_user',$item->id)->where('persuasion.kind',"اجرینه")->sum('score')}}</td>
                        <td>{{\App\Persuasion::join('besharat','persuasion.id_persuasion','=','besharat.id_persuasion')->where('besharat.id_user',$item->id)->where('persuasion.kind',"زجرینه")->sum('score')}}</td>
                        <td style="direction: ltr;">{{\App\User::where('id',$item->id)->first()->score}}</td>                    
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endif


@endsection