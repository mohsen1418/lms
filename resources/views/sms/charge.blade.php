<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="alert alert-success" role="alert">شارژ پیامک</div>
<div class="row">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating" style="background: #f7941e !important;">
                    <i class="fa  fa-send (alias)"></i>
                </div>
                <h3 class="font-weight-800 primary-font"></h3>
                <p>تعداد کل پیامک ارسالی</p>
                <p>{{DB::table('sms')->sum('count')}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating" style="background: #f7941e !important;">
                    <i class="fa  fa-sort-amount-asc"></i>
                </div>
                <h3 class="font-weight-800 primary-font"></h3>
                <p>شارژ کل باقی مانده</p>
                <p>{{number_format(DB::table('charge')->sum('price')-(DB::table('sms')->sum('count')*500))." ریال"}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating" style="background: #f7941e !important;">
                    <i class="fa fa-inbox"></i>
                </div>
                <h3 class="font-weight-800 primary-font"></h3>
                <p>تعداد پیامک باقی مانده</p>
                <p>{{round((DB::table('charge')->sum('price')-(DB::table('sms')->sum('count')*500))/500)}}</p>
            </div>
        </div>
    </div>
</div>
<div class="alert alert-success" role="alert">لیست پرداختی های پیامک</div>
<div class="card">
    <div class="card-body">
            <div class="table-responsive" tabindex="1">
            <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ردیف</th>
                            <th scope="col">قیمت به ریال</th>
                            <th scope="col">تاریخ پرداخت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($charge as $key=>$item)
                        <tr>
                            <th scope="row">{{++$key}}</th>
                            <td>{{number_format($item->price)}}</td>
                            <td>{{$item->date}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>
@endsection