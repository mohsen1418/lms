<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class Role extends Model
{
    protected $table = 'role';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'course_paye','course_class','course_learn','course_total','course_add','course_update','course_delete','student_add','student_show','student_search','student_img','student_excel','student_update','student_delete','student_password','student_pass','film_add','film_show','film_report','film_view','film_update','film_delete','discipline_role','discipline_person','discipline_group','discipline_report','discipline_add','discipline_update','discipline_delete','sms_person','sms_group','sms_sample','sms_cadre','sms_show','sms_charge','mark_add','mark_show','study_person','study_group','study_daily','study_mounthly','homework_add','homework_show','homework_report','homework_card','manager_personnel','manager_teacher','besharat_role','besharat_insert','besharat_report','mali_time','mali_fee','mali_rebate','mali_agreement','mali_result','mali_report','mali_cost','consultant_show','consultant_add'
    ];
    public static function role()
    {
        return DB::table('role')->where('id_user', Auth::User()->id)->first();
    }
}
