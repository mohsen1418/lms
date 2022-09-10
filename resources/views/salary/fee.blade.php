<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">تعریف میزان شهریه</div>
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
                <form action="{{route('insert_fee')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1">نام پایه</label>
                            <select class="js-example-basic-single" name="id_paye" dir="rtl">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_paye as $item)
                                <option value="{{$item->id_paye}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">شهریه</label>
                            <input type="text" class="form-control" name="fee" onkeyup="javascript:this.value=itpro(this.value);">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">مکمل آموزشی</label>
                            <input type="text" class="form-control" name="complete" onkeyup="javascript:this.value=itpro(this.value);">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">تابستان</label>
                            <input type="text" class="form-control" name="Summer" onkeyup="javascript:this.value=itpro(this.value);">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">خدمات ویژه</label>
                            <input type="text" class="form-control" name="service" onkeyup="javascript:this.value=itpro(this.value);">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن اطلاعات</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="alert alert-success" role="alert">مشاهده لیست شهریه</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
        <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام پایه</th>
                        <th scope="col">شهریه</th>
                        <th scope="col">مکمل آموزشی</th>
                        <th scope="col">تابستان</th>
                        <th scope="col">خدمات ویژه</th>
                        <th scope="col">شهریه کل</th>
                        <th scope="col">ویرایش</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row = 0; ?>
                    @foreach ($fee as $key=>$item)
                    <tr>
                        <th scope="row">{{++$row}}</th>
                        <td>{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</td>
                        <td>{{number_format($item->fee)}}</td>
                        <td>{{number_format($item->complete)}}</td>
                        <td>{{number_format($item->summer)}}</td>
                        <td>{{number_format($item->service)}}</td>
                        <td>{{number_format($item->total)}}</td>
                        <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff"><i class="fa fa-edit (alias)"></i></td>
                        <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('update_fee')}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="id_fee" value="{{$item->id_fee}}">
                                            <div class="row">
                                                <div class="col-md-12 mxt-2">
                                                    <label>شهریه</label>
                                                    <input type="text" class="form-control" name="fee" value="{{number_format($item->fee)}}" onkeyup="javascript:this.value=itpro(this.value);">
                                                </div>
                                                <div class="col-md-12 mxt-2">
                                                    <label>مکمل آموزشی</label>
                                                    <input type="text" class="form-control" name="complete" value="{{number_format($item->complete)}}" onkeyup="javascript:this.value=itpro(this.value);">
                                                </div>
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>تابستان</label>
                                                    <input type="text" class="form-control" name="summer" value="{{number_format($item->summer)}}" onkeyup="javascript:this.value=itpro(this.value);">
                                                </div>
                                                <div class="col-md-12 mxt-2 m-t-10">
                                                    <label>خدمات ویژه</label>
                                                    <input type="text" class="form-control" name="service" value="{{number_format($item->service)}}" onkeyup="javascript:this.value=itpro(this.value);">
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
                        <td><a class="btn subForm btn-primary" href="{{route('delete_fee',['id_fee'=> $item->id_fee])}}" style="color:#fff;background: #db0909; border: 1px solid red;"><i class="fa fa-trash-o"></i></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection