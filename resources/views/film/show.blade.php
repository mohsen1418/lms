<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">{{"نمایش فیلم ها"}}</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('show_film')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام درس</label>
                        <select class="js-example-basic-single" name="id_course" dir="rtl" onchange="submit().form">
                            <option value="">انتخاب کنید</option>
                            @foreach($all_course as $item)
                            <option value="{{$item->id_course}}">{{$item->name." - ".\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($all_film))
<div class="alert alert-success" role="alert">{{"نمایش نتایج"}}</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">جلسه</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">درس</th>
                        <th scope="col">زمان</th>
                        <th scope="col">تعداد نمایش</th>
                        @if(\App\Role::role()->film_delete==1)
                        <th scope="col">حذف</th>
                        @endif
                        @if(\App\Role::role()->film_update==1)
                        <th scope="col">ویرایش</th>
                        @endif
                        <th scope="col">مشاهده</th>
                        <th scope="col">وضعیت</th>
                        <th scope="col">بازدید</th>
                        <th scope="col">درصد</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_film as $key=>$item)
                    <tr>
                        <th>{{$item->session}}</th>
                        <th>{{$item->name}}</th>
                        <th>{{\App\Course::where('id_course',$item->id_course)->first()->name}}</th>
                        <th>{{$item->time." دقیقه"}}</th>
                        <th>{{$item->count}}</th>
                        @if(\App\Role::role()->film_delete==1)
                        <th><a href="{{route('delete_film',['id_film'=> $item->id_film])}}"> <button style="background: #c92616;border-color: #c92616;" type="submit" class="btn btn-primary"><i class="fa fa-trash-o"></i></button></a></th>
                        @endif
                        @if(\App\Role::role()->film_update==1)
                        <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModa{{$key}}" style="color:#fff;background: #929189;border-color: #929189;"><i class="fa fa-edit (alias)"></i></td>
                        <div class="modal fade" id="myModa{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('update_film')}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="id_film" value="{{$item->id_film}}">
                                            <input type="hidden" name="id_course" value="{{$item->id_course}}">
                                            <div class="row">
                                                <div class="col-md-12 mxt-2">
                                                    <label>عنوان فیلم</label>
                                                    <input type="text" class="form-control" name="name" value="{{$item->name}}">
                                                </div>
                                                <div class="col-md-12 mxt-2">
                                                    <label>زمان فیلم</label>
                                                    <input type="text" class="form-control" name="time" value="{{$item->time}}">
                                                </div>
                                                <div class="col-md-12 mxt-2">
                                                    <label>شماره جلسه</label>
                                                    <input type="text" class="form-control" name="session" value="{{$item->session}}">
                                                </div>
                                                <div class="col-md-12 mxt-2">
                                                    <label>آدرس فیلم</label>
                                                    <input type="text" class="form-control" name="url" value="{{$item->url}}">
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
                        @endif
                        <th><a href="{{route('embed',['url'=> $item->url])}}" target="_blank"> <button style="background: #21a237;border-color: #21a237;" type="submit" class="btn btn-primary"><i class="fa fa-eye"></i></button></a></th>
                        @if($item->status==1)
                        <th><a href="{{route('update_status_film',['id'=> $item->id_film,'id_course'=>$item->id_course])}}"> <button type="submit" class="btn btn-primary">نمایش</button></a></th>
                        @else
                        <th><a href="{{route('update_status_film',['id'=> $item->id_film,'id_course'=>$item->id_course])}}"> <button style="    background: #da0101;border-color: #da0101;" type="submit" class="btn btn-primary">پنهان</button></a></th>
                        @endif
                        <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff;background: #e01271;border-color: #e01271;"><i class="fa fa-retweet"></i></td>
                        <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 mxt-2">
                                                <p>آمار بازدیدکنندگان</p>
                                            </div>
                                            @foreach($all_user as $key1=>$item1)
                                            @php
                                            $count = DB::table('visits')->where('id_film',$item->id_film)->where('id_user',$item1->id)->count();
                                            @endphp
                                            @if($count>0)
                                            <div class="col-md-12 mxt-2 m-t-10">
                                                <input type="text" class="form-control" value="{{++$key1." . ".$item1->fname." ".$item1->lname." - مشاهده"}}" style="background: #b3dc8d;">
                                            </div>
                                            @else
                                            <div class="col-md-12 mxt-2 m-t-10">
                                                <input type="text" class="form-control" value="{{++$key1." . ".$item1->fname." ".$item1->lname." - عدم مشاهده"}}" style="background: #dc8d8d;">
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                        $id_course = DB::table('films')->where('id_film',$item->id_film)->first()->id_course;
                        $id_room = DB::table('courses')->where('id_course',$id_course)->first()->id_room;
                        $count_user = DB::table('users')->where('id_room',$id_room)->count();
                        $count_visit = DB::table('visits')->where('id_film',$item->id_film)->count();
                        $total=round(($count_visit/$count_user)*100);
                        @endphp
                        <th>{{$total." %"}}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endif
@endsection