<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="alert alert-success" role="alert" >گزارش اجمالی فاکتور های ثبت شده</div>
<div class="row">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating" style="background: #f7941e !important;">
                    <i class="fa  fa-money"></i>
                </div>
                <h3 class="font-weight-800 primary-font"></h3>
                <p>مجتمع <span class="badge badge-primary badge-pill mr-auto">{{DB::table('cost')->where('kind',1)->where('source',"مجتمع")->count()}}</span></p>
                <p>{{number_format(DB::table('cost')->where('kind',1)->where('source',"مجتمع")->sum('rate'))}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating" style="background: #f7941e !important;">
                    <i class="fa  fa-money"></i>
                </div>
                <h3 class="font-weight-800 primary-font"></h3>
                <p>بانی <span class="badge badge-primary badge-pill mr-auto">{{DB::table('cost')->where('kind',1)->where('source',"بانی")->count()}}</span></p>
                <p>{{number_format(DB::table('cost')->where('kind',1)->where('source',"بانی")->sum('rate'))}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating" style="background: #f7941e !important;">
                    <i class="fa  fa-money"></i>
                </div>
                <h3 class="font-weight-800 primary-font"></h3>
                <p>تنخواه <span class="badge badge-primary badge-pill mr-auto">{{DB::table('cost')->where('kind',1)->where('source',"تنخواه")->count()}}</span></p>
                <p>{{number_format(DB::table('cost')->where('kind',1)->where('source',"تنخواه")->sum('rate'))}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating" style="background: #f7941e !important;">
                    <i class="fa  fa-money"></i>
                </div>
                <h3 class="font-weight-800 primary-font"></h3>
                <p>درآمد های مدرسه <span class="badge badge-primary badge-pill mr-auto">{{DB::table('cost')->where('kind',1)->where('source',"درآمد های مدرسه")->count()}}</span></p>
                <p>{{number_format(DB::table('cost')->where('kind',1)->where('source',"درآمد های مدرسه")->sum('rate'))}}</p>
            </div>
        </div>
    </div>
</div>
<div class="alert alert-success" role="alert" >مشاهده فاکتور های ثبت شده</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">عنوان</th>
                        <th scope="col">نام ثبت کننده</th>
                        <th scope="col">مبلغ</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col">منبع مالی</th>
                        <th scope="col">شماره پیگیری</th>
                        <th scope="col">فاکتور</th>
                        <th scope="col">توضیحات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cost as $item)
                    <tr>
                        <td>{{$item->title}}</td>
                        <td>{{\App\User::where('id',$item->id_user)->first()->fname." ".\App\User::where('id',$item->id_user)->first()->lname}}</td>
                        <td>{{number_format($item->rate)}}</td>
                        <td>{{$item->date}}</td>
                        <td>{{$item->source}}</td>
                        <td>{{$item->issue_track}}</td>
                        @if($item->photo==null)
                        <td>-</td>
                        @else
                        <td><a href="{{ asset('main/public/cost/'.$item->photo )}}" target="_blanck" class="btn subForm btn-primary" style="color:#fff">مشاهده</td>
                        @endif
                        <td>{{$item->description}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection