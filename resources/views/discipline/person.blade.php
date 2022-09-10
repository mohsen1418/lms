<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">{{"گزارش موارد انضباطی"}}</div>
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
                <form action="{{route('add_discipline_person')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputPassword1">نام دانش آموز</label>
                            <select class="js-example-basic-single" name="id_user" dir="rtl" onchange="submit().form">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_user as $ky=>$item)
                                @if(\App\Room::where('id_room',$item->id_room)->count()>0)
                                <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - کلاس "}}{{\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - کلاس "}}{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                                @endif @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($id_user))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">{{\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname}}</div>
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
                <form action="{{route('insert_discipline')}}" method="POST">
                    @csrf
                    <input name="id_user" value="{{$id_user}}" type="hidden"/>
                    <input name="sort" value="1" type="hidden"/>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">مورد انضباطی</label>
                            <select class="js-example-basic-single" name="id_discipline" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_discipline as $ky=>$item)
                                <option value="{{$item->id_discipline}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">تاریخ</label>
                            <input type="text" name="date" data-input-mask="date" class="form-control text-right" value="{{jdate('Y/m/d')}}" dir="ltr" maxlength="10" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">آیا از نمره انضباط کسر شود ؟</label>
                            <select class="custom-select mb-3" name="kind" dir="rtl">
                                <option value="بله">بله</option>
                                <option value="خیر">خیر</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">آیا پیامک ارسال شود ؟</label>
                            @if((DB::table('charge')->sum('price') - (DB::table('sms')->sum('count') * 500)) >= 5000)
                            <select class="custom-select mb-3" name="sms" dir="rtl">
                                <option value="بله">بله</option>
                                <option value="خیر">خیر</option>
                            </select>
                            @else
                            <select class="custom-select mb-3" name="sms" dir="rtl">
                                <option value="خیر">عدم موجودی شارژ پیامک</option>
                            </select>
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">توضیحات تکمیلی</label>
                            <input type="text" name="detail" class="form-control text-right">
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">ثبت مورد</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="alert alert-success" role="alert">موارد ثبت شده</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col">نمره</th>
                        <th scope="col">تاثیر</th>
                        <th scope="col">پیامک</th>
                        <th scope="col">توضیحات</th>
                        @if(\App\Role::role()->discipline_delete==1)
                        <th scope="col">حذف</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_enzebati as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{\App\Discipline::where('id_discipline',$item->id_discipline)->first()->name}}</td>
                        <td>{{$item->date}}</td>
                        <td>{{\App\Discipline::where('id_discipline',$item->id_discipline)->first()->score}}</td>
                        @if($item->kind=="بله")
                        <th scope="row"><i class="fa fa-check-square-o" style="color:green"></i></th>
                        @else
                        <th scope="row"><i class="fa fa fa-times" style="color:red"></i></th>
                        @endif
                        @if($item->sms=="بله")
                        <th scope="row"><i class="fa fa-check-square-o" style="color:green"></i></th>
                        @else
                        <th scope="row"><i class="fa fa fa-times" style="color:red"></i></th>
                        @endif
                        <td>{{$item->detail}}</td>
                        @if(\App\Role::role()->discipline_delete==1)
                        <th><a href="{{route('discipline_delete',['id_enzebati'=> $item->id_enzebati])}}"> <button style="background: #c92616;border-color: #c92616;" type="submit" class="btn btn-primary"><i class="fa fa-trash-o"></i></button></a></th>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection