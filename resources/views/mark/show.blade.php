    <?php include('jdf.php') ?>
    @extends('layout.app')
    @section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success" role="alert">مشاهده نمره کلاسی</div>
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
                    <form action="{{route('show_mark')}}" method="POST">
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
                                <label for="exampleInputEmail1">تاریخ شروع</label>
                                <input type="text" name="date1" data-input-mask="date1" class="form-control text-right" value="{{jdate('Y/m/d')}}" dir="ltr" maxlength="10" autocomplete="off">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">تاریخ پایان</label>
                                <input type="text" name="date2" data-input-mask="date2" class="form-control text-right" value="{{jdate('1402/02/30')}}" dir="ltr" maxlength="10" autocomplete="off">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">نمایش اطلاعات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(isset($id_course))
    <div class="alert alert-success" role="alert">نمرات درس {{\App\Course::where('id_course',$id_course)->first()->name}} - کلاس {{\App\Room::where('id_room',$id_room)->first()->name}}</div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive" tabindex="1">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ردیف</th>
                            <th scope="col">نام و نام خانوادگی</th>
                            @foreach($all_date as $key=>$item)
                            <th scope="col" data-toggle="tooltip" data-placement="top" data-original-title="{{\App\Mark::where('date',$item->date)->where('id_course',$id_course)->first()->detail}}">{{$item->date}} <a data-toggle="modal" data-target="#myModal{{$key}}"><i class="fa fa fa-edit (alias)" style="color:green"></i></a> <a href="{{route('delete_mark',['id_course'=> $id_course,'date'=> $item->date])}}"><i class="fa fa fa-trash" style="color:red"></i></a></th>
                            <div class="modal fade" id="myModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('update_mark')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_course" value="{{$id_course}}">
                                                <input type="hidden" name="date" value="{{$item->date}}">
                                                <div class="row">
                                                    @foreach ($all_user as $key=>$user)
                                                    <input type="hidden" name="id_user[]" value="{{$user->id}}">
                                                    <div class="col-md-12 mxt-2 m-t-10">
                                                        <label>{{$user->fname." ".$user->lname}}</label>
                                                        @if(\App\Mark::where('id_user',$user->id)->where('date',$item->date)->where('id_course',$id_course)->count()>0)
                                                        <input type="text" class="form-control" name="mark[]" value="{{\App\Mark::where('id_user',$user->id)->where('date',$item->date)->where('id_course',$id_course)->first()->mark}}">
                                                        @else
                                                        <input type="text" class="form-control" name="mark[]">
                                                        @endif
                                                    </div>
                                                    @endforeach
                                                    <div class="col-md-12 mt-3">
                                                        <button type="submit" class="btn btn-primary">ویرایش اطلاعات</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_user as $key=>$item)
                        <tr>
                            <th scope="row">{{++$key}}</th>
                            <td>{{$item->fname." ".$item->lname}}</td>
                            @foreach($all_date as $date)
                            @if(\App\Mark::where('id_user',$item->id)->where('id_course',$id_course)->where('id_course',$id_course)->where('date',$date->date)->count()>0)
                            @if(\App\Mark::where('id_user',$item->id)->where('id_course',$id_course)->where('id_course',$id_course)->where('date',$date->date)->first()->mark=="مثبت")
                            <td><i class="fa  fa-plus-square" style="color: green;"></i></td>
                            @elseif(\App\Mark::where('id_user',$item->id)->where('id_course',$id_course)->where('id_course',$id_course)->where('date',$date->date)->first()->mark=="منفی")
                            <td><i class="fa fa-minus-square" style="color: red;"></i></td>
                            @else
                            <td>{{\App\Mark::where('id_user',$item->id)->where('id_course',$id_course)->where('id_course',$id_course)->where('date',$date->date)->first()->mark}}</td>
                            @endif
                            @else
                            <td></td>
                            @endif

                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
    @endsection