<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">گزارش هفتگی ساعت مطالعه</div>
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
                <form action="{{route('study_weekly')}}" method="POST">
                    @csrf
                    <div class="row">
                    <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">نام دانش آموز</label>
                            <select class="js-example-basic-single" name="id_user" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_user as $item)
                                <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - "}}{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">شنبه به عنوان ابتدای هفته انتخاب شود</label>
                            <input type="text" name="date" class="form-control text-right" dir="ltr">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">نوع دروس</label>
                            <select class="js-example-basic-single" name="kind" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                <option value="آموزشی">آموزشی</option>
                                <option value="مهارتی">مهارتی</option>
                                <option value="هر دو">هر دو</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">جستجو</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($id_user))
<div class="row">
    <div class="col-md-3"><div class="alert alert-success" style="background-color: green !important;" role="alert">مطابق زمان الگو و بیشتر</div></div>
    <div class="col-md-3"><div class="alert alert-success" style="background-color: red !important;" role="alert">کمتر از میزان الگو</div></div>
    <div class="col-md-3"><div class="alert alert-success" style="background-color: #a14896 !important;" role="alert">مطالعه آزاد خارج از الگو</div></div>
    <div class="col-md-3"><div class="alert alert-success" style="background-color: #646464 !important;" role="alert"><i class="icon  fa fa-times"></i>  عدم مطالعه در این روز</div></div>
</div>
<div class="alert alert-success" role="alert">{{\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname}}</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
            <table class="table table-striped">
                <?php
                ?>
                <thead>
                    <tr>
                        <th scope="col">روز</th>
                        @foreach($all_course as $item)
                        <th scope="col" colspan="2" style="white-space: nowrap;">{{$item->name}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                <th scope="row" style="white-space: nowrap;"></th>
                            @foreach($all_course as $item)
                                <th scope="row" style="white-space: nowrap;">الگو</th>
                                <th scope="row" style="white-space: nowrap;">مطالعه</th>
                                @endforeach
                                </tr>
                    @foreach($rooz as $key=>$day)
                    <tr>
                        <th scope="row">{{$day}}</th>
                        <?php
                        $timezone = 0;
                        $year = substr($date, 0, 4);
                        $month = substr($date, 5, 2);
                        $day = substr($date, 8, 2);
                        $hour = 0;
                        $minute = 0;
                        $second = 0;
                        $none = "";
                        $a = jmktime($hour, $minute, $second, $month, $day, $year, $none, $timezone);
                        $time = "00:00:00";
                        $threeDaysAgo = $a + ($key * 24 * 60 * 60);
                        list($year, $month, $day) = explode("-", date("Y-m-d", $threeDaysAgo));
                        list($hour, $minute, $second) = explode(':', $time);
                        $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
                        $jalali_date = jdate("Y/m/d", $timestamp);
                        ?>
                        @foreach($all_course as $item)
                        <?php
                        $name = date('l', strtotime(jalali_to_gregorian(substr($jalali_date, 0, 8), substr($jalali_date, 9, 4), substr($jalali_date, 14, 4), '/')));
                        if ($name == "Friday") $name = "جمعه";
                        if ($name == "Saturday") $name = "شنبه";
                        if ($name == "Sunday") $name = "یکشنبه";
                        if ($name == "Monday") $name = "دوشنبه";
                        if ($name == "Tuesday") $name = "سه شنبه";
                        if ($name == "Wednesday") $name = "چهارشنبه";
                        if ($name == "Thursday") $name = "پنجشنبه";
                        $hour = 0;
                        $minute = \App\Read::where('id_user', $id_user)->where('id_course', $item->id_course)->where('date', $jalali_date)->sum('time');
                        if ($minute > 60) {
                            $hour = $hour + floor($minute / 60);
                            $minute = $minute - (floor($minute / 60) * 60);
                        }
                        if ($minute < 10)
                            $minute = "0" . $minute;
                        if ($hour < 10)
                            $hour = "0" . $hour;
                        $hour1 = 0;
                        $minute1 = \App\Etude::where('id_user', $id_user)->where('id_course', $item->id_course)->where('day', $name)->sum('clock');
                        if ($minute1 > 60) {
                            $hour1 = $hour1 + floor($minute1 / 60);
                            $minute1 = $minute1 - (floor($minute1 / 60) * 60);
                        }
                        if ($minute1 < 10)
                            $minute1 = "0" . $minute1;
                        if ($hour1 < 10)
                            $hour1 = "0" . $hour1;
                        ?>
                        @if(\App\Etude::where('id_user', $id_user)->where('id_course', $item->id_course)->where('day', $name)->count()>0)
                        @if(\App\Read::where('id_user', $id_user)->where('id_course', $item->id_course)->where('date', $jalali_date)->count()>=\App\Etude::where('id_user', $id_user)->where('id_course', $item->id_course)->where('day', $name)->count())
                        <th scope="row" style="white-space: nowrap;background-color:green;color:#fff;border:1px solid #fff">{{$hour1.":".$minute1}}</th>
                        <th scope="row" style="white-space: nowrap;background-color:green;color:#fff;border:1px solid #fff">{{$hour.":".$minute}}</th>
                        @else
                        <th scope="row" style="white-space: nowrap;background-color:#12a6ba;color:#fff;border:1px solid #fff">{{$hour1.":".$minute1}}</th>
                        <th scope="row" style="white-space: nowrap;background-color:red;color:#fff;border:1px solid #fff"><i class="icon  fa fa-times"></i></th>
                        @endif
                        @else
                        @if(\App\Read::where('id_user', $id_user)->where('id_course', $item->id_course)->where('date', $jalali_date)->count()>0)
                        <th scope="row" style="white-space: nowrap;background-color:#8c408f;color:#fff;border:1px solid #fff">{{$hour1.":".$minute1}}</th>
                        <th scope="row" style="white-space: nowrap;background-color:#8c408f;color:#fff;border:1px solid #fff">{{$hour.":".$minute}}</th>
                        @else
                        <th scope="row" style="white-space: nowrap;border:1px solid #fff"><i class="icon  fa fa-times"></i></th>
                        <th scope="row" style="white-space: nowrap;border:1px solid #fff"><i class="icon  fa fa-times"></i></th>
                        @endif
                        @endif
                        @endforeach
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{route('study_print_weekly',['id_user'=> $id_user,'date'=> $jalali_date,'kind'=> $kind])}}"> <button style="background: #3553ae;border-color: #3553ae;margin-top: 15px;" type="submit" class="btn btn-primary">چاپ برگه</button></a>
    </div>
</div>
@endif
@endsection