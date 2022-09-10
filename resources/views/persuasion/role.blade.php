<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">{{"افزودن قانون جدید"}}</div>
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
                <form action="{{route('insert_persuasion')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان </label>
                        <input type="text" class="form-control" name="title">
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">معاونت مربوطه</label>
                        <select class="js-example-basic-single" name="section" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            <option value="پرورشی">پرورشی</option>
                            <option value="آموزشی">آموزشی</option>
                            <option value="انضباطی">انضباطی</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">امتیاز</label>
                        <input type="number" class="form-control" name="score">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">نوع قانون</label>
                        <select class="js-example-basic-single" name="kind" dir="rtl">
                            <option value="">انتخاب کنید</option>
                            <option value="اجرینه">اجرینه</option>
                            <option value="زجرینه">زجرینه</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن قانون جدید</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-success" role="alert">لیست قوانین اجرینه</div>
<div class="card">
    <div class="card-body">
        <ul class="nav nav-pills flex-column flex-sm-row" id="myTab1" role="tablist">
            <li class="flex-sm-fill text-sm-center nav-item">
                <a class="nav-link show active" id="hometimeline-tab1" data-toggle="tab" href="#timeline1" role="tab" aria-controls="home" aria-selected="true">پرورشی</a>
            </li>
            <li class="flex-sm-fill text-sm-center nav-item">
                <a class="nav-link show" id="photos-tab1" data-toggle="tab" href="#photos1" role="tab" aria-controls="profile" aria-selected="false">آموزشی</a>
            </li>
            <li class="flex-sm-fill text-sm-center nav-item">
                <a class="nav-link show" id="followers-tab2" data-toggle="tab" href="#followers2" role="tab" aria-controls="followers" aria-selected="false">انضباطی</a>
            </li>
        </ul>
        <div class="tab-content p-t-30" id="myTabContent">

            <div class="tab-pane fade active show" id="timeline1" role="tabpanel" aria-labelledby="timeline-tab1">

                <div class="table-responsive" tabindex="1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ردیف</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">امتیاز</th>
                                <th scope="col">ویرایش</th>
                                <th scope="col">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 0; ?>
                            @foreach ($all_persuasion as $key=>$item)
                            @if($item->kind=="اجرینه" AND $item->section=="پرورشی")
                            <tr>
                                <th scope="row">{{++$number}}</th>
                                <td>{{$item->title}}</td>
                                <td>{{$item->score}}</td>
                                <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff">ویرایش</td>
                                <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('update_persuasion')}}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="id_persuasion" value="{{$item->id_persuasion}}">
                                                    <div class="row">
                                                        <div class="col-md-12 mxt-2">
                                                            <label>عنوان</label>
                                                            <input type="text" class="form-control" name="title" value="{{$item->title}}">
                                                        </div>
                                                        <div class="col-md-12 mxt-2 m-t-10">
                                                            <label>امتیاز</label>
                                                            <input type="text" class="form-control" name="score" value="{{$item->score}}">
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <button type="submit" class="btn btn-primary">ویرایش اطلاعات</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td><a class="btn subForm btn-primary" href="{{route('delete_persuasion',['id_persuasion'=> $item->id_persuasion])}}" style="color:#fff;background: #db0909; border: 1px solid red;">حذف</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="photos1" role="tabpanel" aria-labelledby="photos-tab1">
                <div class="timeline">
                <div class="table-responsive" tabindex="1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ردیف</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">امتیاز</th>
                                <th scope="col">ویرایش</th>
                                <th scope="col">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 0; ?>
                            @foreach ($all_persuasion as $key=>$item)
                            @if($item->kind=="اجرینه" AND $item->section=="آموزشی")
                            <tr>
                                <th scope="row">{{++$number}}</th>
                                <td>{{$item->title}}</td>
                                <td>{{$item->score}}</td>
                                <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff">ویرایش</td>
                                <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('update_persuasion')}}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="id_persuasion" value="{{$item->id_persuasion}}">
                                                    <div class="row">
                                                        <div class="col-md-12 mxt-2">
                                                            <label>عنوان</label>
                                                            <input type="text" class="form-control" name="title" value="{{$item->title}}">
                                                        </div>
                                                        <div class="col-md-12 mxt-2 m-t-10">
                                                            <label>امتیاز</label>
                                                            <input type="text" class="form-control" name="score" value="{{$item->score}}">
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <button type="submit" class="btn btn-primary">ویرایش اطلاعات</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td><a class="btn subForm btn-primary" href="{{route('delete_persuasion',['id_persuasion'=> $item->id_persuasion])}}" style="color:#fff;background: #db0909; border: 1px solid red;">حذف</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>

            <div class="tab-pane fade" id="followers2" role="tabpanel" aria-labelledby="followers-tab">
            <div class="table-responsive" tabindex="1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ردیف</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">امتیاز</th>
                                <th scope="col">ویرایش</th>
                                <th scope="col">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 0; ?>
                            @foreach ($all_persuasion as $key=>$item)
                            @if($item->kind=="اجرینه" AND $item->section=="انضباطی")
                            <tr>
                                <th scope="row">{{++$number}}</th>
                                <td>{{$item->title}}</td>
                                <td>{{$item->score}}</td>
                                <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff">ویرایش</td>
                                <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('update_persuasion')}}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="id_persuasion" value="{{$item->id_persuasion}}">
                                                    <div class="row">
                                                        <div class="col-md-12 mxt-2">
                                                            <label>عنوان</label>
                                                            <input type="text" class="form-control" name="title" value="{{$item->title}}">
                                                        </div>
                                                        <div class="col-md-12 mxt-2 m-t-10">
                                                            <label>امتیاز</label>
                                                            <input type="text" class="form-control" name="score" value="{{$item->score}}">
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <button type="submit" class="btn btn-primary">ویرایش اطلاعات</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td><a class="btn subForm btn-primary" href="{{route('delete_persuasion',['id_persuasion'=> $item->id_persuasion])}}" style="color:#fff;background: #db0909; border: 1px solid red;">حذف</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="alert alert-success" role="alert">لیست قوانین زجرینه</div>
<div class="card">
    <div class="card-body">

        <ul class="nav nav-pills flex-column flex-sm-row" id="myTab2" role="tablist">
            <li class="flex-sm-fill text-sm-center nav-item">
                <a class="nav-link show active" id="hometimeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="home" aria-selected="true">پرورشی</a>
            </li>
            <li class="flex-sm-fill text-sm-center nav-item">
                <a class="nav-link show" id="photos-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="profile" aria-selected="false">آموزشی</a>
            </li>
            <li class="flex-sm-fill text-sm-center nav-item">
                <a class="nav-link show" id="followers-tab1" data-toggle="tab" href="#followers" role="tab" aria-controls="followers" aria-selected="false">انضباطی</a>
            </li>
        </ul>

        <div class="tab-content p-t-30" id="myTabContent">

            <div class="tab-pane fade active show" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">

                <div class="table-responsive" tabindex="1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ردیف</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">امتیاز</th>
                                <th scope="col">ویرایش</th>
                                <th scope="col">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 0; ?>
                            @foreach ($all_persuasion as $key=>$item)
                            @if($item->kind=="زجرینه" AND $item->section=="پرورشی")
                            <tr>
                                <th scope="row">{{++$number}}</th>
                                <td>{{$item->title}}</td>
                                <td>{{$item->score}}</td>
                                <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff">ویرایش</td>
                                <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('update_persuasion')}}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="id_persuasion" value="{{$item->id_persuasion}}">
                                                    <div class="row">
                                                        <div class="col-md-12 mxt-2">
                                                            <label>عنوان</label>
                                                            <input type="text" class="form-control" name="title" value="{{$item->title}}">
                                                        </div>
                                                        <div class="col-md-12 mxt-2 m-t-10">
                                                            <label>امتیاز</label>
                                                            <input type="text" class="form-control" name="score" value="{{$item->score}}">
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <button type="submit" class="btn btn-primary">ویرایش اطلاعات</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td><a class="btn subForm btn-primary" href="{{route('delete_persuasion',['id_persuasion'=> $item->id_persuasion])}}" style="color:#fff;background: #db0909; border: 1px solid red;">حذف</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                <div class="timeline">
                <div class="table-responsive" tabindex="1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ردیف</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">امتیاز</th>
                                <th scope="col">ویرایش</th>
                                <th scope="col">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 0; ?>
                            @foreach ($all_persuasion as $key=>$item)
                            @if($item->kind=="زجرینه" AND $item->section=="آموزشی")
                            <tr>
                                <th scope="row">{{++$number}}</th>
                                <td>{{$item->title}}</td>
                                <td>{{$item->score}}</td>
                                <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff">ویرایش</td>
                                <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('update_persuasion')}}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="id_persuasion" value="{{$item->id_persuasion}}">
                                                    <div class="row">
                                                        <div class="col-md-12 mxt-2">
                                                            <label>عنوان</label>
                                                            <input type="text" class="form-control" name="title" value="{{$item->title}}">
                                                        </div>
                                                        <div class="col-md-12 mxt-2 m-t-10">
                                                            <label>امتیاز</label>
                                                            <input type="text" class="form-control" name="score" value="{{$item->score}}">
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <button type="submit" class="btn btn-primary">ویرایش اطلاعات</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td><a class="btn subForm btn-primary" href="{{route('delete_persuasion',['id_persuasion'=> $item->id_persuasion])}}" style="color:#fff;background: #db0909; border: 1px solid red;">حذف</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>

            <div class="tab-pane fade" id="followers" role="tabpanel" aria-labelledby="followers-tab">
            <div class="table-responsive" tabindex="1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ردیف</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">امتیاز</th>
                                <th scope="col">ویرایش</th>
                                <th scope="col">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 0; ?>
                            @foreach ($all_persuasion as $key=>$item)
                            @if($item->kind=="زجرینه" AND $item->section=="انضباطی")
                            <tr>
                                <th scope="row">{{++$number}}</th>
                                <td>{{$item->title}}</td>
                                <td>{{$item->score}}</td>
                                <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff">ویرایش</td>
                                <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('update_persuasion')}}" method="POST" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="id_persuasion" value="{{$item->id_persuasion}}">
                                                    <div class="row">
                                                        <div class="col-md-12 mxt-2">
                                                            <label>عنوان</label>
                                                            <input type="text" class="form-control" name="title" value="{{$item->title}}">
                                                        </div>
                                                        <div class="col-md-12 mxt-2 m-t-10">
                                                            <label>امتیاز</label>
                                                            <input type="text" class="form-control" name="score" value="{{$item->score}}">
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <button type="submit" class="btn btn-primary">ویرایش اطلاعات</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td><a class="btn subForm btn-primary" href="{{route('delete_persuasion',['id_persuasion'=> $item->id_persuasion])}}" style="color:#fff;background: #db0909; border: 1px solid red;">حذف</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection