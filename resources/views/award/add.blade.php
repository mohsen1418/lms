<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success text-center" role="alert" >{{"میز جوایز"}}</div>
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
                <form action="{{route('insert_award')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان جایزه</label>
                        <input type="text" class="form-control" name="title">
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">توضیحات</label>
                        <input type="text" class="form-control" name="detail">
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">اجرینه مورد نیاز</label>
                        <input type="text" class="form-control" name="rate">
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">آپلود تصویر</label>
                        <input class="form-control" type="file" name="photo" id="fileToUpload">
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن مورد</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="alert alert-success text-center" >
    لیست جوایز</a></div>
<div class="row">
    @foreach($award as $key=>$item)
    <div class="col-md-4 col-12">
        <div class="card text-center">
            <div class="card-body">
                <img src="{{ 'https://lms.andishesafa.ir/ms1/admin/main/award/'.$item->photo}}"
                    style="width: 100%;margin-bottom: 15px;" />
                <h4 class="font-weight-800 primary-font"></h4>
                <p style="color: #636060">{{$item->title}}</p>
                <p style="color: #636060">اجرینه مورد نیاز : {{$item->rate}}</p>
                <a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff">توضیحات</a>
                @if($item->status==1)
                <a class="btn subForm btn-primary" href="{{route('status_award',['id_award'=> $item->id_award])}}"  style="color:#fff;background: #3f51b5;">فعال</a>
                @else
                <a class="btn subForm btn-primary" href="{{route('status_award',['id_award'=> $item->id_award])}}" style="color:#fff;background: #d32525;">غیر غعال</a>
                @endif
                <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                توضیحات جایزه
                                <div class="form-group">
                                    <textarea style="margin-top:10px" disabled name="text" class="form-control"
                                        rows="10">{{$item->detail}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection