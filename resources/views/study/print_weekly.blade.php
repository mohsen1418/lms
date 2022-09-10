<?php include('jdf.php') ?>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{DB::table('option')->where('name',"name_school")->first()->value}}</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/bundle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" type="text/css">
    <link rel="shortcut icon" href="https://lms.andishesafa.ir/ps2/admin/assets/media/image/logo.png">
    <style>
        p {
            line-height: 23px;
        }

        th,
        tr {
            border: 1px solid #ccc;
        }

        @media print {
            tr.vendorListHeading {
                background-color: #1a4567 !important;
                -webkit-print-color-adjust: exact;
            }
        }

        @media print {
            .vendorListHeading th {
                color: white !important;
            }
        }
    </style>
</head>

<body style="background: #fff;padding-top: 15px;">
    <main class="main-content" style="margin-right: 0;padding-top: 0px;">
        <center><img src="{{ asset('assets/media/image/logo-print.png') }}" style="margin-bottom: 10px;" /></center>
        <div class="table-responsive" tabindex="1">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" colspan="6" style="white-space: nowrap;">گزارش هفتگی ساعت مطالعه</th>
                        <th scope="col" colspan="6" style="white-space: nowrap;">نام مدرسه : {{DB::table('option')->where('name',"name_school")->first()->value}}</th>
                        <th scope="col" colspan="6" style="white-space: nowrap;">نام دانش آموز : {{\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname}}</th>
                        <th scope="col" colspan="6" style="white-space: nowrap;">تاریخ : {{$date}}</th>
                    </tr>
                    <tr>
                        <th scope="col">روز</th>
                        @foreach($all_course as $item)
                        <th scope="col" colspan="2" style="white-space: nowrap;">{{$item->name}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
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
                        <th scope="row" style="white-space: nowrap;">{{$hour1.":".$minute1}}</th>
                        <th scope="row" style="white-space: nowrap;">{{$hour.":".$minute}}</th>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">امضا و نظر مشاور :</div>
            <div class="col-md-6">امضا و نظر اولیا :</div>
        </div>
        </div>
</body>

</html>