<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">مشاهده قرارداد مالی</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('show_agreement')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputPassword1">نام دانش آموز</label>
                            <select class="js-example-basic-single" name="id_user" dir="rtl" onchange="this.form.submit()">
                                <option value="">انتخاب کنید</option>
                                @foreach($exception as $item)
                                @if(\App\User::where('id',$item->id_user)->count())
                                <option value="{{$item->id_user}}">{{\App\User::where('id',$item->id_user)->first()->fname." ".\App\User::where('id',$item->id_user)->first()->lname." - ".\App\Paye::join('users','paye.id_paye','users.id_paye')->where('users.id',$item->id_user)->first()->name}}</option>
                                @endif
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
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">{{"قرارداد مالی ".\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname}}</div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" tabindex="1">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">شهریه</th>
                                <th scope="col">تخفیف اصلی</th>
                                <th scope="col">تخفیف ویژه</th>
                                <th scope="col">شهریه دریافتی</th>
                                <th scope="col">کمک های مردمی</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>{{number_format($price)}}</th>
                                <th>{{number_format($normal)}}</th>
                                <th>{{number_format($amount)}}</th>
                                <th>{{number_format($price-($normal+$amount))}}</th>
                                <th>{{number_format(\App\Exception::where('id_user',$id_user)->first()->gift)}}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" tabindex="1">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ردیف</th>
                                <th scope="col">نوع پرداخت</th>
                                <th scope="col">بانک</th>
                                <th scope="col">شماره فیش / چک</th>
                                <th scope="col">مبلغ</th>
                                <th scope="col">پرداختی</th>
                                <th scope="col">تاریخ سررسید</th>
                                <th scope="col">تاریخ پرداخت</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">ویرایش</th>
                                <th scope="col">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agreement as $key=>$item)
                            <tr>
                                <th>{{++$key}}</th>
                                <th>{{$item->kind}}</th>
                                <th>{{$item->bank}}</th>
                                <th>{{$item->check}}</th>
                                <th>{{number_format($item->price)}}</th>
                                <th>{{number_format($item->pay)}}</th>
                                <th>{{$item->date}}</th>
                                <th>{{$item->payment}}</th>
                                @if($item->price!=$item->pay)
                                <th><a class="btn subForm btn-primary" style="background: #ba1a1a;border-color: #ba1a1a;color:#fff" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff">عدم پرداخت</a></th>
                                @else
                                @if($item->date>=$item->payment)
                                <th><a><button class="btn btn-primary">پرداخت شده</button></a></th>
                                @else
                                <th><a><button class="btn btn-primary" style="background:#97a109;border-color: #97a109;">پرداخت شده</button></a></th>
                                @endif
                                @endif
                                <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$key}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('update_agreement')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id_agreement" value="{{$item->id_agreement}}">
                                                    <div class="row">
                                                        <div class="col-md-12 mxt-2">
                                                            <label>تاریخ پرداخت</label>
                                                            <input type="text" class="form-control" name="date" value="{{jdate('Y/m/d')}}">
                                                        </div>
                                                        <div class="col-md-12 mxt-2">
                                                            <label>مبلغ پرداخت</label>
                                                            <input type="text" class="form-control" name="pay" value="{{number_format($item->price-$item->pay)}}" onkeyup="javascript:this.value=itpro(this.value);">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <button type="submit" class="btn btn-primary">ثبت اطلاعات</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal1{{$key}}" style="color:#fff"><i class="fa fa-edit (alias)"></i></td>
                                <div class="modal fade" id="myModal1{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$key}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('update_agreement')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="update" value="1">
                                                    <input type="hidden" name="id_agreement" value="{{$item->id_agreement}}">
                                                    <div class="row">
                                                        <div class="col-md-12 mxt-2">
                                                            <label>نوع پرداخت</label>
                                                            <select class="custom-select mb-3" name="kind" dir="rtl">
                                                            <option value="{{$item->kind}}">{{$item->kind}}</option>
                                                            @if($item->kind!="چک")
                                                                <option value="چک">چک</option>
                                                                @endif
                                                                @if($item->kind!="نقد")
                                                                <option value="نقد">نقد</option>
                                                                @endif
                                                                @if($item->kind!="تعهد پرداخت")
                                                                <option value="تعهد پرداخت">تعهد پرداخت</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mxt-2">
                                                            <label>تاریخ سر رسید</label>
                                                            <input type="text" class="form-control" name="date" value="{{$item->date}}">
                                                        </div>
                                                        <div class="col-md-12 mxt-2">
                                                            <label>تاریخ پرداخت</label>
                                                            <input type="text" class="form-control" name="payment" value="{{$item->payment}}">
                                                        </div>
                                                        <div class="col-md-12 mxt-2">
                                                            <label>مبلغ</label>
                                                            <input type="text" class="form-control" name="price" value="{{number_format($item->price)}}" onkeyup="javascript:this.value=itpro(this.value);">
                                                        </div>
                                                        <div class="col-md-12 mxt-2">
                                                            <label>پرداختی</label>
                                                            <input type="text" class="form-control" name="pay" value="{{number_format($item->pay)}}" onkeyup="javascript:this.value=itpro(this.value);">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <button type="submit" class="btn btn-primary">ثبت اطلاعات</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td><a class="btn subForm btn-primary" href="{{route('delete_agreement',['id_agreement'=> $item->id_agreement,'id_user'=> $id_user])}}" style="color:#fff;background: #db0909; border: 1px solid red;"><i class="fa fa-trash-o"></i></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{route('delete_agreement',['id_user'=> $id_user])}}"><button type="submit" class="btn btn-primary">دانلود فایل pdf</button></a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection