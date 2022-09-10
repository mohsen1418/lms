<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">ثبت قرارداد مالی</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('add_agreement')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputPassword1">نام دانش آموز</label>
                            <select class="js-example-basic-single" name="id_user" dir="rtl" onchange="this.form.submit()">
                                <option value="">انتخاب کنید</option>
                                @foreach($exception as $item)
                                @if(\App\Agreement::where('id_user',$item->id_user)->count()<=0) <option value="{{$item->id_user}}">{{\App\User::where('id',$item->id_user)->first()->fname." ".\App\User::where('id',$item->id_user)->first()->lname." - ".\App\Paye::join('users','paye.id_paye','users.id_paye')->where('users.id',$item->id_user)->first()->name}}</option>
                                    @endif
                                    @endforeach
                            </select>
                        </div>
                    </div>
                </form>
                <div class="row">
                    @foreach($all_paye as $paye)
                    @foreach($all_room as $room)
                    @if($room->id_paye==$paye->id_paye)
                    <div class="col-md-6">
                        <div class="accordion accordion-primary custom-accordion" style="margin-bottom: 15px;">
                            <div class="accordion-row">
                                <a href="#" class="accordion-header">
                                    <span>{{$room->name}}</span>
                                    <i class="accordion-status-icon close fa fa-chevron-up"></i>
                                    <i class="accordion-status-icon open fa fa-chevron-down"></i>
                                </a>
                                <div class="accordion-body">
                                    <div class="table-responsive" tabindex="1">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">نام</th>
                                                    <th scope="col">نام خانوادگی</th>
                                                    <th scope="col">مبلغ پرداختی</th>
                                                    <th scope="col">قرارداد</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($all_user as $key=>$item)
                                                @if($room->id_room==$item->id_room)
                                                <tr>
                                                    <td>{{$item->fname}}</td>
                                                    <td>{{$item->lname}}</td>
                                                    @if(\App\Exception::where('id_user',$item->id)->count()>0)
                                                    <td><i class="fa fa-check-square-o" style="color:green"></i></td>
                                                    @else
                                                    <td><i class="fa fa fa-times" style="color:red"></i></td>
                                                    @endif
                                                    @if(\App\Agreement::where('id_user',$item->id)->count()>0)
                                                    <td><i class="fa fa-check-square-o" style="color:green"></i></td>
                                                    @else
                                                    <td><i class="fa fa fa-times" style="color:red"></i></td>
                                                    @endif
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
                    @endif
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@if(isset($id_user))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">جزئیات و متن قرارداد مالی</div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3">
                        <p style="text-align:center ;">شهریه</p>
                        <input type="text" class="form-control" value="{{number_format($price)}}" style="text-align:center;background-color: #b7c033;color: #fff;" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <p style="text-align:center ;">تخفیف اصلی</p>
                        <input type="text" class="form-control" value="{{number_format($normal)}}" style="text-align:center;background-color: #b7c033;color: #fff;" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <p style="text-align:center ;">تخفیف ویژه</p>
                        <input type="text" class="form-control" value="{{number_format($amount)}}" style="text-align:center;background-color: #b7c033;color: #fff;" disabled>
                    </div>
                    <div class="form-group col-md-3">
                        <p style="text-align:center ;">شهریه دریافتی</p>
                        <input type="text" class="form-control" value="{{number_format($price-($normal+$amount))}}" style="text-align:center;background-color: #b7c033;color: #fff;" disabled>
                    </div>
                </div>
                <br>
                <div class="alert alert-success" role="alert">نحوه پرداخت شهریه</div>
                <br>
                <div class="row">
                    <div class="form-group col-md-2">
                        <input type="text" class="form-control" value="ردیف" style="text-align:center;" disabled>
                        </small>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" class="form-control" value="نوع پرداخت" style="text-align:center;" disabled>
                        </small>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" class="form-control" value="تاریخ سررسید" style="text-align:center;" disabled>
                        </small>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" class="form-control" value="بانک" style="text-align:center;" disabled>
                        </small>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" class="form-control" value="شماره فیش / چک" style="text-align:center;" disabled>
                        </small>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" class="form-control" value="مبلغ" style="text-align:center;" disabled>
                        </small>
                    </div>
                </div>

                <form action="{{route('insert_agreement')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id_user" value="{{$id_user}}">
                    @for($i=1;$i<=($count+$month);$i++) <div class="row">
                        <div class="form-group col-md-2">
                            <input type="text" class="form-control" name="section[]" value="{{$i}}" style="text-align:center;">
                        </div>
                        <div class="form-group col-md-2">
                            <select class="custom-select mb-3" name="kind[]" dir="rtl">
                                <option value="چک">چک</option>
                                <option value="نقد">نقد</option>
                                <option value="تعهد پرداخت">تعهد پرداخت</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="date[]" class="form-control text-right" dir="ltr">
                        </div>
                        <div class="form-group col-md-2">
                            <select class="custom-select mb-3" name="bank[]" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                <option value="ملی">ملی</option>
                                <option value="ملت">ملت</option>
                                <option value="تجارت">تجارت</option>
                                <option value="صادرات">صادرات</option>
                                <option value="سپه">سپه</option>
                                <option value="رسالت">رسالت</option>
                                <option value="پارسیان">پارسیان</option>
                                <option value="پاسارگارد">پاسارگارد</option>
                                <option value="سامان">سامان</option>
                                <option value="شهر">شهر</option>
                                <option value="آینده">آینده</option>
                                <option value="مسکن">مسکن</option>
                                <option value="رفاه">رفاه</option>
                                <option value="کشاورزی">کشاورزی</option>
                                <option value="انصار">انصار</option>
                                <option value="گردشگری">گردشگری</option>
                                <option value="دی">دی</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <input type="number" class="form-control" name="check[]" style="text-align:center;">
                        </div>
                        <div class="form-group col-md-2">
                            <input type="text" class="form-control" name="price[]" style="text-align:center;" onkeyup="javascript:this.value=itpro(this.value);">
                        </div>
            </div>
            @endfor
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">کمک هزینه های مردمی</label>
                    <input type="text" class="form-control" name="gift" value="0" onkeyup="javascript:this.value=itpro(this.value);">
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">آپلود امضا اولیا</label>
                    <input class="form-control" type="file" name="photo" id="fileToUpload">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">ثبت قرارداد</button>
            <a href="{{route('fail',['id_exception'=> $item->id_exception])}}" style="background: #ab2424;border-color: #ab2424;color: #fff;padding: 6px 15px 6px 15px;border-radius: 3px;">فسخ قرارداد</a>
            </form>
        </div>
    </div>
</div>
</div>
@endif
@endsection