<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">گزارش روزانه ساعت مطالعه</div>
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
                <form action="{{route('study_daily')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">نام کلاس</label>
                            <select class="js-example-basic-single" name="id_room" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_room as $item)
                                <option value="{{$item->id_room}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">تاریخ</label>
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
@if(isset($id_room))
<div class="row">
    <div class="col-md-3">
        <div class="alert alert-success" style="background-color: green !important;" role="alert">مطابق زمان الگو و بیشتر</div>
    </div>
    <div class="col-md-3">
        <div class="alert alert-success" style="background-color: red !important;" role="alert">کمتر از میزان الگو</div>
    </div>
    <div class="col-md-3">
        <div class="alert alert-success" style="background-color: #a14896 !important;" role="alert">مطالعه آزاد خارج از الگو</div>
    </div>
    <div class="col-md-3">
        <div class="alert alert-success" style="background-color: #646464 !important;" role="alert"><i class="icon  fa fa-times"></i> عدم مطالعه در این روز</div>
    </div>
</div>
<div class="alert alert-success" role="alert">نمایش جزئیات - {{$date}}</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="white-space: nowrap;">نام دانش آموز</th>
                        <th scope="col">مجموع</th>
                        @foreach($all_course as $item)
                        <th scope="col" colspan="2" style="white-space: nowrap;">{{$item->name}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" style="white-space: nowrap;"></th>
                        <th scope="row" style="white-space: nowrap;"></th>
                        @foreach($all_course as $item)
                        <th scope="row" style="white-space: nowrap;">الگو</th>
                        <th scope="row" style="white-space: nowrap;">مطالعه</th>
                        @endforeach
                    </tr>
                    @foreach($all_user as $key=>$item)
                    <tr>
                        <th scope="row" style="white-space: nowrap;">{{$item->fname." ".$item->lname}}</th>
                        <?php
                        $name = date('l', strtotime(jalali_to_gregorian(substr($date, 0, 4), substr($date, 5, 2), substr($date, 8, 2), '/')));
                        if ($name == "Friday") $name = "جمعه";
                        if ($name == "Saturday") $name = "شنبه";
                        if ($name == "Sunday") $name = "یکشنبه";
                        if ($name == "Monday") $name = "دوشنبه";
                        if ($name == "Tuesday") $name = "سه شنبه";
                        if ($name == "Wednesday") $name = "چهارشنبه";
                        if ($name == "Thursday") $name = "پنجشنبه";
                        $hour2 = 0;
                        $minute2 = \App\Read::join('courses', 'read.id_course', 'courses.id_course')->where('read.id_user', $item->id)->where('read.date', $date)->where('courses.kind', $kind)->sum('time');
                        if ($minute2 > 60) {
                            $hour2 = $hour2 + floor($minute2 / 60);
                            $minute2 = $minute2 - (floor($minute2 / 60) * 60);
                        }
                        if ($minute2 < 10)
                            $minute2 = "0" . $minute2;
                        if ($hour2 < 10)
                            $hour2 = "0" . $hour2;
                        $hour3 = 0;
                        $minute3 = \App\Etude::join('courses', 'courses.id_course', 'etude.id_course')->where('etude.id_user', $item->id)->where('etude.day', $name)->where('courses.kind', $kind)->sum('etude.clock');
                        if ($minute3 > 60) {
                            $hour3 = $hour3 + floor($minute3 / 60);
                            $minute3 = $minute3 - (floor($minute3 / 60) * 60);
                        }
                        if ($minute3 < 10)
                            $minute3 = "0" . $minute3;
                        if ($hour3 < 10)
                            $hour3 = "0" . $hour3;
                        ?>
                        @if(\App\Read::join('courses','read.id_course','courses.id_course')->where('read.id_user', $item->id)->where('read.date', $date)->where('courses.kind', $kind)->sum('time')>=\App\Etude::join('courses','courses.id_course','etude.id_course')->where('etude.id_user', $item->id)->where('etude.day', $name)->where('courses.kind', $kind)->sum('etude.clock'))
                        <th scope="row" style="white-space: nowrap;background-color: green;color: #fff;border: 1px solid #fff;" data-toggle="tooltip" data-placement="top" data-original-title="{{$hour3.":".$minute3}}">{{$hour2.":".$minute2}}</th>
                        @else
                        <th scope="row" style="white-space: nowrap;background-color: red;color: #fff;border: 1px solid #fff;" data-toggle="tooltip" data-placement="top" data-original-title="{{$hour3.":".$minute3}}">{{$hour2.":".$minute2}}</th>
                        @endif
                        @foreach($all_course as $item1)
                        @if(\App\Read::where('id_course', $item1->id_course)->where('date', $date)->where('id_user', $item->id)->count()>0)
                        <?php
                        $hour = 0;
                        $minute = \App\Read::where('id_course', $item1->id_course)->where('date', $date)->first()->time;
                        if ($minute > 60) {
                            $hour = $hour + floor($minute / 60);
                            $minute = $minute - (floor($minute / 60) * 60);
                        }
                        if ($minute < 10)
                            $minute = "0" . $minute;
                        if ($hour < 10)
                            $hour = "0" . $hour;
                        if (\App\Etude::where('id_course', $item1->id_course)->where('day', $name)->count() > 0) {
                            $hour1 = 0;
                            $minute1 = \App\Etude::where('id_course', $item1->id_course)->where('day', $name)->first()->clock;
                            if ($minute1 > 60) {
                                $hour1 = $hour1 + floor($minute1 / 60);
                                $minute1 = $minute1 - (floor($minute1 / 60) * 60);
                            }
                            if ($minute1 < 10)
                                $minute1 = "0" . $minute1;
                            if ($hour1 < 10)
                                $hour1 = "0" . $hour1;
                        }
                        ?>
                        @if(\App\Etude::where('id_course', $item1->id_course)->where('day', $name)->count()>0)
                        @if(\App\Read::where('id_course', $item1->id_course)->where('date', $date)->first()->time>=\App\Etude::where('id_course', $item1->id_course)->where('day', $name)->first()->clock)
                        <th scope="row" style="white-space: nowrap;background-color: green;color: #fff;border: 1px solid #fff;" ><i class="icon  fa fa-check"></i> {{$hour1.":".$minute1}}</th>
                        <th scope="row" style="white-space: nowrap;background-color: green;color: #fff;border: 1px solid #fff;" ><i class="icon  fa fa-check"></i> {{$hour.":".$minute}}</th>

                        @else
                        <th scope="row" style="white-space: nowrap;background-color: red;color: #fff;border: 1px solid #fff;" ><i class="icon  fa fa-check"></i> {{$hour1.":".$minute1}}</th>
                        <th scope="row" style="white-space: nowrap;background-color: red;color: #fff;border: 1px solid #fff;" ><i class="icon  fa fa-check"></i> {{$hour.":".$minute}}</th>
                        @endif
                        @else
                        <th scope="row" style="white-space: nowrap;background-color: #a14896;color: #fff;border: 1px solid #fff;">{{"00:00"}}</th>
                        <th scope="row" style="white-space: nowrap;background-color: #a14896;color: #fff;border: 1px solid #fff;">{{$hour.":".$minute}}</th>

                        @endif
                        @else
                        <th scope="row" style="white-space: nowrap;"><i class="icon  fa fa-times"></i></th>
                        <th scope="row" style="white-space: nowrap;"><i class="icon  fa fa-times"></i></th>
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