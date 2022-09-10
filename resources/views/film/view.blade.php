<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')


<div class="alert alert-success" role="alert">مشاهده فیلم ها</div>
<div class="row">
    @foreach($all_film as $item)
    <div class="col-md-4 col-lg-4 m-t-10">
        <?php echo $item->url ?>
        @if($item->status==0)
        <div class="alert alert-success" role="alert" style="background:#da3838 !important;color:#fff;text-align: center;height: 51px;margin-top: 10px;">
            <center>
                <p>{{$item->name." - جلسه ".$item->session}}</p>
            </center>
        </div>
        @else
        <div class="alert alert-success" role="alert" style="background:#1b7866 !important;color:#fff;text-align: center;height: 51px;margin-top: 10px;">
            <center>
                <p>{{$item->name." - جلسه ".$item->session}}</p>
            </center>
        </div>
        @endif

    </div>
    @endforeach
</div>
@endsection