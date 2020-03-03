<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test_style', function(){
    return view('index');
});

Route::get('/insert_dummy_user', 'DummyData@insertUser');

Route::post('/login', 'LoginController@submitDetails');

Route::view('/forgotPassword', 'forgot_password');

Route::post('forgot_password_submit', 'ForgotPassword@submit');

Route::post('/reset_password', 'ForgotPassword@reset_password');

Route::post('/reset_pass', 'LoginController@resetPassword');

Route::view('/addStudent', 'add_student')->middleware('sessionChecker');
Route::view('/add_student', 'add_student');

Route::view('/addStudentDetails', 'final_student_form');

Route::view('/addParent', 'add_parent')->middleware('sessionChecker');

Route::view('/addTeacher', 'add_teacher')->middleware('sessionChecker');
Route::post('/add_teacher', 'Teachers@insertTeacher')->middleware('sessionChecker');

Route::view('/addAddress', 'add_address');

Route::view('/addStaff', 'add_non_teaching_staff')->middleware('sessionChecker');
Route::post('/add_staff', 'Non_teaching_staff_controller@insertStaff');
Route::get('/nonTeachingStaffDetails', 'Non_teaching_staff_controller@showStaff');
//route to a specific non teaching staff details
Route::get('/staff_details/{id}', 'Non_teaching_staff_controller@specificStaff');
Route::post('edit_staff','Non_teaching_staff_controller@editStaff');
Route::post('/archive_staff', 'Non_teaching_staff_controller@archiveStaff');
Route::get('/alumniStaff', 'Non_teaching_staff_controller@showAlumni');
Route::get('/alumniStaff/{id}', 'Non_teaching_staff_controller@specificAlumni' );

Route::get('/teachers_details', 'Teachers@showTeachers');
Route::get('/teachers_details/{id}', 'Teachers@specificTeacher');
Route::post('/edit_teacher', 'Teachers@editTeacher');
Route::post('/archive_teacher', 'Teachers@archiveTeacher');

//routes for roles and responsibilities for teachers
Route::post('/denySpecialRole', 'Teachers@denySpecialRole');
Route::post('/add_role', 'Teachers@addSpecialRole');
Route::post('/add_responsibility', 'Teachers@addResponsibility');
Route::post('/denyResponsibility', 'Teachers@denyResponsibility');
Route::post('/addTeachingClass', 'Teachers@addTeachingClass');
Route::post('/removeTeachingClassSubject1', 'Teachers@removeTeachingClassSubject1');
Route::post('/removeTeachingClassSubject2', 'Teachers@removeTeachingClassSubject2');

Route::view('/students_details', 'student_details');
Route::post('/add_new_student', 'Students@insertStudent');
Route::post('/add_student_address', 'Students@addStudentAddress');
Route::post('/add_parent_details', 'Students@addParent');


Route::get('/home', 'Sample_non_teachingController@index')->name('home');
Route::get('users', 'Sample_non_teachingController@getUsers')->name('get.users');
Route::view('/login_form', 'login');


//Routes for student entry of marks
Route::get('/marks_entry/{class}', 'MarksEntryController@checkTeacher');
Route::post('/submit_marks', 'MarksEntryController@submitMarks');
Route::post('/update_marks', 'MarksEntryController@updateMarks');
Route::post('/removeMarks', 'MarksEntryController@removeMarks');
Route::get('/report_forms/{class_name}', 'ReportFormsController@getReportForms');