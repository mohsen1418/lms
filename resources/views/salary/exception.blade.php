<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
@if(Auth::user()->role==1 || Auth::user()->role==2)
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">تعریف مبلغ پرداختی دانش آموزان</div>
        <div class="card">
            <div class="card-body">
                @if (isset($msg1))
                <div class="alert alert-danger alert-with-border alert-dismissible" role="alert">
                    <i class="ti-help-alt m-l-10"></i>مبلغ تخفیف عادی نباید از قیمت تخفیف تعیین شده بیشتر باشد
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                @if (isset($msg2))
                <div class="alert alert-danger alert-with-border alert-dismissible" role="alert">
                    <i class="ti-help-alt m-l-10"></i>سقف مجاز تخفیف دهی شما به پایان رسیده است
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                <form action="{{route('add_exception')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputPassword1">نام دانش آموز</label>
                            <select class="js-example-basic-single" name="id_user" dir="rtl" onchange="this.form.submit()">
                            @if(isset($id_user))
                            <option value="{{$id_user}}">{{\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname." - ".\App\Paye::where('id_paye',\App\User::where('id',$id_user)->first()->id_paye)->first()->name}}</option>
                            @else
                                <option value="">انتخاب کنید</option>
                                @endif
                                @foreach($all_user as $item)
                                @if(\App\Exception::where('id_user',$item->id)->count()<=0)
                                <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - ".\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
                @if(isset($id_user))
                <form action="{{route('insert_exception')}}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" name="id_user" value="{{$id_user}}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">نوع تخفیف</label>
                            <select class="js-example-basic-single" name="id_rebate" dir="rtl">
                                <option></option>
                                @foreach($rebate as $item)
                                <option value="{{$item->id_rebate}}">{{$item->title." - حداکثر ".number_format($item->rate*\App\Fee::where('id_paye',$id_paye)->first()->total/100)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">تخفیف عادی</label>
                            <input type="text" class="form-control" name="normal" onkeyup="javascript:this.value=itpro(this.value);" value="0">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">تخفیف ویژه</label>
                            <input type="text" class="form-control" name="amount" onkeyup="javascript:this.value=itpro(this.value);" value="0">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">اقساط اضافی</label>
                            <select class="custom-select mb-3" name="month" dir="rtl">
                                <option value="0">انتخاب کنید</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن اطلاعات</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@foreach($paye as $item1)
<div class="alert alert-success" role="alert" >{{$item1->name}}</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">نوع تخفیف</th>
                        <th scope="col">تخفیف عادی</th>
                        <th scope="col">تخفیف ویژه</th>
                        <th scope="col">اقساط عادی</th>
                        <th scope="col">اقساط اضافی</th>
                        <th scope="col">ویرایش</th>
                        @if(Auth::user()->role==1 || Auth::user()->role==2)
                        <th scope="col">حذف</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <?php $row=0;?>
                    @foreach ($exception as $key=>$item)
                    @if(\App\User::where('id',$item->id_user)->first()->id_paye==$item1->id_paye)
                    <tr>
                        <th scope="row">{{++$row}}</th>
                        <td>{{\App\User::where('id',$item->id_user)->first()->fname}}</td>
                        <td>{{\App\User::where('id',$item->id_user)->first()->lname}}</td>
                        <td>{{\App\Rebate::where('id_rebate',$item->id_rebate)->first()->title}}</td>
                        <td>{{number_format($item->normal)}}</td>
                        <td>{{number_format($item->amount)}}</td>
                        <td>{{\App\Rebate::where('id_rebate',$item->id_rebate)->first()->count}}</td>
                        <td>{{$item->month}}</td>
                        <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff"><i class="fa fa-edit (alias)"></i></td>
                        <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('update_exception')}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="id_exception" value="{{$item->id_exception}}">
                                            <div class="row">
                                                <div class="col-md-12 mxt-2">
                                                    <label>تخفیف عادی</label>
                                                    <input type="text" class="form-control" name="normal" value="{{number_format($item->normal)}}" onkeyup="javascript:this.value=itpro(this.value);">
                                                </div>
                                                <div class="col-md-12 mxt-2">
                                                    <label>تخفیف ویژه</label>
                                                    <input type="text" class="form-control" name="amount" value="{{number_format($item->amount)}}" onkeyup="javascript:this.value=itpro(this.value);">
                                                </div>
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>اقساط اضافی </label>
                                                    <input type="number" class="form-control" name="month" value="{{$item->month}}">
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
                        @if(Auth::user()->role==1 || Auth::user()->role==2)
                        <td><a class="btn subForm btn-primary" href="{{route('delete_exception',['id_exception'=> $item->id_exception])}}" style="color:#fff;background: #db0909; border: 1px solid red;"><i class="fa fa-trash-o"></i></td>
                        @endif
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endforeach
@endsection