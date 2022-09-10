<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="alert alert-success text-center">لیست درخواست ها</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="color: #534b4b;">ردیف</th>
                        <th scope="col" style="color: #534b4b;">نام دانش آموز</th>
                        <th scope="col" style="color: #534b4b;">نام کلاس</th>
                        <th scope="col" style="color: #534b4b;">نام جایزه</th>
                        <th scope="col" style="color: #534b4b;">تاریخ ثبت</th>
                        <th scope="col" style="color: #534b4b;">اجرینه مصرفی</th>
                        <th scope="col" style="color: #534b4b;">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order as $key=>$item)
                @php $room=\App\User::where('id',$item->id_user)->first()->id_room; @endphp
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <th scope="row">{{\App\User::where('id',$item->id_user)->first()->fname." ".\App\User::where('id',$item->id_user)->first()->lname}}</th>
                        <th scope="row">{{\App\Room::where('id_room',$room)->first()->name}}</th>
                        <th scope="row">{{\App\Award::where('id_award',$item->id_award)->first()->title}}</th>
                        <th scope="row">{{\App\Order::where('id_order',$item->id_order)->first()->time}}</th>
                        <th scope="row">{{\App\Award::where('id_award',$item->id_award)->first()->rate}}</th>
                        <td><a class="btn subForm btn-primary" href="{{route('delete_order',['id_order'=> $item->id_order])}}" style="color:#fff;background: #db0909; border: 1px solid red;">حذف</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection