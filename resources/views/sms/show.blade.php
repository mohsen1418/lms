<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="alert alert-success" role="alert">لیست پیامک های ارسال شده</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">متن پیام</th>
                        <th scope="col">زمان ارسال</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sms as $item)
                    <tr>
                        <td>{{\App\User::where('id',$item->id_user)->first()->fname}}</td>
                        <td>{{\App\User::where('id',$item->id_user)->first()->lname}}</td>
                        <td style="white-space: inherit;line-height: 40px;">{{$item->msg}}</td>
                        <td>{{jdate('Y/m/d',$item->date)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <nav aria-label="Page navigation example" class="mb-3">
        <ul class="pagination justify-content-center">
            {{ $sms->links()}}

        </ul>
    </nav>
</div>
@endsection