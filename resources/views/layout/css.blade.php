    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{DB::table('option')->where('name',"name_school")->first()->value}}</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/bundle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/clockpicker/bootstrap-clockpicker.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/datepicker-jalali/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/datepicker/daterangepicker.css') }}">
    <link rel="shortcut icon" href="https://lms.andishesafa.ir/ps2/admin/assets/media/image/logo.png">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="theme-color" content="#8dc63f" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>