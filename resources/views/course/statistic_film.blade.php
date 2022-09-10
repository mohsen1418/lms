<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="alert alert-success" role="alert">آمار بازدید فیلم ها</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="text-align: center;">نام فیلم</th>
                        <th scope="col" style="text-align: center;">نام درس</th>
                        <th scope="col" style="text-align: center;">نام کلاس</th>
                        <th scope="col" style="text-align: center;">تعداد مشاهده</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($film as $key=>$item)
                    <tr>
                        <th scope="row" style="text-align: center;">{{++$key}}</th>
                        <th style="text-align: center;">{{$item->name}}</th>
                        <th style="text-align: center;">{{\App\Course::where('id_course',$item->id_course)->first()->name ?? 'None'}}</th>
                        <td style="text-align: center;">{{\App\Course::join('room','courses.id_room','=','room.id_room')->where('courses.id_course',$item->id_course)->first()->name ?? 'None'}}</td>
                        <td style="text-align: center;">{{$item->count}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection