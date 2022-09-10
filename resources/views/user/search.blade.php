<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">جستجو دانش آموزان</div>
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
                <form action="{{route('search_user')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">نام دانش آموز</label>
                        <select class="js-example-basic-single" name="id_user" dir="rtl" onchange="this.form.submit()">
                            @if(isset($select_user))
                            <option value="{{$select_user->id}}">{{\App\User::where('id',$select_user->id)->first()->fname." ".\App\User::where('id',$select_user->id)->first()->lname." - کلاس "}}{{\App\Paye::where('id_paye',$select_user->id_paye)->first()->name}}</option>
                            @else
                            <option value="">انتخاب کنید</option>
                            @endif
                            @foreach($all_user as $ky=>$item)
                            <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - کلاس "}}{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($select_user))
<div class="alert alert-success" role="alert">پرونده دانش آموزی {{\App\User::where('id',$select_user->id)->first()->fname." ".\App\User::where('id',$select_user->id)->first()->lname}}</div>
<div class="card">
    <div class="card-body">

        <ul class="nav nav-pills flex-column flex-sm-row" id="myTab" role="tablist">
            <li class="flex-sm-fill text-sm-center nav-item">
                <a class="nav-link show active" id="hometimeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="home" aria-selected="true">اطلاعات فردی</a>
            </li>
            <li class="flex-sm-fill text-sm-center nav-item">
                <a class="nav-link show" id="photos-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="profile" aria-selected="false">پیام ها <span style="    background: #d80c0c;padding: 0px 8px 0px 8px;border-radius: 53px;color: #fff;">{{\App\Sms::where('id_user',$select_user->id)->count()}}</span></a>
            </li>
            <li class="flex-sm-fill text-sm-center nav-item">
                <a class="nav-link show" id="followers-tab1" data-toggle="tab" href="#followers" role="tab" aria-controls="followers" aria-selected="false">موارد انضباطی <span style="    background: #d80c0c;padding: 0px 8px 0px 8px;border-radius: 53px;color: #fff;">{{\App\Enzebati::where('id_user',$select_user->id)->count()}}</span></a>
            </li>
            <li class="flex-sm-fill text-sm-center nav-item">
                <a class="nav-link show" id="earnings-tab" data-toggle="tab" href="#earnings" role="tab" aria-controls="earnings" aria-selected="false">مشاورات <span style="    background: #d80c0c;padding: 0px 8px 0px 8px;border-radius: 53px;color: #fff;">{{\App\Consultant::where('id_user',$select_user->id)->count()}}</span></a>
            </li>
            <li class="flex-sm-fill text-sm-center nav-item">
                <a class="nav-link show" id="earnings-ta" data-toggle="tab" href="#earning" role="tab" aria-controls="earnings" aria-selected="false">آمار ورود <span style="    background: #d80c0c;padding: 0px 8px 0px 8px;border-radius: 53px;color: #fff;">{{\App\Statistic::where('id_user',$select_user->id)->count()}}</span></a>
            </li>
            <li class="flex-sm-fill text-sm-center nav-item">
                <a class="nav-link show" id="earnings-ta1" data-toggle="tab" href="#earning1" role="tab" aria-controls="earnings1" aria-selected="false">تکالیف <span style="    background: #d80c0c;padding: 0px 8px 0px 8px;border-radius: 53px;color: #fff;">{{\App\Trouble::where('id_user',$select_user->id)->count()}}</span></a>
            </li>
        </ul>

        <div class="tab-content p-t-30" id="myTabContent">

            <div class="tab-pane fade active show" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">نام </label>
                        <input type="text" class="form-control" name="fname" value="{{$select_user->fname}}" disabled>
                        </small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">نام خانوادگی</label>
                        <input type="text" class="form-control" name="lname" value="{{$select_user->lname}}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">نام پایه</label>
                        <input type="text" class="form-control" name="lname" value="{{\App\Paye::where('id_paye',$select_user->id_paye)->first()->name}}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">نام کلاس</label>
                        @if($select_user->id_room!="")
                        <input type="text" class="form-control" name="lname" value="{{\App\Room::where('id_room',$select_user->id_room)->first()->name}}" disabled>
                        @else
                        <input type="text" class="form-control" name="lname" value="بدون کلاس" disabled>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">نام کاربری</label>
                        <input type="number" class="form-control" name="mobile" value="{{$select_user->mobile}}" disabled>
                        </small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">گذرواژه</label>
                        <input type="number" class="form-control" name="mobile" value="{{$select_user->pass}}" disabled>
                        </small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">شماره پدر</label>
                        <input type="number" class="form-control" name="mobile" value="{{$select_user->f_number}}" disabled>
                        </small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">شماره مادر</label>
                        <input type="number" class="form-control" name="mobile" value="{{$select_user->m_number}}" disabled>
                        </small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">شماره ولی پیگیر</label>
                        <input type="number" class="form-control" name="mobile" value="{{$select_user->p_number}}" disabled>
                        </small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">شماره منزل</label>
                        <input type="number" class="form-control" name="tel" value="{{$select_user->tel}}" disabled>
                        </small>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                <div class="timeline">
                    @foreach($all_message as $key=>$item)
                    <div class="timeline-item">
                        <div>
                            <figure class="avatar avatar-sm m-l-15 bring-forward">
                                <span class="avatar-title bg-danger rounded-circle">{{++$key}}</span>
                            </figure>
                        </div>
                        <div>
                            <p class="primary-font" style="color: #424040;margin-top: 6px;text-align: justify;line-height: 30px;font-weight: 300;">{{$item->msg}}</p>
                            <small class="text-muted">
                                <i class="fa fa-clock-o m-l-5"></i> {{jdate("Y/m/d",$item->date)}}
                            </small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="tab-pane fade" id="followers" role="tabpanel" aria-labelledby="followers-tab">
                <div class="table-responsive" tabindex="1">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام</th>
                                <th scope="col">نام خانوادگی</th>
                                <th scope="col">عنوان مورد</th>
                                <th scope="col">تاریخ</th>
                                <th scope="col">نمره کسر شده</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_enzebati as $key=>$item)
                            <tr>
                                <th scope="row">{{++$key}}</th>
                                <td>{{\App\User::where('id',$item->id_user)->first()->fname}}</td>
                                <td>{{\App\User::where('id',$item->id_user)->first()->lname}}</td>
                                <td>{{\App\Discipline::where('id_discipline',$item->id_discipline)->first()->name}}</td>
                                <td>{{\App\Enzebati::where('id_enzebati',$item->id_enzebati)->first()->date}}</td>
                                <td>{{\App\Discipline::where('id_discipline',$item->id_discipline)->first()->score}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="earnings" role="tabpanel" aria-labelledby="earnings-tab">
                <div class="table-responsive" tabindex="1">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام</th>
                                <th scope="col">نام خانوادگی</th>
                                <th scope="col">افراد حاضر در جلسه</th>
                                <th scope="col">نوع جلسه</th>
                                <th scope="col">زمان جلسه به دقیقه</th>
                                <th scope="col">تاریخ</th>
                                <th scope="col">خلاصه جلسه</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_consultant as $key=>$item)
                            <tr>
                                <th scope="row">{{++$key}}</th>
                                <td>{{\App\User::where('id',$item->id_user)->first()->fname}}</td>
                                <td>{{\App\User::where('id',$item->id_user)->first()->lname}}</td>
                                <td>{{$item->Present}}</td>
                                <td>{{$item->kind}}</td>
                                <td>{{$item->time}}</td>
                                <td>{{$item->date}}</td>
                                <td><a class="btn subForm btn-primary" data-toggle="modal" data-target="#myModal{{$key}}" style="color:#fff">مشاهده</td>
                                <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                خلاصه جلسه
                                                <div class="form-group">
                                                    <textarea style="margin-top:10px" disabled name="text" class="form-control" rows="10">{{$item->text}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="earning" role="tabpanel" aria-labelledby="earnings-ta">
                <div class="table-responsive" tabindex="1">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">تاریخ</th>
                                <th scope="col">زمان</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($statistic as $key=>$item)
                            <tr>
                                <th scope="row">{{++$key}}</th>
                                <td>{{jdate("Y/m/d",$item->date_in)}}</td>
                                <td>{{jdate("H:i:s",$item->date_in)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="earning1" role="tabpanel" aria-labelledby="earnings-ta1">
                <div class="table-responsive" tabindex="1">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">درس</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">شروع</th>
                                <th scope="col">پایان</th>
                                <th scope="col">نمره</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_trouble as $key=>$item)
                            <tr>
                                <th scope="row">{{++$key}}</th>
                                <th scope="row">{{\App\Course::where('id_course',$item->id_course)->first()->name}}</th>
                                <th scope="row">{{\App\Homework::where('id_homework',$item->id_homework)->first()->title}}</th>
                                <th scope="row">{{$item->clock1." ".$item->date1}}</th>
                                <th scope="row">{{$item->clock2." ".$item->date2}}</th>
                                <th scope="row">{{$item->score}}</th>
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