    <?php include('jdf.php') ?>
    @extends('layout.app')
    @section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success" role="alert">چاپ کارنامه مالی </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('report_salary')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="exampleInputPassword1">نام کلاس</label>
                                <select class="js-example-basic-single" name="id_room" dir="rtl" onchange="this.form.submit()">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($all_room as $item)
                                    <option value="{{$item->id_room}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(isset($id_room))
    @foreach($all_user as $user)
    <div class="alert alert-success" role="alert">قرارداد مالی {{\App\User::where('id',$user->id)->first()->fname." ".\App\User::where('id',$user->id)->first()->lname}}</div>
    @if(\App\Exception::where('id_user',$user->id)->where('status',1)->count()>0)
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agreement as $key=>$item)
                        @if($item->id_user==$user->id)
                        <tr>
                            <th>{{++$key}}</th>
                            <th>{{$item->kind}}</th>
                            <th>{{$item->bank}}</th>
                            <th>{{$item->check}}</th>
                            <th>{{number_format(floatval($item->price))}}</th>
                            <th>{{number_format(floatval($item->pay))}}</th>
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
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="table-responsive" tabindex="1">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">شهریه</th>
                            <th scope="col">تخفیف</th>
                            <th scope="col">پرداخت شده</th>
                            <th scope="col">پرداخت نشده</th>
                            <th scope="col">کمک های مردمی</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{{number_format(\App\Agreement::where('id_user',$user->id)->sum('price'))}}</th>
                            <th>{{number_format(\App\Exception::where('id_user',$user->id)->sum('amount')+\App\Exception::where('id_user',$user->id)->sum('normal'))}}</th>
                            <th>{{number_format(\App\Agreement::where('id_user',$user->id)->sum('pay'))}}</th>
                            <th>{{number_format(\App\Agreement::where('id_user',$user->id)->sum('price')-\App\Agreement::where('id_user',$user->id)->sum('pay'))}}</th>
                            @if(\App\Exception::where('id_user',$user->id)->count()>0)
                            <th>{{number_format(\App\Exception::where('id_user',$user->id)->first()->gift)}}</th>
                            @else
                            <th>0</th>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="{{route('report_print_salary',['id_user'=> $user->id])}}"><button type="submit" class="btn btn-primary" style="background: #3f76dc;border-color: #3f76dc;">پرینت کارنامه مالی</button></a>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body">
            <p style="text-align:center ;">هنوز قرار داد مالی دانش آموز وارد نشده است</p>
        </div>
    </div>
    @endif
    @endforeach
    @endif
    @endsection