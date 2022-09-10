<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="alert alert-success" role="alert" style="background:#1b7866 !important;color:#fff;text-align:center">دانش آموزان برخط</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    @if($item->isOnline())
                    <tr>
                        <td>{{$item->fname}}</td>
                        <td>{{$item->lname}}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection