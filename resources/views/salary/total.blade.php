<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">گزارش مالی دانش آموزی</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('total_salary')}}" method="POST">
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
@if(isset($id_room))
<div class="alert alert-success" role="alert">لیست مالی کلاس {{\App\Room::where('id_room',$id_room)->first()->name}}</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col" style="color:red">تعداد</th>
                        <th scope="col" style="color:red">چک</th>
                        <th scope="col" style="color:red">پرداخت</th>
                        <th scope="col" style="color:blue">تعداد</th>
                        <th scope="col" style="color:blue">تعهد</th>
                        <th scope="col" style="color:blue">پرداخت</th>
                        <th scope="col" style="color:green">نقد</th>
                        <th scope="col">پرداختی</th>
                        <th scope="col">مانده</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_user as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{$item->fname}}</td>
                        <td>{{$item->lname}}</td>
                        <td style="color:red">{{\App\Agreement::where('id_user',$item->id)->where('kind',"چک")->where('status',1)->count()."/".\App\Agreement::where('id_user',$item->id)->where('kind',"چک")->count()}}</td>
                        <td style="color:red">{{number_format(\App\Agreement::where('id_user',$item->id)->where('kind',"چک")->sum('price'))}}</td>
                        <td style="color:red">{{number_format(\App\Agreement::where('id_user',$item->id)->where('kind',"چک")->where('status',1)->sum('price'))}}</td>
                        <td style="color:blue">{{\App\Agreement::where('id_user',$item->id)->where('kind',"تعهد پرداخت")->where('status',1)->count()."/".\App\Agreement::where('id_user',$item->id)->where('kind',"تعهد پرداخت")->count()}}</td>
                        <td style="color:blue">{{number_format(\App\Agreement::where('id_user',$item->id)->where('kind',"تعهد پرداخت")->sum('price'))}}</td>
                        <td style="color:blue">{{number_format(\App\Agreement::where('id_user',$item->id)->where('kind',"تعهد پرداخت")->where('status',1)->sum('price'))}}</td>
                        <td style="color:green">{{number_format(\App\Agreement::where('id_user',$item->id)->where('kind',"نقد")->sum('price'))}}</td>
                        <td>{{number_format(\App\Agreement::where('id_user',$item->id)->where('status',1)->sum('price'))}}</td>
                        <td>{{number_format((\App\Agreement::where('id_user',$item->id)->where('kind',"چک")->sum('price')+\App\Agreement::where('id_user',$item->id)->where('kind',"تعهد پرداخت")->sum('price')+\App\Agreement::where('id_user',$item->id)->where('kind',"نقد")->sum('price'))-\App\Agreement::where('id_user',$item->id)->where('status',1)->sum('price'))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection