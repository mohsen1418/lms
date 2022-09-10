    <?php include('jdf.php') ?>
    @extends('layout.app')
    @section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success" role="alert">لیست دسترسی های {{\App\User::where('id',$id_user)->first()->fname." ".\App\User::where('id',$id_user)->first()->lname}}</div>
            <form action="{{route('insert_role_employe')}}" method="POST">
                <input name="id_user" value="{{$id_user}}" type="hidden">
                <div class="card">
                    <div class="card-body">
                        <p class="text-center" style="color: #4c6abd;font-weight: 700;">مدیریت دروس</p>
                        <hr>
                        <div class="row">
                            @csrf
                            <div class="form-group col-md-3">
                                <label>پایه</label>
                                <select class="custom-select mb-3" name="course_paye" dir="rtl">
                                    @if($kind->course_paye==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>کلاسی</label>
                                <select class="custom-select mb-3" name="course_class" dir="rtl">
                                    @if($kind->course_class==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>درس</label>
                                <select class="custom-select mb-3" name="course_learn" dir="rtl">
                                    @if($kind->course_learn==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>کلاس بندی</label>
                                <select class="custom-select mb-3" name="course_total" dir="rtl">
                                    @if($kind->course_total==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>افزودن</label>
                                <select class="custom-select mb-3" name="course_add" dir="rtl">
                                    @if($kind->course_add==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>ویرایش</label>
                                <select class="custom-select mb-3" name="course_update" dir="rtl">
                                    @if($kind->course_update==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>حذف</label>
                                <select class="custom-select mb-3" name="course_delete" dir="rtl">
                                    @if($kind->course_delete==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-center" style="color: #4c6abd;font-weight: 700;">دانش آموزان</p>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>افزودن</label>
                                <select class="custom-select mb-3" name="student_add" dir="rtl">
                                    @if($kind->student_add==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>مشاهده</label>
                                <select class="custom-select mb-3" name="student_show" dir="rtl">
                                    @if($kind->student_show==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>جستجو</label>
                                <select class="custom-select mb-3" name="student_search" dir="rtl">
                                    @if($kind->student_search==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>آلبوم عکس</label>
                                <select class="custom-select mb-3" name="student_img" dir="rtl">
                                    @if($kind->student_img==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>ورودی اکسل</label>
                                <select class="custom-select mb-3" name="student_excel" dir="rtl">
                                    @if($kind->student_excel==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>ویرایش</label>
                                <select class="custom-select mb-3" name="student_update" dir="rtl">
                                    @if($kind->student_update==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>حذف</label>
                                <select class="custom-select mb-3" name="student_delete" dir="rtl">
                                    @if($kind->student_delete==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>نمایش گذرواژه</label>
                                <select class="custom-select mb-3" name="student_password" dir="rtl">
                                    @if($kind->student_password==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>چاپ شناسه</label>
                                <select class="custom-select mb-3" name="student_pass" dir="rtl">
                                    @if($kind->student_pass==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-center" style="color: #4c6abd;font-weight: 700;">فیلم ها</p>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>افزودن</label>
                                <select class="custom-select mb-3" name="film_add" dir="rtl">
                                    @if($kind->film_add==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>مشاهده</label>
                                <select class="custom-select mb-3" name="film_show" dir="rtl">
                                    @if($kind->film_show==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>گزارش</label>
                                <select class="custom-select mb-3" name="film_report" dir="rtl">
                                    @if($kind->film_report==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>آمار بازدید</label>
                                <select class="custom-select mb-3" name="film_view" dir="rtl">
                                    @if($kind->film_view==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>ویرایش</label>
                                <select class="custom-select mb-3" name="film_update" dir="rtl">
                                    @if($kind->film_update==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>حذف</label>
                                <select class="custom-select mb-3" name="film_delete" dir="rtl">
                                    @if($kind->film_delete==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-center" style="color: #4c6abd;font-weight: 700;">انضباطی</p>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>قوانین</label>
                                <select class="custom-select mb-3" name="discipline_role" dir="rtl">
                                    @if($kind->discipline_role==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>ثبت مورد فردی</label>
                                <select class="custom-select mb-3" name="discipline_person" dir="rtl">
                                    @if($kind->discipline_person==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>ثبت مورد گروهی</label>
                                <select class="custom-select mb-3" name="discipline_group" dir="rtl">
                                    @if($kind->discipline_group==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>گزارش</label>
                                <select class="custom-select mb-3" name="discipline_report" dir="rtl">
                                    @if($kind->discipline_report==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>افزودن</label>
                                <select class="custom-select mb-3" name="discipline_add" dir="rtl">
                                    @if($kind->discipline_add==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>ویرایش</label>
                                <select class="custom-select mb-3" name="discipline_update" dir="rtl">
                                    @if($kind->discipline_update==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>حذف</label>
                                <select class="custom-select mb-3" name="discipline_delete" dir="rtl">
                                    @if($kind->discipline_delete==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-center" style="color: #4c6abd;font-weight: 700;">پیامک</p>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>فردی</label>
                                <select class="custom-select mb-3" name="sms_person" dir="rtl">
                                    @if($kind->sms_person==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>گروهی</label>
                                <select class="custom-select mb-3" name="sms_group" dir="rtl">
                                    @if($kind->sms_group==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>نمونه پیام</label>
                                <select class="custom-select mb-3" name="sms_sample" dir="rtl">
                                    @if($kind->sms_sample==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>کادر</label>
                                <select class="custom-select mb-3" name="sms_cadr" dir="rtl">
                                    @if($kind->sms_cadr==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>نمایش</label>
                                <select class="custom-select mb-3" name="sms_show" dir="rtl">
                                    @if($kind->sms_show==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>شارژ</label>
                                <select class="custom-select mb-3" name="sms_charge" dir="rtl">
                                    @if($kind->sms_charge==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-center" style="color: #4c6abd;font-weight: 700;">نمره کلاسی</p>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>ثبت</label>
                                <select class="custom-select mb-3" name="mark_add" dir="rtl">
                                    @if($kind->mark_add==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>مشاهده</label>
                                <select class="custom-select mb-3" name="mark_show" dir="rtl">
                                    @if($kind->mark_show==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-center" style="color: #4c6abd;font-weight: 700;">مشاوره</p>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>افزودن</label>
                                <select class="custom-select mb-3" name="consultant_add" dir="rtl">
                                    @if($kind->consultant_add==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>گزارش</label>
                                <select class="custom-select mb-3" name="consultant_show" dir="rtl">
                                    @if($kind->consultant_show==0)
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                    @else
                                    <option value="1">بله</option>
                                    <option value="0">خیر</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                        <div class="card-body">
                            <p class="text-center" style="color: #4c6abd;font-weight: 700;">تکالیف</p>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>افزودن</label>
                                    <select class="custom-select mb-3" name="homework_add" dir="rtl">
                                        @if($kind->homework_add==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>مشاهده</label>
                                    <select class="custom-select mb-3" name="homework_show" dir="rtl">
                                        @if($kind->homework_show==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>گزارش جامع</label>
                                    <select class="custom-select mb-3" name="homework_report" dir="rtl">
                                        @if($kind->homework_report==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>کارنامه فردی</label>
                                    <select class="custom-select mb-3" name="homework_card" dir="rtl">
                                        @if($kind->homework_card==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-center" style="color: #4c6abd;font-weight: 700;">ساعت مطالعه</p>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>افزودن</label>
                                    <select class="custom-select mb-3" name="study_person" dir="rtl">
                                        @if($kind->study_person==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>مشاهده</label>
                                    <select class="custom-select mb-3" name="study_group" dir="rtl">
                                        @if($kind->study_group==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>گزارش جامع</label>
                                    <select class="custom-select mb-3" name="study_daily" dir="rtl">
                                        @if($kind->study_daily==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>کارنامه فردی</label>
                                    <select class="custom-select mb-3" name="study_mounthly" dir="rtl">
                                        @if($kind->study_mounthly==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-center" style="color: #4c6abd;font-weight: 700;">بشارت</p>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>قوانین</label>
                                    <select class="custom-select mb-4" name="besharat_role" dir="rtl">
                                        @if($kind->besharat_role==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>ثبت مورد</label>
                                    <select class="custom-select mb-3" name="besharat_insert" dir="rtl">
                                        @if($kind->besharat_insert==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>گزارش گیری</label>
                                    <select class="custom-select mb-3" name="besharat_report" dir="rtl">
                                        @if($kind->besharat_report==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-center" style="color: #4c6abd;font-weight: 700;">امور مالی</p>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>زمان بندی</label>
                                    <select class="custom-select mb-4" name="mali_time" dir="rtl">
                                        @if($kind->mali_time==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>شهریه</label>
                                    <select class="custom-select mb-3" name="mali_fee" dir="rtl">
                                        @if($kind->mali_fee==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>تخفیف و اقساط</label>
                                    <select class="custom-select mb-3" name="mali_rebate" dir="rtl">
                                        @if($kind-> mali_rebate==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>مبلغ پرداختی</label>
                                    <select class="custom-select mb-3" name="mali_agreement" dir="rtl">
                                        @if($kind->mali_agreement==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>قرارداد</label>
                                    <select class="custom-select mb-3" name="mali_result" dir="rtl">
                                        @if($kind->mali_result==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>گزارش</label>
                                    <select class="custom-select mb-3" name="mali_result" dir="rtl">
                                        @if($kind->mali_result==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>کارنامه فردی</label>
                                    <select class="custom-select mb-3" name="mali_report" dir="rtl">
                                        @if($kind->mali_report==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>دخل و خرج</label>
                                    <select class="custom-select mb-3" name="mali_cost" dir="rtl">
                                        @if($kind->mali_cost==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-center" style="color: #4c6abd;font-weight: 700;">مدیریت کاربران</p>
                            <hr>
                            <div class="row">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label>دبیر</label>
                                    <select class="custom-select mb-3" name="manager_teacher" dir="rtl">
                                        @if($kind->manager_teacher==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>کادر</label>
                                    <select class="custom-select mb-3" name="manager_personnel" dir="rtl">
                                        @if($kind->manager_personnel==0)
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                        @else
                                        <option value="1">بله</option>
                                        <option value="0">خیر</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary">ثبت تغییرات</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @endsection