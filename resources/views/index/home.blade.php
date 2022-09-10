<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="alert alert-success" role="alert">{{"آقای ".Auth::user()->fname." ".Auth::user()->lname." عزیز خوش آمدید"}}</div>
<!--
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                            <i class="fa fa-user-o"></i>
                        </div>
                        <h3 class="font-weight-800 primary-font"></h3>
                        <p>تاریخ امروز</p>
                        <p>{{jdate('l')." - ".jdate('Y/m/d')}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                            <i class="fa fa-user-o"></i>
                        </div>
                        <h3 class="font-weight-800 primary-font"></h3>
                        <p>تعداد دانش آموزان</p>
                        <p>{{\App\User::where('role',4)->count()}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                            <i class="fa fa-user-o"></i>
                        </div>
                        <h3 class="font-weight-800 primary-font"></h3>
                        <p>تعداد دبیران</p>
                        <p>{{\App\User::where('role',3)->count()}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                            <i class="fa fa-user-o"></i>
                        </div>
                        <h3 class="font-weight-800 primary-font"></h3>
                        <p>تعداد کادر</p>
                        <p>{{\App\User::where('role',2)->count()}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                            <i class="ti-blackboard"></i>
                        </div>
                        <h3 class="font-weight-800 primary-font"></h3>
                        <p>تعداد فیلم ها</p>
                        <p>{{\App\Film::count()}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                            <i class="fa fa-signal"></i>
                        </div>
                        <h3 class="font-weight-800 primary-font"></h3>
                        <p>آمار بازدید</p>
                        <p>{{\App\Statistic::count()}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert" style="background:#1b7866 !important;color:#fff;text-align: center;">{{"اطلاعات اجمالی کلاس ها"}}</div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" tabindex="1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام کلاس</th>
                                <th scope="col">نام پایه</th>
                                <th scope="col">تعداد دانش آموز</th>
                                <th scope="col">تعداد درس آموزشی</th>
                                <th scope="col">تعداد درس مهارتی</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_room as $key=>$item)
                            <tr>
                                <th scope="row">{{++$key}}</th>
                                <th>{{$item->name}}</th>
                                <th scope="row">{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</th>
                                <th scope="row">{{\App\User::where('id_room',$item->id_room)->where('role',4)->count()}}</th>
                                <th scope="row">{{\App\Course::where('id_room',$item->id_room)->where('kind',"آموزشی")->count()}}</th>
                                <th scope="row">{{\App\Course::where('id_room',$item->id_room)->where('kind',"مهارتی")->count()}}</th>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
!-->
@endsection