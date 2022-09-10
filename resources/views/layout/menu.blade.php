<div class="side-menu">
    <div class="side-menu-body">
        <ul>
            <li class="side-menu-divider">فهرست</li>
            <li><a href="{{route('home')}}"><i class="icon fa fas fa-home"></i> <span>داشبورد</span> </a></li>
            @if(\App\Role::role()->course_paye==1 || \App\Role::role()->course_class==1 || \App\Role::role()->course_learn==1 || \App\Role::role()->course_total==1)
            <li><a><i class="icon fa fad fa-tasks"></i> <span>مدیریت دروس</span> </a>
                <ul>
                    @if(\App\Role::role()->course_paye==1)
                    <li><a href="{{route('add_paye')}}"><span>پایه</span> </a></li>
                    @endif
                    @if(\App\Role::role()->course_class==1)
                    <li><a href="{{route('add_room')}}"><span>کلاس</span> </a></li>
                    @endif
                    @if(\App\Role::role()->course_learn==1)
                    <li><a href="{{route('add_course')}}"><span>درس</span> </a></li>
                    @endif
                    @if(\App\Role::role()->course_total==1)
                    <li><a href="{{route('class_user')}}"><span>کلاس بندی</span> </a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if(\App\Role::role()->student_add==1 || \App\Role::role()->student_show==1 || \App\Role::role()->student_search==1 || \App\Role::role()->student_img==1 || \App\Role::role()->student_excel==1)
            <li><a><i class="icon fa fa-user-o"></i> <span>دانش آموزان</span> </a>
                <ul>
                    @if(\App\Role::role()->student_add==1)
                    <li><a href="{{route('add_user')}}"><span>افزودن</span> </a></li>
                    @endif
                    @if(\App\Role::role()->student_show==1)
                    <li><a href="{{route('show_user')}}"><span>مشاهده</span> </a></li>
                    @endif
                    @if(\App\Role::role()->student_search==1)
                    <li><a href="{{route('search_user')}}"><span>جستجو</span> </a></li>
                    @endif
                    @if(\App\Role::role()->student_img==1)
                    <li><a href="{{route('album')}}"><span>آلبوم عکس</span> </a></li>
                    @endif
                    @if(\App\Role::role()->student_excel==1)
                    <li><a><span>اکسل</span> </a>
                        <ul>
                            <li><a href="{{route('import_show_user')}}"><span>ورودی</span> </a></li>
                            <li><a href="{{route('user_export')}}"><span>خروجی</span> </a></li>
                        </ul>
                    </li>
                    @endif
                    @if(\App\Role::role()->student_pass==1)
                    <li><a href="{{route('pass_user')}}"><span>چاپ شناسه</span> </a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if(\App\Role::role()->mali_time==1 || \App\Role::role()->mali_fee==1 || \App\Role::role()->mali_rebate==1 || \App\Role::role()->mali_agreement==1 || \App\Role::role()->mali_result==1 || \App\Role::role()->mali_report==1 || \App\Role::role()->mali_cost==1 )
            <li><a><i class="icon fa fa-credit-card-alt"></i> <span>امور مالی</span> </a>
                <ul>
                    @if(\App\Role::role()->mali_time==1)
                    <li><a href="{{route('add_time')}}"><span>زمان بندی</span></a></li>
                    @endif
                    @if(\App\Role::role()->mali_fee==1)
                    <li><a href="{{route('add_fee')}}"><span>شهریه</span></a></li>
                    @endif
                    @if(\App\Role::role()->mali_rebate==1)
                    <li><a href="{{route('add_rebate')}}"><span>تخفیف و اقساط</span></a></li>
                    @endif
                    @if(\App\Role::role()->mali_agreement==1)
                    <li><a href="{{route('add_exception')}}"><span>مبلغ پرداختی</span></a></li>
                    @endif
                    @if(\App\Role::role()->mali_result==1)
                    <li><a><span>قرارداد</span></a>
                        <ul>
                            <li><a href="{{route('add_agreement')}}"><span>افزودن</span></a></li>
                            <li><a href="{{route('show_agreement')}}"><span>مشاهده</span></a></li>
                            <li><a href="{{route('excel_agreement')}}"><span>ورودی اکسل</span></a></li>
                        </ul>
                    </li>
                    @endif
                    @if(\App\Role::role()->mali_result==1)
                    <li><a><span>گزارش</span></a>
                        <ul>
                            <li><a href="{{route('show_salary_result')}}"><span>جامع</span></a></li>
                            <li><a href="{{route('date_result')}}"><span>زمانی</span></a></li>
                            <li><a href="{{route('total_salary')}}"><span>دانش آموزی</span></a></li>
                            <li><a href="{{route('debtor_salary')}}"><span>بدهکاران</span></a></li>
                        </ul>
                    </li>
                    @endif
                    @if(\App\Role::role()->mali_report==1)
                    <li><a href="{{route('report_salary')}}"><span>کارنامه فردی</span></a></li>
                    @endif
                    @if(\App\Role::role()->mali_cost==1)
                    <li>
                        <a><span>دخل و خرج</span></a>
                        <ul>
                            <li><a href="{{route('salary_cost_in')}}"><span>واریزی</span></a></li>
                            <li><a><span>هزینه</span></a>
                                <ul>
                                    <li><a href="{{route('salary_cost_out')}}"><span>ثبت</span></a></li>
                                    <li><a href="{{route('salary_cost_out_show')}}"><span>مشاهده</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if(\App\Role::role()->film_add==1 || \App\Role::role()->film_show==1 || \App\Role::role()->film_report==1 || \App\Role::role()->film_view==1)
            <li><a><i class="icon ti-blackboard"></i> <span>فیلم ها</span> </a>
                <ul>
                    @if(\App\Role::role()->film_add==1)
                    <li><a href="{{route('add_film')}}"><span>افزودن</span> </a></li>
                    @endif
                    @if(\App\Role::role()->film_show==1)
                    <li><a href="{{route('show_film')}}"><span>مشاهده</span> </a></li>
                    @endif
                    @if(\App\Role::role()->film_report==1)
                    <li><a href="{{route('report_film')}}"><span>گزارش</span> </a></li>
                    @endif
                    @if(\App\Role::role()->film_view==1)
                    <li><a href="{{route('statistic_film')}}"><span>آمار بازدید</span> </a></li>
                    @endif
                </ul>
            </li>
            @endif
            <!--
            <li><a><i class="icon fa fa-envelope"></i> <span>تابلو اعلانات</span> </a>
                <ul>
                    <li><a href="{{route('send_message')}}"><span>ارسال</span> </a></li>
                    <li><a href="{{route('show_message')}}"><span>مشاهده</span> </a></li>
                </ul>
            </li>
            !-->
            @if(\App\Role::role()->manager_teacher==1 || \App\Role::role()->manager_personnel==1)
            <li><a><i class="icon fa fa-users"></i> <span>کاربران</span> </a>
                <ul>
                    @if(\App\Role::role()->manager_teacher==1)
                    <li><a href="{{route('add_teacher')}}"><span>دبیر</span> </a></li>
                    @endif
                    @if(\App\Role::role()->manager_personnel==1)
                    <li><a href="{{route('add_employe')}}"><span>کادر</span> </a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if(\App\Role::role()->discipline_role==1 || \App\Role::role()->discipline_person==1 || \App\Role::role()->discipline_group==1 || \App\Role::role()->discipline_report==1)
            <li><a><i class="icon ti-face-sad"></i> <span>انضباطی</span> </a>
                <ul>
                    @if(\App\Role::role()->discipline_role==1)
                    <li><a href="{{route('add_role')}}"><span>قوانین</span> </a></li>
                    @endif
                    <li><a><span>ثبت مورد</span> </a>
                        <ul>
                            @if(\App\Role::role()->discipline_person==1)
                            <li><a href="{{route('add_discipline_person')}}"><span>فردی</span> </a></li>
                            @endif
                            @if(\App\Role::role()->discipline_group==1)
                            <li><a href="{{route('add_discipline')}}"><span>گروهی</span> </a></li>
                            @endif
                        </ul>
                    </li>
                    @if(\App\Role::role()->discipline_report==1)
                    <li><a href="{{route('show_discipline')}}"><span>گزارش</span> </a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if(\App\Role::role()->consultant_add==1 || \App\Role::role()->consultant_show==1)
            <li><a><i class="icon ti-book"></i> <span>مشاورات</span> </a>
                <ul>
                    @if(\App\Role::role()->consultant_add==1)
                    <li><a href="{{route('add_consultant')}}"><span>افزودن</span> </a></li>
                    @endif
                    @if(\App\Role::role()->consultant_show==1)
                    <li><a href="{{route('report_consultant')}}"><span>گزارش</span> </a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if(\App\Role::role()->sms_person==1 || \App\Role::role()->sms_group==1 || \App\Role::role()->sms_sample==1 || \App\Role::role()->sms_cadre==1 || \App\Role::role()->sms_charge==1 || \App\Role::role()->sms_show==1)
            <li><a><i class="icon  fa fa-mobile"></i> <span>پیامک</span> </a>
                <ul>
                    @if(\App\Role::role()->sms_person==1)
                    <li><a href="{{route('send_sms')}}"><span>فردی</span> </a></li>
                    @endif
                    @if(\App\Role::role()->sms_group==1)
                    <li><a href="{{route('send_class')}}"><span>گروهی</span></a></li>
                    @endif
                    @if(\App\Role::role()->sms_sample==1)
                    <li><a href="{{route('add_msg')}}"><span>نمونه پیام</span></a></li>
                    @endif
                    @if(\App\Role::role()->sms_cadre==1)
                    <li><a href="{{route('send_sms_cadre')}}"><span>کادر</span></a></li>
                    @endif
                    @if(\App\Role::role()->sms_show==1)
                    <li><a href="{{route('show_sms')}}"><span>نمایش</span></a></li>
                    @endif
                    @if(\App\Role::role()->sms_charge==1)
                    <li><a href="{{route('charge')}}"><span>شارژ</span></a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if(\App\Role::role()->mark_add==1 || \App\Role::role()->mark_show==1)
            <li><a><i class="icon  fa fa-pencil"></i> <span>نمره کلاسی</span> </a>
                <ul>
                    @if(\App\Role::role()->mark_add==1 )
                    <li><a href="{{route('add_mark')}}"><span>ثبت</span> </a></li>
                    @endif
                    @if(\App\Role::role()->mark_add==1 )
                    <li><a href="{{route('show_mark')}}"><span>مشاهده</span> </a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if(\App\Role::role()->study_person==1 || \App\Role::role()->study_group==1 || \App\Role::role()->study_daily==1 || \App\Role::role()->study_mounthly==1)
            <li><a><i class="icon  fa fa-clock-o"></i> <span>ساعت مطالعه</span> </a>
                <ul>
                    <li><a><span>الگو</span> </a>
                        <ul>
                            @if(\App\Role::role()->study_person==1)
                            <li><a href="{{route('add_study_person')}}"><span>فردی</span> </a></li>
                            @endif
                            @if(\App\Role::role()->study_group==1)
                            <li><a href="{{route('add_study_group')}}"><span>گروهی</span> </a></li>
                            @endif
                        </ul>
                    </li>
                    <li><a><span>گزارش</span> </a>
                        <ul>
                            @if(\App\Role::role()->study_daily==1)
                            <li><a href="{{route('study_daily')}}"><span>روزانه</span> </a></li>
                            @endif
                            <li><a href="{{route('study_weekly')}}"><span>هفتگی</span> </a></li>
                            @if(\App\Role::role()->study_mounthly==1)
                            <li><a href="{{route('study_mounthly')}}"><span>ماهیانه</span> </a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </li>
            @endif
            @if(\App\Role::role()->homework_add==1 || \App\Role::role()->homework_show==1 || \App\Role::role()->homework_report==1 || \App\Role::role()->homework_card==1)
            <li><a><i class="icon ti-book"></i> <span>تکالیف</span> </a>
                <ul>
                    @if(\App\Role::role()->homework_add==1)
                    <li><a href="{{route('add_homework')}}"><span>افزودن</span> </a></li>
                    @endif
                    @if(\App\Role::role()->homework_show==1)
                    <li><a href="{{route('show_homework')}}"><span>مشاهده</span> </a></li>
                    @endif
                    @if(\App\Role::role()->homework_report==1)
                    <li><a href="{{route('report_homework')}}"><span>گزارش جامع</span> </a></li>
                    @endif
                    @if(\App\Role::role()->homework_card==1)
                    <li><a href="{{route('person_homework')}}"><span>کارنامه فردی</span> </a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if(\App\Role::role()->besharat_role==1 || \App\Role::role()->besharat_insert==1 || \App\Role::role()->besharat_report==1 )
            <li><a><i class="icon ti-face-sad"></i> <span>بشارت</span> </a>
                <ul>
                    @if(\App\Role::role()->besharat_role==1)
                    <li><a href="{{route('add_persuasion')}}"><span>قوانین</span> </a></li>
                    @endif
                    @if(\App\Role::role()->besharat_insert==1)
                    <li><a href="{{route('add_persuasion_item')}}"><span>ثبت مورد</span> </a></li>
                    @endif
                    @if(\App\Role::role()->besharat_report==1)
                    <li><a><span>گزارش گیری</span> </a>
                        <ul>
                            <li><a href="{{route('Personal_persuasion')}}"><span>فردی</span> </a></li>
                            <li><a href="{{route('class_persuasion')}}"><span>کلاسی</span> </a></li>
                            <li><a href="{{route('paye_persuasion')}}"><span>پایه ای</span> </a></li>
                            <li><a href="{{route('all_persuasion')}}"><span>کلی</span> </a></li>
                        </ul>
                    </li>
                    @endif
                    <li><a><span>میز جوایز</span> </a>
                        <ul>
                            <li><a href="{{route('add_award')}}"><span>افزودن</span> </a></li>
                            <li><a href="{{route('show_order')}}"><span>درخواست ها</span> </a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            @endif
            <!--
            <li><a href="{{route('add_slider')}}"><i class="icon fa fa-asterisk"></i> <span>اسلایدر</span> </a></li>
            !-->
            <li><a><i class="icon fa   fa-send (alias)"></i> <span>پیام رسان</span> </a>
                <ul>
                    <li><a href="{{route('show_chat')}}"><span>ارسال</span> </a></li>
                    <li><a href="{{route('role_chat')}}"><span>دسترسی</span> </a></li>
                </ul>
            </li>
            <li><a href="{{ url('logout') }}"><i class="icon ti-face-sad"></i> <span>خروج</span> </a></li>
        </ul>
    </div>
</div>