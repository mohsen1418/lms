<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="alert alert-success" style="background: #1b7866 !important;color: #fff;text-align: center;">تابلو اعلانات</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="timeline">
                    @foreach($message as $key=>$item)
                    <div class="timeline-item">
                        <div>
                            <figure class="avatar avatar-sm m-l-15 bring-forward">
                                <span class="avatar-title bg-danger rounded-circle">{{++$key}}</span>
                            </figure>
                        </div>
                        <div>
                            <p class="primary-font" style="color: #6a6a6a;margin-top: 6px;text-align: justify;line-height: 30px;font-weight: 100;">{{$item->text}}</p>
                            <img src="{{ 'https://lms.andishesafa.ir/ps1/admin/main/news/'.$item->photo}}" style="width: 100%;"/>
                            <small class="text-muted">
                                <i class="fa fa-clock-o m-l-5"></i> {{jdate("Y/m/d",$item->date)." - ".$item->sender}}
                            </small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection