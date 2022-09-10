<?php include('jdf.php') ?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <title>{{\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname}}</title>
    @include('layout.css')
    <style>
        p {
            line-height: 19px;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Calibri";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
    </style>
</head>

<body style="background: #fff;    padding-top: 15px;">
    <main class="main-content" style="margin-right: 0;padding-top: 0px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <p style="background:#fff !important;color:#000;text-align:center">بسمه تعالی</p>
                    <p style="background:#fff !important;color:#000;text-align:center">قرارداد شهریه واحد آموزش دبستان اندیشه صفا</p>
                    <p style="background:#fff !important;color:#000;text-align:center">سال تحصیلی 1401 - 1402</p>
                </div>
                <div class="col-md-3">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/QR_code_for_mobile_English_Wikipedia.svg/1200px-QR_code_for_mobile_English_Wikipedia.svg.png" style="float: left;width: 90px !important;" class="d-block w-100">
                </div>
            </div>
            <p style="background:#fff !important;color:#000;text-align:right">ماده ۱ - به طرفین قرارداد</p>
            <p style="background:#fff !important;color:#000;text-align:right">قرارداد زیر در تاریخ {{jdate('Y/m/d')}} بین نماینده آقای رضوانیان مدیر واحد آموزشی اندیشه صفا و آقای/خانم {{\App\User::where('id',$id_user)->first()->lname}} ولی دانش آموز {{\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname." ".\App\Paye::join('users','paye.id_paye','users.id_paye')->where('users.id',$id_user)->first()->name." تلفن منزل  ".\App\User::where('id',$id_user)->first()->home." تلفن همراه  ".\App\User::where('id',$id_user)->first()->f_number}} </p>
            <p style="background:#fff !important;color:#000;text-align:right">ماده ۲ - موضوع قرارداد</p>
            <p style="background:#fff !important;color:#000;text-align:right"> انجام برنامه های مصوب آموزش وپرورش برای 30 ساعت درسی برنامه هفتگی مدرسه (شامل 24 ساعت برنامه مصوب شورای عالی آموزش و پرورش 6 ساعت فوق برنامه) می باشد .</p>
            <p style="background:#fff !important;color:#000;text-align:right"> ماده ۳ - مبلغ قرارداد</p>
            <p style="background:#fff !important;color:#000;text-align:right">الف - مبلغ قرارداد شهریه {{number_format($fee)}} ریال می باشد .</p>
            <p style="background:#fff !important;color:#000;text-align:right">ب - مبلغ قرارداد شهریه مکمل آموزشی {{number_format($complete)}} ریال می باشد .</p>
            <p style="background:#fff !important;color:#000;text-align:right">ج - مبلغ تخفیف شهریه {{number_format($normal+$amount)}} ریال می باشد .</p>
            <p style="background:#fff !important;color:#000;text-align:right">د - مبلغ قابل پرداخت {{number_format($fee+$complete)}} ریال می باشد .</p>
            <p style="background:#fff !important;color:#000;text-align:right"> ماده ۴ - تعهدات طرفین</p>
            <p style="background:#fff !important;color:#000;text-align:right">الف - ولی دانش آموز متعهد به پرداخت شهریه مطابق با ماده ۶ این قرارداد در وجه واحد آموزشی دبستان اندیشه صفا دوره تحصیلی دبستان پسرانه به شماره حساب بانک ملی شعبه عظیم پور کد ۱۵۲ می باشد .</p>
            <p style="background:#fff !important;color:#000;text-align:right">ب - موسس و مدیر واحد آموزشی متعهد به ارائه برنامه درسی مطابق قرارداد و رعایت الگوی شهریه می باشند .</p>
            <p style="background:#fff !important;color:#000;text-align:right">ماده ۵- انصراف از ثبت نام چنان چه دانش آموز پس از ثبت نام قطعی تا تاریخ 1401/07/01 به صورت کتبی توسط ولی محترم دانش آموز انصراف دهد معادل 5% (پنج درصد) شهریه و چنان چه قبل از امتحانات کتبی نوبت اول انصراف دهد 50% (پنجاه درصد) شهریه و پس از امتحانات نوبت اول 100% (صد در صد) شهريه را باید پرداخت نماید.</p>
            <p style="background:#fff !important;color:#000;text-align:right">ماده ۶- نحوه پرداخت شهریه</p>
            <div class="card" style="background: #fff;">
                <div class="card-body">
                    <div class="table-responsive" tabindex="1">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ردیف</th>
                                    <th scope="col">نوع پرداخت</th>
                                    <th scope="col">تاریخ سررسید</th>
                                    <th scope="col">بانک</th>
                                    <th scope="col">شماره فیش / چک</th>
                                    <th scope="col">مبلغ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agreement as $key=>$item)
                                <tr>
                                    <th scope="row">{{$item->section}}</th>
                                    <th>{{$item->kind}}</th>
                                    <th>{{$item->date}}</th>
                                    <th>{{$item->bank}}</th>
                                    <th>{{$item->check}}</th>
                                    <th>{{number_format($item->price)}}</th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <p style="background:#fff !important;color:#000;text-align:right"> مجموع : {{number_format($sum)}} ریال می باشد .</p>
            <p style="background:#fff !important;color:#000;text-align:right">ماده ۷ - سایر هزینه ها </p>
            <p style="background:#fff !important;color:#000;text-align:right">دریافت هزینه های سایر فعالیت های فوق برنامه غیر درسی و هزینه های جالبی (ایاب وذهاب، تغذیه میان روزی ، ناهار و لباس فرم) پس از تائید انجمن اولیا و مربیان مدرسه و تایید اداره آموزش و پرورش منطقه ، اواخر شهریورماه و با دریافت قراردادهای مجزا و در صورت تمایل هریک از اولیا به صورت کاملا اختیاری امکان پذیر است.</p>
            <p style="background:#fff !important;color:#000;text-align:right"> ماده ۸ - نسخ قرارداد</p>
            <p style="background:#fff !important;color:#000;text-align:right"> این قرارداد در ۸ ماده و دو نسخه واحد تنظیم می شود که یک نسخه آن در اختیار ولی دانش آموز قرار گرفته و نسخه دیگر در واحد آموزشی می ماند</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="background: #fff;">
                        <div class="card-body">
                            <p>نام و نام خانوادگی ولی دانش آموز : </p>
                            <center><img src="{{ asset('assets/media/image/Signature/'.$photo)}}" style="width: 250px !important;" class="d-block w-100"></center>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card" style="background: #fff;">
                        <div class="card-body">
                            <p>نام و نام خانوادگی نماینده مدیر : مصطفی هوشمندنیا</p>
                            <p>امضاء و تاریخ و مهر :</p>
                            <center><img src="{{ asset('assets/media/image/pdf.png')}}" style="width: 250px !important;" class="d-block w-100"></center>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
            <p style="background:#fff !important;color:#000;text-align:center">قرارداد ثبت نام خدمات ویژه دبستان اندیشه صفا</p>
            <p style="background:#fff !important;color:#000;text-align:center">موضوع قراداد : شهریه خدمات ویژه</p>
            <p style="background:#fff !important;color:#000;text-align:center">قرارداد زیر در تاریخ {{jdate('Y/m/d')}} بین نماینده آقای رضوانیان مدیر واحد آموزشی اندیشه صفا و آقای/خانم {{\App\User::where('id',$id_user)->first()->lname}} ولی دانش آموز {{\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname." ".\App\Paye::join('users','paye.id_paye','users.id_paye')->where('users.id',$id_user)->first()->name}} منعقد می گردد . </p>
            <p style="background:#fff !important;color:#000;text-align:center">شهریه مصوب فعلی برای خدمات ویژه در طول سال تحصیلی مبلغ {{number_format($service)}} ریال می باشد که به شرح جدول زیر به حساب مدرسه واریز می شود .</p>
            <div class="card" style="background: #fff;">
                <div class="card-body">
                    <div class="table-responsive" tabindex="1">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>کتب کمک آموزشی</th>
                                    <th>هدایا</th>
                                    <th>عکس فردی و کلاسی</th>
                                </tr>
                                <tr>
                                    <th>کاوش</th>
                                    <th>کاوشگر بهاری</th>
                                    <th>بیمه دانش آموزی</th>
                                </tr>
                                <tr>
                                    <th>کار تولید</th>
                                    <th>جشن پایان سال</th>
                                    <th>بهترین روز هفته</th>
                                </tr>
                                <tr>
                                    <th>هنر و خوشنویسی</th>
                                    <th>سامانه مدبر و منتا</th>
                                    <th>آزمون</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="background: #fff;">
                        <div class="card-body">
                            <p>نام و نام خانوادگی ولی دانش آموز : </p>
                            <center><img src="{{ asset('assets/media/image/Signature/'.$photo)}}" style="width: 250px !important;" class="d-block w-100"></center>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card" style="background: #fff;">
                        <div class="card-body">
                            <p>نام و نام خانوادگی نماینده مدیر : مصطفی هوشمندنیا</p>
                            <p>امضاء و تاریخ و مهر :</p>
                            <center><img src="{{ asset('assets/media/image/pdf.png')}}" style="width: 250px !important;" class="d-block w-100"></center>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> <br><br><br><br><br><br> <br><br>
            <p style="background:#fff !important;color:#000;text-align:center">قرارداد ثبت نام پایگاه تابستانی دبستان اندیشه صفا</p>
            <p style="background:#fff !important;color:#000;text-align:center">موضوع قراداد : پایگاه تابستانی</p>
            <p style="background:#fff !important;color:#000;text-align:right">قرارداد زیر در تاریخ {{jdate('Y/m/d')}} بین نماینده آقای رضوانیان مدیر واحد آموزشی اندیشه صفا و آقای/خانم {{\App\User::where('id',$id_user)->first()->lname}} ولی دانش آموز {{\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname." ".\App\Paye::join('users','paye.id_paye','users.id_paye')->where('users.id',$id_user)->first()->name}} منعقد می گردد . </p>
            <p style="background:#fff !important;color:#000;text-align:center">شهریه مصوب فعلی برای پایگاه تابستانی در طول تابستان مبلغ {{number_format($summer)}} ریال می باشد که به شرح جدول زیر به حساب مدرسه واریز می شود .</p>
            <div class="card" style="background: #fff;">
                <div class="card-body">
                    <div class="table-responsive" tabindex="1">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>اعتقادی و اخلاقی</th>
                                </tr>
                                <tr>
                                    <th>مهارتی و هنری</th>
                                </tr>
                                <tr>
                                    <th>خلاقیتی</th>
                                </tr>
                                <tr>
                                    <th>پژوهشی</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="background: #fff;">
                        <div class="card-body">
                            <p>نام و نام خانوادگی ولی دانش آموز : </p>
                            <center><img src="{{ asset('assets/media/image/Signature/'.$photo)}}" style="width: 250px !important;" class="d-block w-100"></center>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card" style="background: #fff;">
                        <div class="card-body">
                            <p>نام و نام خانوادگی نماینده مدیر : مصطفی هوشمندنیا</p>
                            <p>امضاء و تاریخ و مهر :</p>
                            <center><img src="{{ asset('assets/media/image/pdf.png')}}" style="width: 250px !important;" class="d-block w-100"></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layout.script')
</body>

</html>