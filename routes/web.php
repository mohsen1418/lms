<?php

use Illuminate\Support\Facades\Route;
use App\Role;

Auth::routes();
Route::get('/', 'HomeController@home')->name('home');
Route::get('/home', 'HomeController@home')->name('home');
//paye
Route::get('/paye/add', 'PayeController@add')->name('add_paye');
Route::post('/paye/insert', 'PayeController@insert')->name('insert_paye');
Route::put('/paye/update', 'PayeController@update')->name('update_paye');
Route::get('/paye/delete', 'PayeController@delete')->name('delete_paye');
//room
Route::get('/room/add', 'RoomController@add')->name('add_room');
Route::post('/room/insert', 'RoomController@insert')->name('insert_room');
Route::post('/room/update', 'RoomController@update')->name('update_class');
Route::get('/room/delete', 'RoomController@delete')->name('delete_room');
//course
Route::get('/course/add', 'CourseController@add')->name('add_course');
Route::post('/course/insert', 'CourseController@insert')->name('insert_course');
Route::get('/course/delete', 'CourseController@delete')->name('delete_course');
Route::get('/statistic/film', 'CourseController@statistic_film')->name('statistic_film');
Route::post('/course/update', 'CourseController@update')->name('update_course');
//user
Route::get('/user/add', 'UserController@add')->name('add_user');
Route::post('/user/insert', 'UserController@insert')->name('insert_user');
Route::get('/user/show', 'UserController@show')->name('show_user');
Route::post('/user/show', 'UserController@show')->name('show_user');
Route::put('/user/update', 'UserController@update')->name('update_user');
Route::get('/user/delete', 'UserController@delete')->name('delete_user');
Route::get('/user/search', 'UserController@search')->name('search_user');
Route::post('/user/search', 'UserController@search')->name('search_user');
Route::get('/user/album', 'UserController@album')->name('album');
Route::post('/user/album', 'UserController@album')->name('album');
Route::get('/user/online', 'UserController@online')->name('online_user');
Route::get('/user/import/show', 'UserController@import_show')->name('import_show_user');
Route::post('/user/import/insert', 'UserController@import_insert')->name('import_insert_user');
Route::get('/user/class', 'UserController@class')->name('class_user');
Route::post('/user/class', 'UserController@class')->name('class_user');
Route::post('/user/class/update', 'UserController@update_room')->name('update_room');
Route::get('/user/pass', 'UserController@pass')->name('pass_user');
Route::post('/user/pass', 'UserController@pass')->name('pass_user');
Route::get('/user/pass/print', 'UserController@print_pass')->name('print_pass');
Route::get('/user/export', 'UserController@export')->name('user_export');
Route::post('/user/export', 'UserController@export')->name('user_export');
//teacher
Route::get('/teacher/add', 'TeacherController@add')->name('add_teacher');
Route::post('/teacher/insert', 'TeacherController@insert')->name('insert_teacher');
Route::post('/teacher/update', 'TeacherController@update')->name('update_teacher');
Route::get('/teacher/delete', 'TeacherController@delete')->name('delete_teacher');
//employe
Route::get('/employe/add', 'EmployeController@add')->name('add_employe');
Route::post('/employe/insert', 'EmployeController@insert')->name('insert_employe');
Route::PUT('/employe/update', 'EmployeController@update')->name('update_employe');
Route::get('/employe/delete', 'EmployeController@delete')->name('delete_employe');
Route::get('/employe/role', 'EmployeController@role')->name('role_employe');
Route::post('/employe/role/insert', 'EmployeController@insert_role_employe')->name('insert_role_employe');
//film
Route::get('/film/add', 'FilmController@add')->name('add_film');
Route::post('/film/insert', 'FilmController@insert')->name('insert_film');
Route::get('/film/show', 'FilmController@show')->name('show_film');
Route::post('/film/show', 'FilmController@show')->name('show_film');
Route::post('/film/show/item', 'FilmController@show_item')->name('show_film_item');
Route::get('/film/status/update', 'FilmController@update_status_film')->name('update_status_film');
Route::get('/film/embed', 'FilmController@embed')->name('embed');
Route::put('/film/update', 'FilmController@update')->name('update_film');
Route::get('/film/view', 'FilmController@view')->name('view');
Route::get('/film/delete/', 'FilmController@delete')->name('delete_film');
Route::get('/film/report', 'FilmController@report')->name('report_film');
Route::post('/film/report', 'FilmController@report')->name('report_film');
//message
Route::get('/message/send', 'MessageController@send')->name('send_message');
Route::post('/message/insert', 'MessageController@insert')->name('insert_message');
Route::get('/message/show', 'MessageController@show')->name('show_message');
//discipline
Route::get('/discipline/add/role', 'DisciplineController@add_role')->name('add_role');
Route::post('/discipline/insert/role', 'DisciplineController@insert_role')->name('insert_role');
Route::get('/discipline/add', 'DisciplineController@add')->name('add_discipline');
Route::post('/discipline/insert', 'DisciplineController@insert')->name('insert_discipline');
Route::get('/discipline/show', 'DisciplineController@show')->name('show_discipline');
Route::post('/discipline/show', 'DisciplineController@show')->name('show_discipline');
Route::post('/discipline/update', 'DisciplineController@update')->name('update_discipline');
Route::get('/discipline/delete', 'DisciplineController@delete')->name('delete_discipline');
Route::get('/discipline/add/person', 'DisciplineController@add_person')->name('add_discipline_person');
Route::post('/discipline/add/person', 'DisciplineController@add_person')->name('add_discipline_person');
Route::get('/discipline/delete', 'DisciplineController@delete_enzebati')->name('discipline_delete');
//consultant
Route::get('/consultant/add', 'ConsultantController@add')->name('add_consultant');
Route::post('/consultant/add', 'ConsultantController@add')->name('add_consultant');
Route::post('/consultant/insert', 'ConsultantController@insert')->name('insert_consultant');
Route::get('/consultant/report', 'ConsultantController@report')->name('report_consultant');
Route::post('/consultant/report', 'ConsultantController@report')->name('report_consultant');
//homework
Route::get('/homework/add', 'HomeworkController@add')->name('add_homework');
Route::post('/homework/insert', 'HomeworkController@insert')->name('insert_homework');
Route::get('/homework/show', 'HomeworkController@show')->name('show_homework');
Route::post('/homework/show', 'HomeworkController@show')->name('show_homework');
Route::post('/homework/score', 'HomeworkController@score')->name('score_homework');
Route::get('/homework/report', 'HomeworkController@report')->name('report_homework');
Route::post('/homework/report', 'HomeworkController@report')->name('report_homework');
Route::get('/homework/person', 'HomeworkController@person')->name('person_homework');
Route::post('/homework/person', 'HomeworkController@person')->name('person_homework');
//logout
Route::get('/logout', 'HomeController@logout')->name('logout');
//persuasion
Route::get('/persuasion/add/role', 'PersuasionController@add_role')->name('add_persuasion');
Route::post('/persuasion/insert/role', 'PersuasionController@insert_role')->name('insert_persuasion');
Route::get('/persuasion/add', 'PersuasionController@add')->name('add_persuasion_item');
Route::post('/persuasion/insert', 'PersuasionController@insert')->name('insert_persuasion_item');
Route::get('/persuasion/Personal', 'PersuasionController@Personal')->name('Personal_persuasion');
Route::post('/persuasion/Personal', 'PersuasionController@Personal')->name('Personal_persuasion');
Route::get('/persuasion/class', 'PersuasionController@class')->name('class_persuasion');
Route::post('/persuasion/class', 'PersuasionController@class')->name('class_persuasion');
Route::get('/persuasion/paye', 'PersuasionController@paye')->name('paye_persuasion');
Route::post('/persuasion/paye', 'PersuasionController@paye')->name('paye_persuasion');
Route::get('/persuasion/all', 'PersuasionController@all')->name('all_persuasion');
Route::put('/persuasion/update', 'PersuasionController@update')->name('update_persuasion');
Route::get('/persuasion/delete', 'PersuasionController@delete')->name('delete_persuasion');
Route::get('/award/add', 'PersuasionController@add_award')->name('add_award');
Route::get('/award/show', 'PersuasionController@show_award')->name('show_award');
Route::post('/award/insert', 'PersuasionController@insert_award')->name('insert_award');
Route::get('/award/status', 'PersuasionController@status_award')->name('status_award');
//order
Route::get('/order/show', 'PersuasionController@show_order')->name('show_order');
Route::get('/order/delete', 'PersuasionController@delete_order')->name('delete_order');
//slider
Route::get('/slider/show', 'HomeController@add_slider')->name('add_slider');
Route::post('/slider/insert', 'HomeController@insert_slider')->name('insert_slider');
Route::get('/slider/delete', 'HomeController@delete_slider')->name('delete_slider');
Route::get('/slider/update', 'HomeController@update_slider')->name('update_status_slider');
//Salary_time
Route::get('/salary/time', 'SalaryController@add_time')->name('add_time');
Route::post('/salary/time/insert', 'SalaryController@insert_time')->name('insert_time');
Route::get('/salary/time/delete', 'SalaryController@delete_time')->name('delete_time');
//salary_fee
Route::get('/salary/fee', 'SalaryController@add_fee')->name('add_fee');
Route::post('/salary/fee/insert', 'SalaryController@insert_fee')->name('insert_fee');
Route::put('/salary/fee/update', 'SalaryController@update_fee')->name('update_fee');
Route::get('/salary/fee/delete', 'SalaryController@delete_fee')->name('delete_fee');
//salary_agreement
Route::get('/salary/agreement/add', 'SalaryController@add_agreement')->name('add_agreement');
Route::post('/salary/agreement/add', 'SalaryController@add_agreement')->name('add_agreement');
Route::get('/salary/agreement/show', 'SalaryController@show_agreement')->name('show_agreement');
Route::post('/salary/agreement/show', 'SalaryController@show_agreement')->name('show_agreement');
Route::post('/salary/agreement/update', 'SalaryController@update_agreement')->name('update_agreement');
Route::post('/salary/agreement/insert', 'SalaryController@insert_agreement')->name('insert_agreement');
Route::get('/salary/export/pdf', 'SalaryController@export_pdf')->name('export_pdf');
Route::get('/salary/agreement/excel', 'SalaryController@excel')->name('excel_agreement');
Route::post('/salary/agreement/excel/insert', 'SalaryController@insert_excel')->name('insert_excel');
Route::get('/salary/agreement/delete', 'SalaryController@delete')->name('delete_agreement');
Route::get('/salary/agreement/pay', 'SalaryController@pay_agreement')->name('pay_agreement');
//salary_rebate
Route::get('/salary/rebate', 'SalaryController@add_rebate')->name('add_rebate');
Route::post('/salary/rebate/insert', 'SalaryController@insert_rebate')->name('insert_rebate');
Route::put('/salary/rebate/update', 'SalaryController@update_rebate')->name('update_rebate');
Route::get('/salary/rebate/delete', 'SalaryController@delete_rebate')->name('delete_rebate');
//salary_exception
Route::get('/salary/exception', 'SalaryController@add_exception')->name('add_exception');
Route::post('/salary/exception', 'SalaryController@add_exception')->name('add_exception');
Route::post('/salary/exception/insert', 'SalaryController@insert_exception')->name('insert_exception');
Route::put('/salary/exception/update', 'SalaryController@update_exception')->name('update_exception');
Route::get('/salary/exception/delete', 'SalaryController@delete_exception')->name('delete_exception');
//salary_report
Route::get('/salary/show/result', 'SalaryController@show_result')->name('show_salary_result');
Route::get('/salary/fail', 'SalaryController@fail')->name('fail');
Route::get('/salary/show/date', 'SalaryController@date_result')->name('date_result');
Route::post('/salary/show/date', 'SalaryController@date_result')->name('date_result');
Route::get('/salary/debtor/show', 'SalaryController@debtor')->name('debtor_salary');
Route::get('/salary/report/show', 'SalaryController@report')->name('report_salary');
Route::post('/salary/report/show', 'SalaryController@report')->name('report_salary');
Route::get('/salary/report/print', 'SalaryController@report_print')->name('report_print_salary');
Route::get('/salary/report/total', 'SalaryController@total')->name('total_salary');
Route::post('/salary/report/total', 'SalaryController@total')->name('total_salary');
//salary_cost
Route::get('/salary/cost/in', 'SalaryController@cost_in')->name('salary_cost_in');
Route::get('/salary/cost/out', 'SalaryController@cost_out')->name('salary_cost_out');
Route::get('/salary/cost/out/show', 'SalaryController@cost_out_show')->name('salary_cost_out_show');
Route::post('/salary/cost/insert', 'SalaryController@cost_insert')->name('salary_cost_insert');
//sms
Route::get('/sms/send', 'SmsController@send')->name('send_sms');
Route::post('/sms/send', 'SmsController@send')->name('send_sms');
Route::post('/sms/insert', 'SmsController@insert')->name('insert_sms');
Route::get('/sms/send/group', 'SmsController@send_class')->name('send_class');
Route::post('/sms/insert/group', 'SmsController@insert_class')->name('insert_class');
Route::get('/sms/cadre/send', 'SmsController@send_cadre')->name('send_sms_cadre');
Route::get('/sms/charge', 'SmsController@charge')->name('charge');
Route::get('/sms/show', 'SmsController@show')->name('show_sms');
//msg
Route::get('/msg/add', 'MsgController@add')->name('add_msg');
Route::post('/msg/insert', 'MsgController@insert')->name('insert_msg');
Route::post('/msg/update', 'MsgController@update')->name('update_msg');
Route::get('/msg/delete', 'MsgController@delete')->name('delete_msg');
//mark
Route::get('/mark/add', 'MarkController@add')->name('add_mark');
Route::post('/mark/add', 'MarkController@add')->name('add_mark');
Route::post('/mark/insert', 'MarkController@insert')->name('insert_mark');
Route::get('/mark/show', 'MarkController@show')->name('show_mark');
Route::post('/mark/show', 'MarkController@show')->name('show_mark');
Route::post('/mark/update', 'MarkController@update')->name('update_mark');
Route::get('/mark/delete', 'MarkController@delete')->name('delete_mark');
//chat
Route::get('/chat/show', 'ChatController@show')->name('show_chat');
Route::post('/chat/show', 'ChatController@show')->name('show_chat');
Route::post('/chat/insert', 'ChatController@insert')->name('insert_chat');
Route::get('/chat/role', 'ChatController@role')->name('role_chat');
Route::post('/chat/role', 'ChatController@role')->name('role_chat');
Route::post('/chat/role/insert', 'ChatController@insert_role_chat')->name('insert_role_chat');
//study
Route::get('/study/add/person', 'StudyController@add_person')->name('add_study_person');
Route::post('/study/add/person', 'StudyController@add_person')->name('add_study_person');
Route::post('/study/add/person/insert', 'StudyController@insert_person')->name('insert_study_person');
Route::get('/study/add/person/delete', 'StudyController@delete_person')->name('delete_study_person');
Route::get('/study/add/group', 'StudyController@add_group')->name('add_study_group');
Route::post('/study/add/group', 'StudyController@add_group')->name('add_study_group');
Route::post('/study/add/group/insert', 'StudyController@insert_group')->name('insert_study_group');
Route::get('/study/add/group/delete', 'StudyController@delete_group')->name('delete_study_group');
Route::get('/study/report/mounthly', 'StudyController@mounthly')->name('study_mounthly');
Route::post('/study/report/mounthly', 'StudyController@mounthly')->name('study_mounthly');
Route::get('/study/report/daily', 'StudyController@daily')->name('study_daily');
Route::post('/study/report/daily', 'StudyController@daily')->name('study_daily');
Route::get('/study/report/weekly', 'StudyController@weekly')->name('study_weekly');
Route::post('/study/report/weekly', 'StudyController@weekly')->name('study_weekly');
Route::get('/study/print/person', 'StudyController@print_person')->name('study_print_person');
Route::get('/study/print/person', 'StudyController@print_person')->name('study_print_person');






