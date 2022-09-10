        <?php include('jdf.php') ?>
        @extends('layout.app')
        @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">گزارش کلی مالی</div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                                    <i class="fa fa-user-o"></i>
                                </div>
                                <h3 class="font-weight-800 primary-font"></h3>
                                <p>تعداد دانش آموزان</p>
                                <p>{{App\User::where('role',4)->count()}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                                    <i class="fa fa-user-o"></i>
                                </div>
                                <h3 class="font-weight-800 primary-font"></h3>
                                <p>شهریه کل</p>
                                <p>{{number_format($sum)}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                                    <i class="fa fa-user-o"></i>
                                </div>
                                <h3 class="font-weight-800 primary-font"></h3>
                                <p>حداکثر تخفیف</p>
                                <p>{{number_format($sum*DB::table('option')->where('name',"off")->first()->value)}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                                    <i class="fa fa-user-o"></i>
                                </div>
                                <h3 class="font-weight-800 primary-font"></h3>
                                <p>تخفیف اختصاص یافته</p>
                                <p>{{number_format($off)}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                                    <i class="fa fa-user-o"></i>
                                </div>
                                <h3 class="font-weight-800 primary-font"></h3>
                                <p>تخفیف باقی مانده</p>
                                <p>{{number_format(($sum*DB::table('option')->where('name',"off")->first()->value)-$off)}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                                    <i class="fa fa-user-o"></i>
                                </div>
                                <h3 class="font-weight-800 primary-font"></h3>
                                <p>کمک های مردمی</p>
                                <p>{{number_format(DB::table('exception')->sum('gift'))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="icon-block icon-block-xl m-b-20 bg-info-gradient icon-block-floating">
                                    <i class="fa fa-user-o"></i>
                                </div>
                                <h3 class="font-weight-800 primary-font"></h3>
                                <p>تخفیف کل</p>
                                <p>{{substr(($off/$sum)*100, 0, 4)." %"}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">جزئیات گزارش مالی</div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" tabindex="1">
                        <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">شهریه</th>
                                        <th scope="col">مکمل آموزشی</th>
                                        <th scope="col">تابستان</th>
                                        <th scope="col">خدمات ویژه</th>
                                        <th scope="col">شهریه کل</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>{{number_format($sum_fee)}}</th>
                                        <th>{{number_format($sum_complete)}}</th>
                                        <th>{{number_format($sum_summer)}}</th>
                                        <th>{{number_format($sum_service)}}</th>
                                        <th>{{number_format($sum)}}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">گزارش مالی به تفکیک هر پایه</div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" tabindex="1">
                        <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ردیف</th>
                                        <th scope="col">پایه</th>
                                        <th scope="col">تعداد دانش آموز</th>
                                        <th scope="col">قرارداد</th>
                                        <th scope="col">شهریه</th>
                                        <th scope="col">مکمل آموزشی</th>
                                        <th scope="col">تابستان</th>
                                        <th scope="col">خدمات ویژه</th>
                                        <th scope="col">شهریه کل</th>
                                        <th scope="col">تخفیف اختصاص یافته</th>
                                        <th scope="col">کمک های مردمی</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paye as $key=>$item)
                                    <tr>
                                        <th scope="row">{{++$key}}</th>
                                        <th>{{$item->name}}</th>
                                        <th>{{App\User::where('id_paye',$item->id_paye)->count()}}</th>
                                        <th>{{App\Agreement::join('users','users.id','agreement.id_user')->select('agreement.id_user')->where('users.id_paye',$item->id_paye)->distinct('agreement.id_user')->count()}}</th>
                                        <th>{{number_format(App\Fee::where('id_paye',$item->id_paye)->first()->fee)}}</th>
                                        <th>{{number_format(App\Fee::where('id_paye',$item->id_paye)->first()->complete)}}</th>
                                        <th>{{number_format(App\Fee::where('id_paye',$item->id_paye)->first()->summer)}}</th>
                                        <th>{{number_format(App\Fee::where('id_paye',$item->id_paye)->first()->service)}}</th>
                                        <th>{{number_format(App\Fee::where('id_paye',$item->id_paye)->first()->total*App\User::where('id_paye',$item->id_paye)->where('role',4)->count())}}</th>
                                        <th>{{number_format(App\Exception::join('users','exception.id_user','users.id')->where('users.id_paye',$item->id_paye)->where('users.role',4)->sum('exception.normal')+App\Exception::join('users','exception.id_user','users.id')->where('users.id_paye',$item->id_paye)->where('users.role',4)->sum('exception.amount'))}}</th>
                                        <th>{{number_format(App\Exception::join('users','exception.id_user','users.id')->where('users.id_paye',$item->id_paye)->where('users.role',4)->sum('exception.gift'))}}</th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">گزارش میزان چک و مبلغ پرداختی</div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" tabindex="1">
                        <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">عنوان</th>
                                        <th scope="col">تعداد</th>
                                        <th scope="col" style="color: #006aff;">جمع کل</th>
                                        <th scope="col" style="color: #0cab62;">پرداخت شده</th>
                                        <th scope="col" style="color: #cd0f0f;">پرداخت نشده</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>پرداخت نقدی</th>
                                        <th>{{number_format(\App\Agreement::where('kind',"نقد")->count())}}</th>
                                        <th>{{number_format(\App\Agreement::where('kind',"نقد")->sum('price'))}}</th>
                                        <th>{{number_format(\App\Agreement::where('kind',"نقد")->sum('pay'))}}</th>
                                        <th>{{number_format(\App\Agreement::where('kind',"نقد")->sum('price')-\App\Agreement::where('kind',"نقد")->sum('pay'))}}</th>
                                    </tr>
                                    <tr>
                                        <th>چک</th>
                                        <th>{{number_format(\App\Agreement::where('kind',"چک")->count())}}</th>
                                        <th>{{number_format(\App\Agreement::where('kind',"چک")->sum('price'))}}</th>
                                        <th>{{number_format(\App\Agreement::where('kind',"چک")->sum('pay'))}}</th>
                                        <th>{{number_format(\App\Agreement::where('kind',"چک")->sum('price')-\App\Agreement::where('kind',"چک")->sum('pay'))}}</th>
                                    </tr>
                                    <tr>
                                        <th>تعهد پرداخت</th>
                                        <th>{{number_format(\App\Agreement::where('kind',"تعهد پرداخت")->count())}}</th>
                                        <th>{{number_format(\App\Agreement::where('kind',"تعهد پرداخت")->sum('price'))}}</th>
                                        <th>{{number_format(\App\Agreement::where('kind',"تعهد پرداخت")->sum('pay'))}}</th>
                                        <th>{{number_format(\App\Agreement::where('kind',"تعهد پرداخت")->sum('price')-\App\Agreement::where('kind',"تعهد پرداخت")->sum('pay'))}}</th>
                                    </tr>
                                    <tr>
                                        <th>جمع کل</th>
                                        <th>{{number_format(\App\Agreement::count())}}</th>
                                        <th>{{number_format(\App\Agreement::sum('price'))}}</th>
                                        <th>{{number_format(\App\Agreement::sum('pay'))}}</th>
                                        <th>{{number_format(\App\Agreement::sum('price')-\App\Agreement::sum('pay'))}}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">گزارش میزان واریزی و پرداختی</div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" tabindex="1">
                        <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">واریزی</th>
                                        <th scope="col">هزینه</th>
                                        <th scope="col">مجموع کل</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>{{number_format(\App\Cost::where('kind',0)->sum('rate'))}}</th>
                                        <th>{{number_format(\App\Cost::where('kind',1)->sum('rate'))}}</th>
                                        <th>{{number_format(\App\Cost::where('kind',0)->sum('rate')-\App\Cost::where('kind',1)->sum('rate'))}}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection