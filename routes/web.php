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
    return view('home_page');
});

Route::get('/test_style', function(){
    return view('index');
});

Route::view('/signin', 'signin');
Route::get('/insert_dummy_user', 'DummyData@insertUser');

Route::post('/login', 'LoginController@submitDetails');
Route::get('/users/logout', 'LogoutController@logout');

Route::view('/forgotPassword', 'forgotPassword');
Route::view('/code', 'inputToken');
Route::view('/updatePassword', 'updatePassword');

Route::post('forgot_password_submit', 'ResetPasswordSendMailController@sendEmailToUser');

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

Route::get('/students_details/{class_name}', 'Students@studentDetails');
Route::post('/add_new_student', 'Students@insertStudent');
Route::post('/add_student_address', 'Students@addStudentAddress');
Route::post('/add_parent_details', 'Students@addParent');
Route::get('/studentDetails/{class_name},{studentID}', 'Students@specificStudent');
Route::post('/edit_address', 'Students@editAddress');
Route::post('/edit_parent_details', 'Students@editParentDetails');
Route::get('/studentDetails/resultSlips/{year}/{term}/{exam_type}/{student_id},{class_name}', 'ReportFormsController@resultSlip');
Route::get('/students/alumni', 'AlumniStudentsController@getAlumniStudents');
Route::get('/students/alumni/{student_id}', 'AlumniStudentsController@getSpecificAlumni');


Route::get('/home', 'Sample_non_teachingController@index')->name('home');
Route::get('users', 'Sample_non_teachingController@getUsers')->name('get.users');
Route::view('/login_form', 'login');


//Routes for student entry of marks
Route::get('/marks_entry/{class}', 'MarksEntryController@checkTeacher');
Route::post('/submit_marks', 'MarksEntryController@submitMarks');
Route::post('/update_marks', 'MarksEntryController@updateMarks');
Route::post('/removeMarks', 'MarksEntryController@removeMarks');
Route::get('/report_forms/{class_name}', 'ReportFormsController@getReportForms');

//print report forms
Route::get('/report_form/{student_id},{class_name}', 'ReportFormsController@generateReportForm');
Route::get('/view_report_form/{student_id},{class_name}', 'ViewReportForms@report_form');
Route::post('/view_student_report_form', 'ViewReportForms@student_report_form');


//get the merit lists
Route::get('/merit_list/{className}', 'MeritListController@getMeritList');
Route::get('/viewMeritList/{class_name}', 'MeritListController@view_merit_list');

Route::view('/counter', 'admin_landing_page');


Route::get('/demo_view', 'DemoController@view_merit_list_form1');
Route::get('/viewMeritListForm1', 'ViewMeritListController@view_merit_list_form1');
Route::get('/viewMeritListForm2', 'ViewMeritListController@view_merit_list_form2');
Route::get('/viewMeritListForm3', 'ViewMeritListController@view_merit_list_form3');
Route::get('/viewMeritListForm4', 'ViewMeritListController@view_merit_list_form4');

Route::view('/homepage', 'home_page');



//fee structure forms
Route::view('/new_fee_structure', 'fee_stucture');
Route::post('/save_fee_structure', 'FeeStructure@submit');
Route::get('/current_fee_structures', 'FeeStructure@showCurrentFeeStructure');
Route::post('/update_fee_structure', 'FeeStructure@update');


//Route to dashboards
Route::get('/admin/dashboard', 'DashboardController@toAdmin');
Route::view('/home_dashboard', 'home_dashboard');

//Routes for finance department
Route::get('/finance_department', 'FinanceDepartmentController@displayDashboard');
Route::get('/finance_department/take_fees/{class_name}', 'FinanceDepartmentController@take_fees');
Route::get('/finance_department/take_fees/student/{student_id}', 'FinanceDepartmentController@displayInputForm');
Route::post('/finance_department/record_fee', 'FinanceDepartmentController@record_new_fees');
Route::get('/finance_department/fee_balances/{class_name}', 'FinanceDepartmentController@viewFeeBalances');
Route::get('/finance_department/download_fee_balance/{class_name}','FinanceDepartmentController@downloadFeeBalances');
Route::get('/finance_department/fee_statements/{class_name}', 'FinanceDepartmentController@allClassFeeStatements');
Route::get('/finance_department/view_fee_statement/{class_name},{student_id}', 'FinanceDepartmentController@viewFeeStatement');
Route::get('/finance_department/download_fee_statement/{student_id}', 'FinanceDepartmentController@downloadFeeStatement');
Route::get('/finance_department/clean_students/{class_name}', 'FinanceDepartmentController@cleanStudents');
Route::get('/finance_department/clean_students/download/{class_name}', 'FinanceDepartmentController@downloadCleanStudents');
Route::get('/finance_department/reports', 'FinanceDepartmentController@view_reports');
Route::get('/finance_department/reports/download', 'FinanceDepartmentController@getReport');

