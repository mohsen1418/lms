<?php include('jdf.php') ?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <title>شناسه دانش آموزان کلاس {{\App\Room::where('id_room',$id_room)->first()->name}}</title>
    @include('layout.css')
    <style>
        p {
            line-height: 19px;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt;
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
            <p class="text-center">شناسه دانش آموزان کلاس {{\App\Room::where('id_room',$id_room)->first()->name}}</p>
            <div class="row" style="border: 1px solid #ddd;">
                @foreach($all_user as $item)
                <div class="col-md-4" style="border: 1px solid #ddd;">
                    <div style="border: 1px solid #ddd;margin: 10px;padding: 10px;">
                        <p style="margin-top:10px ;font-weight: 800;">نام : {{$item->fname}}</p>
                        <p style="font-weight: 800;">نام خانوادگی : {{$item->lname}}</p>
                        <p style="font-weight: 800;">شناسه کاربری : {{$item->mobile}}</p>
                        <p style="font-weight: 800;">کلمه عبور : {{$item->pass}}</p>
                    </div>
                    <div class="text-center" style="border: 1px solid #ddd;margin: 10px;">
                        <p style="margin-top:10px ;font-weight: 800;">{{DB::table('option')->where('name','url')->first()->value}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
    @include('layout.script')
</body>

</html>