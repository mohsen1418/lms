<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">{{"نمایش تکالیف"}}</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('show_homework')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام درس</label>
                        <select class="js-example-basic-single" name="id_course" dir="rtl" onchange="submit().form">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_course as $ky=>$item)
                            <option value="{{$item->id_course}}">{{$item->name." - ".\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($all_homework))
<div class="alert alert-success" role="alert">تکالیف درس {{\App\Course::where('id_course',$id_course)->first()->name." - کلاس ".\App\Room::where('id_room',\App\course::where('id_course',$id_course)->first()->id_room)->first()->name}}</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">عنوان</th>
                        <th scope="col">تاریخ شروع</th>
                        <th scope="col">ساعت شروع</th>
                        <th scope="col">تاریخ پایان</th>
                        <th scope="col">ساعت پایان</th>
                        <th scope="col">فایل تکلیف</th>
                        <th scope="col">توضیحات</th>
                        <th scope="col">نمره دهی</th>
                        <th scope="col">گزارش</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_homework as $key=>$item)
                    <tr>
                        <th scope="row">{{$item->title}}</th>
                        <th scope="row">{{$item->date1}}</th>
                        <th scope="row">{{$item->clock1}}</th>
                        <th scope="row">{{$item->date2}}</th>
                        <th scope="row">{{$item->clock2}}</th>
                        @if($item->file!="")
                        <th scope="row"><a target="_blank" href="{{"http://127.0.0.1:8000/homework/".$item->file}}" target="_blank"> <button style="background: #21a237;border-color: #21a237;" type="submit" class="btn btn-primary">دانلود</button></a></th>
                        @else
                        <th scope="row">-</th>
                        @endif
                        <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff;background: #4374d3;border-color: #4374d3;">مشاهده</td>
                        <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 mxt-2">
                                                <p style="text-align:center">نمایش توضیحات تکلیف</p>
                                            </div>
                                            <div class="col-md-12 mxt-2">
                                                <p>{{$item->detail}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(\App\Trouble::where('id_homework',$item->id_homework)->where('score','!=',"")->count()<=0) <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal2{{$key}}" style="color:#fff;background: #af9e12;border-color: #af9e12;">ثبت نشده</td>
                                @else
                                <td><a class="btn subForm btn-primary" style="color:#fff;background: #af9e12;border-color: #af9e12;">ثبت شده</td>
                                @endif
                                <div class="modal fade" id="myModal2{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('score_homework')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id_course" value="{{$id_course}}">
                                                    <div class="row">
                                                        <div class="col-md-12 mxt-2">
                                                            <p style="text-align:center">ثبت نمره تکلیف</p>
                                                        </div>
                                                        <div class="col-md-8 mxt-2 m-t-10">
                                                            <input type="text" class="form-control" value="نام و نام خانوادگی" style="background: #8dc5dc;text-align:center" disabled>
                                                        </div>
                                                        <div class="col-md-4 mxt-2 m-t-10">
                                                            <input type="text" class="form-control" value="نمره" style="background: #8dc5dc;text-align:center" disabled>
                                                        </div>
                                                        @foreach($all_user as $key1=>$item1)
                                                        <input type="hidden" name="id_user[]" value="{{$item1->id}}">
                                                        <div class="col-md-8 mxt-2 m-t-10">
                                                            <input type="text" class="form-control" value="{{$item1->fname." ".$item1->lname}}" style="background: #b3dc8d;text-align:center" disabled>
                                                        </div>
                                                        <div class="col-md-4 mxt-2 m-t-10">
                                                            <select class="js-example-basic-single" name="score[]" dir="rtl">
                                                                <option value="">انتخاب کنید</option>
                                                                <option value="کامل">کامل</option>
                                                                <option value="ناقص">ناقص</option>
                                                                <option value="عدم انجام">عدم انجام</option>
                                                                <option value="غایب">غایب</option>
                                                            </select>
                                                        </div>
                                                        @endforeach
                                                        <div class="col-md-12 mt-3">
                                                            <button type="submit" class="btn btn-primary">ثبت نمره</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal1{{$key}}" style="color:#fff;background: #e01271;border-color: #e01271;">مشاهده</td>
                                <div class="modal fade" id="myModal1{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 mxt-2">
                                                        <p style="text-align:center">آمار ارسال دانش آموزان</p>
                                                    </div>
                                                    <div class="col-md-4 mxt-2 m-t-10">
                                                        <input type="text" class="form-control" value="نام و نام خانوادگی" style="background: #8dc5dc;text-align:center" disabled>
                                                    </div>
                                                    <div class="col-md-3 mxt-2 m-t-10">
                                                        <input type="text" class="form-control" value="تاریخ ارسال" style="background: #8dc5dc;text-align:center" disabled>
                                                    </div>
                                                    <div class="col-md-2 mxt-2 m-t-10">
                                                        <input type="text" class="form-control" value="زمان ارسال" style="background: #8dc5dc;text-align:center" disabled>
                                                    </div>
                                                    <div class="col-md-3 mxt-2 m-t-10">
                                                        <input type="text" class="form-control" value="نمره" style="background: #8dc5dc;text-align:center" disabled>
                                                    </div>
                                                    @foreach($all_user as $key1=>$item1)
                                                    @if(\App\Trouble::where('id_user',$item1->id)->where('id_homework',$item->id_homework)->where('date','!=',"")->count()>0 )
                                                    <div class="col-md-4 mxt-2 m-t-10">
                                                        <input type="text" class="form-control" value="{{$item1->fname." ".$item1->lname}}" style="background: #b3dc8d;text-align:center" disabled>
                                                    </div>
                                                    <div class="col-md-3 mxt-2 m-t-10">
                                                        <input type="text" class="form-control" value="{{\App\Trouble::where('id_user',$item1->id)->where('id_homework',$item->id_homework)->first()->date}}" style="background: #b3dc8d;text-align:center" disabled>
                                                    </div>
                                                    <div class="col-md-2 mxt-2 m-t-10">
                                                        <input type="text" class="form-control" value="{{\App\Trouble::where('id_user',$item1->id)->where('id_homework',$item->id_homework)->first()->time}}" style="background: #b3dc8d;text-align:center" disabled>
                                                    </div>
                                                    <div class="col-md-3 mxt-2 m-t-10">
                                                        <input type="text" class="form-control" value="{{\App\Trouble::where('id_user',$item1->id)->where('id_homework',$item->id_homework)->first()->score}}" style="background: #b3dc8d;text-align:center" disabled>
                                                    </div>
                                                    @else
                                                    <div class="col-md-4 mxt-2 m-t-10">
                                                        <input type="text" class="form-control" value="{{$item1->fname." ".$item1->lname}}" style="background: #dc8d92;text-align:center" disabled>
                                                    </div>
                                                    <div class="col-md-3 mxt-2 m-t-10">
                                                        <input type="text" class="form-control" style="background: #dc8d92;text-align:center" disabled>
                                                    </div>
                                                    <div class="col-md-2 mxt-2 m-t-10">
                                                        <input type="text" class="form-control" style="background: #dc8d92;text-align:center" disabled>
                                                    </div>
                                                    <div class="col-md-3 mxt-2 m-t-10">
                                                        @if(\App\Trouble::where('id_user',$item1->id)->where('id_homework',$item->id_homework)->where('score','!=',"")->count()>0 )
                                                        <input type="text" class="form-control" value="{{\App\Trouble::where('id_user',$item1->id)->where('id_homework',$item->id_homework)->first()->score}}" style="background: #dc8d92;text-align:center" disabled>
                                                        @else
                                                        <input type="text" class="form-control" value="" style="background: #dc8d92;text-align:center" disabled>
                                                        @endif
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection