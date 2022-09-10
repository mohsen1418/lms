<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert" >ثبت نمره کلاسی</div>
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
                <form action="{{route('add_mark')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">نام درس</label>
                            <select class="js-example-basic-single" name="id_course" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_course as $item)
                                <option value="{{$item->id_course}}">{{$item->name." - ".\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">تاریخ</label>
                            <input type="text" name="date" data-input-mask="date" class="form-control text-right" value="{{jdate('Y/m/d')}}" dir="ltr" maxlength="10" autocomplete="off">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword1">نوع نمره</label>
                            <select class="custom-select mb-3" name="kind" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                <option value="1">نمره از 20</option>
                                <option value="3">نمره از 100</option>
                                <option value="2">مثبت و منفی</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">متن توضیحات</label>
                            <input type="text" name="detail" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">ثبت نمره</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($id_course))
<div class="alert alert-success" role="alert">اسامی دانش آموزان کلاس {{\App\Room::where('id_room',$id_room)->first()->name}}</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
            <form action="{{route('insert_mark')}}" method="POST">
                @csrf
                <input type="hidden" name="date" value="{{$date}}">
                <input type="hidden" name="detail" value="{{$detail}}">
                <input type="hidden" name="id_course" value="{{$id_course}}">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ردیف</th>
                            <th scope="col">نام</th>
                            <th scope="col">نام خانوادگی</th>
                            <th scope="col">نمره</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_user as $key=>$item)
                        <input type="hidden" name="id_user[]" value="{{$item->id}}">
                        <tr>
                            <th scope="row">{{++$key}}</th>
                            <td>{{$item->fname}}</td>
                            <td>{{$item->lname}}</td>
                            @if($kind==1)
                            <td><input type="text" name="mark[]" class="form-control" id="mark{{$key}}" onchange="validation()"></td>
                            @elseif($kind==2)
                            <td>
                                <select class="custom-select mb-3" name="mark[]" dir="rtl">
                                    <option value="">انتخاب کنید</option>
                                    <option value="مثبت">مثبت</option>
                                    <option value="منفی">منفی</option>
                                </select>
                            </td>
                            @else
                            <td><input type="text" name="mark[]" class="form-control" id="mark{{$key}}" onchange="validation()"></td>
                            @endif
                        </tr>
                        @if($kind==1)
                        <script>
                            function validation() {
                                if (document.getElementById('mark{{$key}}').value>20)
                                    alert('بازه نمره باید بین صفر تا 20 باشد');
                            }
                        </script>
                        @else
                        <script>
                            function validation() {
                                if (document.getElementById('mark{{$key}}').value>100)
                                    alert('بازه نمره باید بین صفر تا 100 باشد');
                            }
                        </script>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">ثبت اطلاعات</button>
            </form>
        </div>
    </div>
</div>
@endif
@endsection