//routes for the accommodation facility
Route::get('/accommodation_facility', 'Accommodation@dashboard');
Route::get('/accommodation_facility/dormitories', 'Accommodation@showDormitories');
Route::post('/accommodation_facility/addNewDormitory', 'Accommodation@insertDormitory');
Route::post('/accommodation_facility/updateDormitory', 'Accommodation@updateDormitory');
Route::get('/accommodation_facility/dormitory/{dorm_id}', 'Accommodation@dormRooms');
Route::get('/accommodation_facility/dormitory/{dormID}/addNewRoom', 'Accommodation@addRoom');
Route::post('/accommodation_facility/Dormitory/saveNewRoom', 'Accommodation@insertNewRoom');
Route::post('/accommodation_facility/dormitory/removeRoom', 'Accommodation@removeRoom');
Route::post('/accommodation_facility/dormitory/editRoom', 'Accommodation@editRoom');
Route::get('/accommodation_facility/studentRooms/{class_name}', 'Accommodation@studentRooms');
Route::post('/accommodation_facility/studentRooms/deallocateRoom', 'Accommodation@deallocateRoom');
Route::get('/accommodation_facility/studentRooms/allocate/{student_id},{class_name}','Accommodation@allocateRoomForm');
Route::post('/accommodation_facility/studentRooms/allocateRoom', 'Accommodation@saveRoom');
Route::get('/accommodation_facility/studentRooms/editAllocatedRoom/{student_id},{className}', 'Accommodation@editRoomForm');
Route::post('/accommodation_facility/studentRooms/editAllocateStudentRoom', 'Accommodation@saveEditedRoom');
Route::get('/accommodation_facility/report', 'Accommodation@detailedReport');

//routes for disciplinary cases
Route::get('/disciplinary/{class_name}', 'Disciplinary@showStudents');
Route::post('/disciplinary/reportCase', 'Disciplinary@reportCase');
Route::get('/disciplinary/cases/current_cases', 'Disciplinary@current_cases');
Route::get('/disciplinary_case/{case_id}/{student_id}/{teacher_id}', 'Disciplinary@specific_student_case');
Route::post('/disciplinary/case_clearance', 'Disciplinary@case_clearance');

//Routes for student promotions
Route::post('/students/archive', 'StudentPromotion@archiveStudent');
Route::post('/students/promote', 'StudentPromotion@promotoToNextClass');

//Routes for term sessions and exam sessions
Route::get('/term_sessions/current_session', 'Term_sessions@current_session');
Route::get('/term_sessions/others', 'Term_sessions@other_sessions');
Route::view('/term_sessions/new', 'new_term_session');
Route::post('/term_session/set_current_session', 'Term_sessions@set_current_session');
Route::get('/term_session/set_exam_session/{term_id}', 'Term_sessions@new_exam_session');
Route::post('/term_session/set_exam_session', 'Term_sessions@set_exam_session');
Route::post('/term_sessions/remove_exam_session', 'Term_sessions@remove_exam_session');
Route::post('/term_sessions/edit_exam_session', 'Term_sessions@edit_exam_session');
Route::post('/term_sessions/edit_term_session', 'Term_sessions@edit_term_session');
Route::post('/term_sessions/end_term_session', 'Term_sessions@end_term_session');

//Routes for student
Route::get('/students/edit/{student_id}', 'Students@editStudent');
Route::post('/students/edit_student', 'Students@updateStudentInfo');
Route::post('/students/clear_student', 'Students@studentClearance');

//Routes for settings
Route::view('/settings/change_password', 'profile.change_password');
Route::post('/settings/changePassword', 'SettingsController@changePassword');

//Routes for profile settings
Route::get('/users/profile', 'ProfileController@viewProfile');
Route::get('/users/profile/edit', 'ProfileController@editProfile');
Route::post('/users/update_profile', 'ProfileController@updateProfile');


//sending emails
Route::post('/students/sendMail', 'SendMailController@sendMailToParent');