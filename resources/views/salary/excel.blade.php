<?php include('jdf.php') ?>
@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">ورودی قرارداد با اکسل</div>
        <div class="card">
            <div class="card-body">
                <form action="{{route('insert_excel')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>آپلود فایل قرارداد</label>
                            <input class="form-control" type="file" name="photo" id="fileToUpload">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">آپلود فایل</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection