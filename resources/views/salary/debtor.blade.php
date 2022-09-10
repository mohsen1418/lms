<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="alert alert-success" role="alert">لیست بدهکاران</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">پایه</th>
                        <th scope="col">شماره پدر</th>
                        <th scope="col">شماره مادر</th>
                        <th scope="col">نوع</th>
                        <th scope="col">مبلغ</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col">وضعیت</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($total as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{\App\User::where('id',$item->id_user)->first()->fname}}</td>
                        <td>{{\App\User::where('id',$item->id_user)->first()->lname}}</td>
                        <td>{{\App\User::join('paye','users.id_paye','paye.id_paye')->where('users.id',$item->id_user)->first()->name}}</td>
                        <td>{{\App\User::where('id',$item->id_user)->first()->f_number}}</td>
                        <td>{{\App\User::where('id',$item->id_user)->first()->m_number}}</td>
                        <td>{{$item->kind}}</td>
                        <td>{{number_format($item->price)}}</td>
                        <td>{{$item->date}}</td>
                        <td style="color:red;">پرداخت نشده</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection