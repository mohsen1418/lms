<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">مشاهده آلبوم دانش آموزی</div>
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-with-border alert-dismissible" role="alert">
                    <i class="ti-help-alt m-l-10"></i>{{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endforeach
                @endif
                <form action="{{route('album')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام کلاس</label>
                        <select class="js-example-basic-single" name="id_room" dir="rtl" onchange="submit().form">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_room as $ky=>$item)
                            <option value="{{$item->id_room}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($all_user))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">نمایش نتایج</div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach($all_user as $key=>$item)
                    <div class="col-md-3">
                        @if($item->avatar!="")
                        <img style="width: 100%;height: 290px;margin-bottom: 15px;" src="{{ asset('main/public/avatar/'.$item->avatar )}}" />
                        @else
                        <img style="width: 100%;height: 290px;margin-bottom: 15px;" src="https://www.seekpng.com/png/detail/41-410093_circled-user-icon-user-profile-icon-png.png" />
                        @endif
                        <div class="alert alert-success" role="alert">{{$item->fname." ".$item->lname}}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection