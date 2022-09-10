<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">ثبت الگو مطالعاتی فردی</div>
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
                <form action="{{route('add_study_person')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputPassword1">نام دانش آموز</label>
                            <select class="js-example-basic-single" name="id_user" dir="rtl" onchange="submit().form">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_user as $item)
                                <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - "}}{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($id_user))
<div class="row">
    <div class="col-md-9">
        <div class="alert alert-success" role="alert">زمان بندی مطالعه {{\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname." - کلاس ".\App\Room::join('users','users.id_room','room.id_room')->where('users.id',$id_user)->first()->name}}</div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" tabindex="1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">روز</th>
                                <th scope="col">الگو مطاعاتی </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($day as $key=>$item)
                            <tr>
                                <th scope="row">{{$item}}</th>
                                <th scope="row"><a data-toggle="modal" data-target="#myModal{{$key}}"><i class="fa fa fa-edit (alias)" style="color:black"></i></a>  
                                @foreach ($etude as $item1)
                                @if($item1->day==$item)
                                <button type="button" class="btn btn-primary btn-rounded" style="background: #d83939;border-color: #d83939;">{{\App\Course::where('id_course',$item1->id_course)->first()->name." : ".$item1->clock." دقیقه"}} </button><a href="{{route('delete_study_person',['id_course'=> $item1->id_course,'day'=> $item1->day,'clock'=> $item1->clock,'id_user'=> $id_user])}}"><span aria-hidden="true" style="background: #261b78;border-radius: 44px;padding-right: 6px;padding-left: 6px;margin-right: 3px;color: #fff;">×</span></a>
                                @endif
                                @endforeach
                                </th>
                                <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('insert_study_person')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="day" value="{{$item}}">
                                                    <input type="hidden" name="id_user" value="{{$id_user}}">
                                                    <div class="row">
                                                        <div class="col-md-12 mxt-2 m-t-10">
                                                            <label>نام درس</label>
                                                            <select class="js-example-basic-single" name="id_course" dir="rtl">
                                                                <option value="">انتخاب کنید</option>
                                                                @foreach($all_course as $item)
                                                                <option value="{{$item->id_course}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mxt-2 m-t-10">
                                                            <label>میزان مطالعه به دقیقه</label>
                                                            <input type="number" name="clock1" class="form-control">
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <button type="submit" class="btn btn-primary">ثبت اطلاعات</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{route('study_print_person',['id_user'=> $id_user])}}"> <button style="background: #3553ae;border-color: #3553ae;margin-top: 15px;" type="submit" class="btn btn-primary">چاپ برگه</button></a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="alert alert-success" role="alert">مجموع</div>
        <div class="card">
            <div class="card-body">
            <div class="table-responsive" tabindex="1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">درس</th>
                                <th scope="col">ساعت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_course as $item)
                            <tr>
                                <th scope="row">{{$item->name}}</th>
                                <?php
                                $hour = 0;
                                $minute =\App\Etude::where('id_course', $item->id_course)->sum('clock');
                                if ($minute > 60) {
                                    $hour = $hour + floor($minute / 60);
                                    $minute = $minute - (floor($minute / 60)*60);
                                }
                                if ($minute < 10)
                                    $minute = "0" . $minute;
                                if ($hour < 10)
                                    $hour = "0" . $hour;
                                ?>
                                <th scope="row">{{$hour.":".$minute}}</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection