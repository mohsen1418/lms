<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">ثبت مورد اجرینه</div>

        <div class="card">
            <div class="card-body">

                <ul class="nav nav-pills flex-column flex-sm-row" id="myTab1" role="tablist">
                    <li class="flex-sm-fill text-sm-center nav-item">
                        <a class="nav-link show active" id="hometimeline-tab1" data-toggle="tab" href="#timeline1" role="tab" aria-controls="home" aria-selected="true">پرورشی</a>
                    </li>
                    <li class="flex-sm-fill text-sm-center nav-item">
                        <a class="nav-link show" id="photos-tab1" data-toggle="tab" href="#photos1" role="tab" aria-controls="profile" aria-selected="false">آموزشی</a>
                    </li>
                    <li class="flex-sm-fill text-sm-center nav-item">
                        <a class="nav-link show" id="followers-tab2" data-toggle="tab" href="#followers2" role="tab" aria-controls="followers" aria-selected="false">انضباطی</a>
                    </li>
                </ul>
                <div class="tab-content p-t-30" id="myTabContent1">
                    <div class="tab-pane fade active show" id="timeline1" role="tabpanel" aria-labelledby="timeline-tab1"> @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-with-border alert-dismissible" role="alert">
                            <i class="ti-help-alt m-l-10"></i>{{ $error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        @endforeach
                        @endif
                        <form action="{{route('insert_persuasion_item')}}" method="POST">
                            @csrf
                            <input name="date" value="{{time()}}" type="hidden" />
                            <div class="form-group">
                                <label for="exampleInputPassword1">نام دانش آموز</label>
                                <select class="js-example-basic-single" name="id_user" dir="rtl">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($all_user as $item)
                                    @if($item->id_room!=null)
                                    <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - کلاس "}}{{\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - پایه "}}{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">عنوان مورد</label>
                                <select class="js-example-basic-single" name="id_persuasion" dir="rtl">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($all_persuasion as $item)
                                    @if($item->kind=="اجرینه" AND $item->section=="پرورشی")
                                    <option value="{{$item->id_persuasion}}">{{$item->title}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">ثبت اجرینه</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="photos1" role="tabpanel" aria-labelledby="photos-tab1">
                        <div class="timeline">
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
                            <form action="{{route('insert_persuasion_item')}}" method="POST">
                                @csrf
                                <input name="date" value="{{time()}}" type="hidden" />
                                <div class="form-group">
                                    <label for="exampleInputPassword1">نام دانش آموز</label>
                                    <select class="js-example-basic-single" name="id_user" dir="rtl">
                                        <option value="">انتخاب کنید</option>
                                        @foreach($all_user as $item)
                                        @if($item->id_room!=null)
                                        <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - کلاس "}}{{\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                                        @else
                                        <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - پایه "}}{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                                        @endif @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">عنوان مورد</label>
                                    <select class="js-example-basic-single" name="id_persuasion" dir="rtl">
                                        <option value="">انتخاب کنید</option>
                                        @foreach($all_persuasion as $item)
                                        @if($item->kind=="اجرینه" AND $item->section=="آموزشی")
                                        <option value="{{$item->id_persuasion}}">{{$item->title}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">ثبت اجرینه</button>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="followers2" role="tabpanel" aria-labelledby="followers-tab">
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
                        <form action="{{route('insert_persuasion_item')}}" method="POST">
                            @csrf
                            <input name="date" value="{{time()}}" type="hidden" />
                            <div class="form-group">
                                <label for="exampleInputPassword1">نام دانش آموز</label>
                                <select class="js-example-basic-single" name="id_user" dir="rtl">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($all_user as $item)
                                    @if($item->id_room!=null)
                                    <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - کلاس "}}{{\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - پایه "}}{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                                    @endif @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">عنوان مورد</label>
                                <select class="js-example-basic-single" name="id_persuasion" dir="rtl">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($all_persuasion as $item)
                                    @if($item->kind=="اجرینه" AND $item->section=="انضباطی")
                                    <option value="{{$item->id_persuasion}}">{{$item->title}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">ثبت اجرینه</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">ثبت مورد زجرینه</div>
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-pills flex-column flex-sm-row" id="myTab2" role="tablist">
                    <li class="flex-sm-fill text-sm-center nav-item">
                        <a class="nav-link show active" id="hometimeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="home" aria-selected="true">پرورشی</a>
                    </li>
                    <li class="flex-sm-fill text-sm-center nav-item">
                        <a class="nav-link show" id="photos-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="profile" aria-selected="false">آموزشی</a>
                    </li>
                    <li class="flex-sm-fill text-sm-center nav-item">
                        <a class="nav-link show" id="followers-tab1" data-toggle="tab" href="#followers" role="tab" aria-controls="followers" aria-selected="false">انضباطی</a>
                    </li>
                </ul>

                <div class="tab-content p-t-30" id="myTabContent2">

                    <div class="tab-pane fade active show" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
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
                        <form action="{{route('insert_persuasion_item')}}" method="POST">
                            @csrf
                            <input name="date" value="{{time()}}" type="hidden" />
                            <div class="form-group">
                                <label for="exampleInputPassword1">نام دانش آموز</label>
                                <select class="js-example-basic-single" name="id_user" dir="rtl">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($all_user as $item)
                                    @if($item->id_room!=null)
                                    <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - کلاس "}}{{\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - پایه "}}{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">عنوان مورد</label>
                                <select class="js-example-basic-single" name="id_persuasion" dir="rtl">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($all_persuasion as $item)
                                    @if($item->kind=="زجرینه" AND $item->section=="پرورشی")
                                    <option value="{{$item->id_persuasion}}">{{$item->title}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">ثبت اجرینه</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                        <div class="timeline">
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
                            <form action="{{route('insert_persuasion_item')}}" method="POST">
                                @csrf
                                <input name="date" value="{{time()}}" type="hidden" />
                                <div class="form-group">
                                    <label for="exampleInputPassword1">نام دانش آموز</label>
                                    <select class="js-example-basic-single" name="id_user" dir="rtl">
                                        <option value="">انتخاب کنید</option>
                                        @foreach($all_user as $item)
                                        @if($item->id_room!=null)
                                        <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - کلاس "}}{{\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                                        @else
                                        <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - پایه "}}{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                                        @endif @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">عنوان مورد</label>
                                    <select class="js-example-basic-single" name="id_persuasion" dir="rtl">
                                        <option value="">انتخاب کنید</option>
                                        @foreach($all_persuasion as $item)
                                        @if($item->kind=="زجرینه" AND $item->section=="آموزشی")
                                        <option value="{{$item->id_persuasion}}">{{$item->title}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">ثبت اجرینه</button>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="followers" role="tabpanel" aria-labelledby="followers-tab"> @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-with-border alert-dismissible" role="alert">
                            <i class="ti-help-alt m-l-10"></i>{{ $error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        @endforeach
                        @endif
                        <form action="{{route('insert_persuasion_item')}}" method="POST">
                            @csrf
                            <input name="date" value="{{time()}}" type="hidden" />
                            <div class="form-group">
                                <label for="exampleInputPassword1">نام دانش آموز</label>
                                <select class="js-example-basic-single" name="id_user" dir="rtl">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($all_user as $item)
                                    @if($item->id_room!=null)
                                    <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - کلاس "}}{{\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - پایه "}}{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                                    @endif @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">عنوان مورد</label>
                                <select class="js-example-basic-single" name="id_persuasion" dir="rtl">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($all_persuasion as $item)
                                    @if($item->kind=="زجرینه" AND $item->section=="انضباطی")
                                    <option value="{{$item->id_persuasion}}">{{$item->title}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">ثبت اجرینه</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="alert alert-success" role="alert">آخرین موارد ثبت شده</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive" tabindex="1">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">نام</th>
                        <th scope="col">نام خانوادگی</th>
                        <th scope="col">عنوان</th>
                        <th scope="col">نوع</th>
                        <th scope="col">امتیاز</th>
                        <th scope="col">تاریخ</th>
                        <th scope="col">ثبت کننده</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_besharat as $key=>$item)
                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{\App\User::where('id',$item->id_user)->first()->fname}}</td>
                        <td>{{\App\User::where('id',$item->id_user)->first()->lname}}</td>
                        <td>{{\App\Persuasion::where('id_persuasion',$item->id_persuasion)->first()->title}}</td>
                        <td>{{\App\Persuasion::where('id_persuasion',$item->id_persuasion)->first()->kind}}</td>
                        <td>{{\App\Persuasion::where('id_persuasion',$item->id_persuasion)->first()->score}}</td>
                        <td>{{jdate('Y/m/d',$item->date)}}</td>
                        <td>{{$item->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection