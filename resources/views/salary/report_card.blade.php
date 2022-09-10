<?php include('jdf.php') ?>
<!DOCTYPE html>
<html lang="fa">

<head>
    @include('layout.css')
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
        <div class="container-fluid">
            <div class="card" style="background: #fff;">
                <div class="card-body">
                    <p style="text-align:center;">کارنامه مالی - {{DB::table('option')->where('name',"title")->first()->value}}</p>
                    <p style="text-align:center;background: #ccc;padding: 8px;border-radius: 10px;">نام و نام خانوادگی دانش آموز : {{\App\User::where('id',$user)->first()->fname." ".\App\User::where('id',$user)->first()->lname}}</p>
                    <div class="table-responsive" tabindex="1">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ردیف</th>
                                    <th scope="col">نوع پرداخت</th>
                                    <th scope="col">بانک</th>
                                    <th scope="col">شماره فیش / چک</th>
                                    <th scope="col">مبلغ</th>
                                    <th scope="col">پرداختی</th>
                                    <th scope="col">تاریخ سررسید</th>
                                    <th scope="col">تاریخ پرداخت</th>
                                    <th scope="col">وضعیت</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agreement as $key=>$item)
                                @if($user==$item->id_user)
                                <tr>
                                    <th>{{$item->section}}</th>
                                    <th>{{$item->kind}}</th>
                                    <th>{{$item->bank}}</th>
                                    <th>{{$item->check}}</th>
                                    <th>{{number_format($item->price)}}</th>
                                    <th>{{number_format($item->pay)}}</th>
                                    <th>{{$item->date}}</th>
                                    <th>{{$item->payment}}</th>
                                    @if($item->price!=$item->pay) 
                                    <th>پرداخت نشده</th>
                                    @elseif($item->date>=$item->payment)
                                    <th>پرداخت شده</th>
                                    @else
                                    <th>دیرکرد</th>
                                    @endif
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive" tabindex="1">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">شهریه</th>
                                    <th scope="col">تخفیف</th>
                                    <th scope="col">پرداخت شده</th>
                                    <th scope="col">پرداخت نشده</th>
                                    <th scope="col">کمک مردمی</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{number_format(\App\Agreement::where('id_user',$user)->sum('price'))}}</th>
                                    <th>{{number_format(\App\Exception::where('id_user',$user)->sum('amount')+\App\Exception::where('id_user',$user)->sum('normal'))}}</th>
                                    <th>{{number_format(\App\Agreement::where('id_user',$user)->sum('pay'))}}</th>
                                    <th>{{number_format(\App\Agreement::where('id_user',$user)->sum('price')-\App\Agreement::where('id_user',$user)->sum('pay'))}}</th>
                                    <th>{{number_format(\App\Exception::where('id_user',$user)->first()->gift)}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layout.script')
</body>

</html>