<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="alert alert-success" role="alert" >پیام رسان صفا آموز</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('show_chat')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputPassword1">نام دانش آموز</label>
                            <select class="js-example-basic-single" name="id_user" dir="rtl" onchange="submit().form">
                                <option value="">انتخاب کنید</option>
                                @foreach($all_user as $item)
                                @if(\App\Access::where('id_room',$item->id_room)->where('kind',1)->count()>0)
                                @if(\App\Room::where('id_room',$item->id_room)->count()>0)
                                <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - کلاس "}}{{\App\Room::where('id_room',$item->id_room)->first()->name}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->fname." ".$item->lname." - "}}{{\App\Paye::where('id_paye',$item->id_paye)->first()->name}}</option>
                                @endif
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                        @foreach($msg as $item)
                        <a href="{{route('show_chat',['id_user'=> $item->sender])}}"><button type="button" class="btn btn-primary btn-rounded" style="background: #d83939;border-color: #d83939;">{{\App\User::where('id',$item->sender)->first()->fname." ".\App\User::where('id',$item->sender)->first()->lname." - ".\App\Paye::join('users','paye.id_paye','users.id_paye')->where('users.id',$item->sender)->first()->name}}</button></a>
                        @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(isset($id_user))
<div class="alert alert-success" role="alert" >آرشیو پیام های گذشته</div>
<div class="card chat-app-wrapper">
    <div class="row chat-app">
        <div class="col-lg-12 chat-body">
            <div class="chat-body-header">
                <div>
                    <figure class="avatar avatar-sm m-l-10">
                        <img src="https://cdn-icons-png.flaticon.com/512/147/147142.png" class="rounded-circle">
                    </figure>
                </div>
                <div>
                    <h6 class="m-b-0 primary-font">{{$id_user->fname." ".$id_user->lname."   "}}
                        @if(\App\Room::where('id_room',$id_user->id_room)->count()>0)
                        <i class="small text-success" style="color: #1b7866 !important;">کلاس {{\App\Room::where('id_room',$id_user->id_room)->first()->name}}</i>
                        @else
                        <i class="small text-success" style="color: #1b7866 !important;">{{\App\Paye::where('id_paye',$id_user->id_paye)->first()->name}}</i>
                        @endif
                    </h6>
                </div>
            </div>
            <div id="show" class="chat-body-messages" tabindex="8" style="overflow: hidden; outline: none; touch-action: none;">
                <div class="message-items">
                    @foreach($chat as $item)
                    @if($item->sender==Auth::user()->id && $item->receiver==$id_user->id)
                    <div class="message-item">{{$item->msg}}
                        <small class="message-item-date text-muted">{{jdate('Y/m/d',$item->time)}}</small>
                    </div>
                    @elseif($item->receiver==Auth::user()->id && $item->sender==$id_user->id)
                    <div class="message-item outgoing-message">{{$item->msg}}
                        <small class="message-item-date text-muted">{{jdate('Y/m/d',$item->time)}}</small>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="chat-body-footer">
                <form id="myForm" action="{{route('insert_chat')}}" method="POST" class="d-flex align-items-center btn-submit" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="receiver" value="{{$id_user->id}}">
                    <input type="text" name="msg" class="form-control" placeholder="پیام ...">
                    <div class="d-flex">
                        <button class="mr-3 btn btn-primary btn-floating" style="background: #e21668;border-color: #e21668;">
                            <i class="fa fa-send"></i>
                        </button>
                    </div>
                </form>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@endif
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".btn-submit").submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        console.log(data);
        var url = '{{DB::table('option')->where('name','site')->first()->value}}/chat/insert';

        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            success: function(response) {
                if (response.success) {
                    alert(response.message)
                } else {
                    location.reload();
                    document.getElementById("myForm").reset();
                }
            },
            error: function(error) {
                console.log(error)
            }
        });
    });
</script>

@endsection