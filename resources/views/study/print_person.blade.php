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
        <p style="text-align: center;">{{DB::table('option')->where('name',"name_school")->first()->value}}</p>
        <p style="text-align: center;font-weight: 900;">فرم الگوی مطالعاتی هفتگی - {{"آقای ".\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname}}</p>
        <div class="table-responsive" tabindex="1">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">روز</th>
                        <th scope="col">الگوی ساعتی مطالعه</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooz as $key=>$item)
                    <tr>
                        <th scope="row">{{$item}}</th>
                        <th scope="row">
                            @foreach ($etude as $item1)
                            @if($item1->day==$item)
                            <button type="button" class="btn btn-primary btn-rounded" style="background: #fff;border-color: #000;color:#000;margin-top: 4px;">{{\App\Course::where('id_course',$item1->id_course)->first()->name." : ".$item1->clock." دقیقه"}} </button>
                            @endif
                            @endforeach
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">توضیحات مشاور :</div>
        </div>
        </div>
</body>

</html>