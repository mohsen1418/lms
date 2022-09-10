<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">گزارش به صورت فردی</div>
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
                <form action="{{route('Personal_persuasion')}}" method="POST">
                    @csrf
                    <input name="date" value="{{time()}}" type="hidden"/>
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام دانش آموز</label>
                        <select class="js-example-basic-single" name="id_user" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_user as $ky=>$item)
                            <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - کلاس "}}{{\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">جستجو</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($all_besharat))
<div class="alert alert-success" role="alert">لیست موارد اجرینه</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">نوع</th>
                        <th scope="col">امتیاز</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col">ثبت کننده</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($all_besharat as $key=>$item)
                @if(\App\Persuasion::where('id_persuasion',$item->id_persuasion)->first()->kind=="اجرینه")
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{\App\User::where('id',$item->id_user)->first()->fname}}</td>
                        <td>{{\App\User::where('id',$item->id_user)->first()->lname}}</td>
                        <td>{{\App\Persuasion::where('id_persuasion',$item->id_persuasion)->first()->title}}</td>
                        <td>{{\App\Persuasion::where('id_persuasion',$item->id_persuasion)->first()->kind}}</td>
                        <td>{{\App\Persuasion::where('id_persuasion',$item->id_persuasion)->first()->score}}</td>
                        <td>{{jdate('Y/m/d',$item->date)}}</td>
                        <td>{{$item->name}}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="alert alert-success" role="alert">لیست موارد زجرینه</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">نوع</th>
                        <th scope="col">امتیاز</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col">ثبت کننده</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($all_besharat as $key=>$item)
                @if(\App\Persuasion::where('id_persuasion',$item->id_persuasion)->first()->kind=="زجرینه")
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{\App\User::where('id',$item->id_user)->first()->fname}}</td>
                        <td>{{\App\User::where('id',$item->id_user)->first()->lname}}</td>
                        <td>{{\App\Persuasion::where('id_persuasion',$item->id_persuasion)->first()->title}}</td>
                        <td>{{\App\Persuasion::where('id_persuasion',$item->id_persuasion)->first()->kind}}</td>
                        <td>{{\App\Persuasion::where('id_persuasion',$item->id_persuasion)->first()->score}}</td>
                        <td>{{jdate('Y/m/d',$item->date)}}</td>
                        <td>{{$item->name}}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="alert alert-success" role="alert">نتایج کلی</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">امتیاز اجرینه</th>
                        <th scope="col">امتیاز زجرینه</th>
                        <th scope="col">مجموع کل</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{\App\Persuasion::join('besharat','persuasion.id_persuasion','=','besharat.id_persuasion')->where('besharat.id_user',$id_user)->where('persuasion.kind',"اجرینه")->sum('score')}}</td>
                        <td>{{\App\Persuasion::join('besharat','persuasion.id_persuasion','=','besharat.id_persuasion')->where('besharat.id_user',$id_user)->where('persuasion.kind',"زجرینه")->sum('score')}}</td>
                        <td style="direction: ltr;">{{\App\Persuasion::join('besharat','persuasion.id_Persuasion','=','besharat.id_persuasion')->where('besharat.id_user',$id_user)->where('persuasion.kind',"اجرینه")->sum('score')-\App\Persuasion::join('besharat','persuasion.id_persuasion','=','besharat.id_persuasion')->where('besharat.id_user',$id_user)->where('persuasion.kind',"زجرینه")->sum('score')}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif


@endsection