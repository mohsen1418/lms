<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">گزارش ماهانه ساعت مطالعه</div>
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
                <form action="{{route('study_mounthly')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">نام کلاس</label>
                            <select class="js-example-basic-single" name="id_room" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_room as $item)
                                <option value="{{$item->id_room}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">نام ماه</label>
                            <select class="js-example-basic-single" name="mounth" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                <option value="تیر">تیر</option>
                                <option value="مرداد">مرداد</option>
                                <option value="شهریور">شهریور</option>
                                <option value="مهر">مهر</option>
                                <option value="آبان">آبان</option>
                                <option value="آذر">آذر</option>
                                <option value="دی">دی</option>
                                <option value="بهمن">بهمن</option>
                                <option value="اسفند">اسفند</option>
                                <option value="فروردین">فروردین</option>
                                <option value="اردیبهشت">اردیبهشت</option>
                                <option value="خرداد">خرداد</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">جستجو</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($count))
<div class="alert alert-success" role="alert">نمایش جزئیات - ماه {{$mounth}}</div>
<div class="card"> 
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">نام دانش آموز</th>
                        <th scope="col">مجموع</th>
                        @for($i=1;$i<=$count;$i++) <th scope="col">{{$i}}</th>
                            @endfor
                    </tr>
                </thead>
                <tbody>
                @foreach($all_user as $item)
                    <tr>
                        <th scope="row" style="white-space: nowrap;">{{$item->fname." ".$item->lname}}</th>
                        <th scope="col" style="background-color: blueviolet;color:#fff;border: 1px solid #fff;">
                        <?php
                                $hour1 = 0;
                                $minute1 =\App\Read::where('id_user',$item->id)->whereBetween('date', [$date1, $date2])->sum('time');
                                if ($minute1 > 60) {
                                    $hour1 = $hour1 + floor($minute1 / 60);
                                    $minute1 = $minute1 - (floor($minute1 / 60)*60);
                                }
                                if ($minute1 < 10)
                                    $minute1 = "0" . $minute1;
                                if ($hour1 < 10)
                                    $hour1 = "0" . $hour1;
                        ?>
                            {{$hour1.":".$minute1}}
                            </th>
                        @for($i=1;$i<=$count;$i++) 
                            @if($i<=9) 
                                <?php $date = $y . "/" . $m . "/0" . $i; ?> 
                            @else
                                <?php $date = $y . "/" . $m . "/" . $i; ?> 
                            @endif 
                         <?php 
                         $name=date('l',strtotime(jalali_to_gregorian(substr($date, 0, 4),substr($date, 5, 2),substr($date, 8, 2),'/'))); 
                         if($name=="Friday")$name="جمعه";
                         if($name=="Saturday")$name="شنبه";
                         if($name=="Sunday")$name="یکشنبه";
                         if($name=="Monday")$name="دوشنبه";
                         if($name=="Tuesday")$name="سه شنبه";
                         if($name=="Wednesday")$name="چهارشنبه";
                         if($name=="Thursday")$name="پنجشنبه"; 
                                ?>
                        @if(\App\Read::where('id_user',$item->id)->where('date', $date)->sum('time')>=\App\Etude::where('id_user',$item->id)->where('day', $name)->sum('clock') && \App\Read::where('id_user',$item->id)->where('date', $date)->sum('time')>0)
                        <?php
                                $hour = 0;
                                $minute =\App\Read::where('id_user',$item->id)->where('date', $date)->sum('time');
                                if ($minute > 60) {
                                    $hour = $hour + floor($minute / 60);
                                    $minute = $minute - (floor($minute / 60)*60);
                                }
                                if ($minute < 10)
                                    $minute = "0" . $minute;
                                if ($hour < 10)
                                    $hour = "0" . $hour;
                        ?>
                        <th scope="col" style="background-color: green;color:#fff;border: 1px solid #fff;">
                            {{$hour.":".$minute}}
                            </th>
                            @else
                            <th scope="col" style="background-color: red;color:#fff;border: 1px solid #fff;">
                            {{"-"}} 
                            </th>
                            @endif
                            @endfor
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection