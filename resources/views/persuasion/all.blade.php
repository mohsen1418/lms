<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="alert alert-success" role="alert">گزارش کل مدرسه</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">نام پایه</th>
                        <th scope="col">نام کلاس</th>
                        <th scope="col">امتیاز اجرینه</th>
                        <th scope="col">امتیاز زجرینه</th>
                        <th scope="col">مجموع</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_user as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{$item->fname}}</td>
                        <td>{{$item->lname}}</td>
                        <td>{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</td>
                        <td>{{\App\Room::where('id_room',$item->id_room)->first()->name}}</td>
                        <td>{{\App\Persuasion::join('besharat','persuasion.id_persuasion','=','besharat.id_persuasion')->where('besharat.id_user',$item->id)->where('persuasion.kind',"اجرینه")->sum('score')}}</td>
                        <td>{{\App\Persuasion::join('besharat','persuasion.id_persuasion','=','besharat.id_persuasion')->where('besharat.id_user',$item->id)->where('persuasion.kind',"زجرینه")->sum('score')}}</td>
                        <td style="direction: ltr;">{{\App\User::where('id',$item->id)->first()->score}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection