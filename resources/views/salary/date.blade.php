<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">گزارش زمانی پرداختی ها</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('date_result')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">تاریخ شروع</label>
                            <input type="text" name="date1" class="form-control text-right" dir="ltr">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">تاریخ پایان</label>
                            <input type="text" name="date2" class="form-control text-right" dir="ltr">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">وضعیت</label>
                            <select class="js-example-basic-single" name="status" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                <option value="1">پرداخت شده</option>
                                <option value="0">پرداخت نشده</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">نوع پرداخت</label>
                            <select class="js-example-basic-single" name="kind" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                <option value="چک">چک</option>
                                <option value="تعهد پرداخت">تعهد پرداخت</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">مشاهده نتایج</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($date1))
<div class="alert alert-success" role="alert">{{"نمایش ".$date1." - ".$date2}}</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">پایه</th>
                        <th scope="col">شماره پدر</th>
                        <th scope="col">شماره مادر</th>
                        <th scope="col">نوع</th>
                        <th scope="col">تاریخ سررسید</th>
                        <th scope="col">مبلغ</th>
                        <th scope="col">وضعیت</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($total as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{$item->fname}}</td>
                        <td>{{$item->lname}}</td>
                        <td>{{\App\User::join('paye','users.id_paye','paye.id_paye')->where('users.id',$item->id_user)->first()->name}}</td>
                        <td>{{$item->f_number}}</td>
                        <td>{{$item->m_number}}</td>
                        <td>{{$item->kind}}</td>
                        <td>{{$item->date}}</td>
                        <td>{{number_format($item->price)}}</td>
                        @if($item->status==1)
                        <td style="color:green;">پرداخت شده</td>
                        @else
                        <td style="color:red;">پرداخت نشده</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection