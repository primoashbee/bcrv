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

//Route for the Home Page

use App\Http\Middleware\AdminMiddlewareLegit;
use App\Http\Middleware\LoggedInMiddleware;
use App\Http\Middleware\StudentMiddleware;

    Route::get('/', function () {
        return view('layouts.welcome');
    });

    //Route to view guest
    Route::get('guest', function () {
        return view('users.guest');
    });

//Group Route for Visitors Middleware
    Route::group(['middleware' => ['visitors']], function () {
        //Route to view registration form
            Route::get('/register', 'Security\RegisterController@register');
        //Route for the registration action
            Route::post('/register', 'Security\RegisterController@registerUser');

        //Route to view Login Form
            Route::get('/login', 'Security\LoginController@login');
        //Route for the login action
            Route::post('/login', 'Security\LoginController@loginUser');

        //Route for email activation
            Route::get('/activate/{email}/{code}', 'Security\ActivationController@activate');

        //Route for showing the forgot password view
            Route::get('/forgot_password', 'Security\ForgotPassword@forgot');
        //Route for the forgot password action
            Route::post('/forgot_password', 'Security\ForgotPassword@forgot_password');

        //Route for showing the Reset password view
            Route::get('/reset_password/{email}/{code}', 'Security\ForgotPassword@reset');
        //Route for the reset password action - post
            Route::post('/reset_password/{email}/{code}', 'Security\ForgotPassword@reset_password');
    });

//Route for logout

    Route::middleware([AdminMiddlewareLegit::class])->group(function () {
        Route::get('/hey', function(){
            return 'hey';
        });
        Route::get('/dashboard', 'Admin\DashboardController@dashboard');
        Route::get('/show_dashboard','Admin\DashboardController@show_dashboard');

        Route::get('/annoucement','AnnouncementController@index')->name('announcement.index');
        Route::post('/annoucement','AnnouncementController@store')->name('announcement.store');

        //Routes for courses page
        //Route to show courses page
        Route::get('/show_courses', 'Admin\CourseController@show_courses');
        //Route for adding a new course
        Route::post('/add_course', 'Admin\CourseController@add_course');     
        //Route to show the page to edit the course
        Route::get('/show_edit_course/{id}', 'Admin\CourseController@show_edit_course_view');
        //Route to edit the course
        Route::put('/edit_course/{id}', 'Admin\CourseController@edit_course');
        //Route to delete the course 
        Route::delete('/delete_course/{id}', 'Admin\CourseController@delete_course');


        //Routes for students page
        //Route to show students page
        Route::get('/show_students', 'Admin\StudentController@show_students');
        //Route to show the page to edit the student
        Route::get('/show_edit_student/{id}', 'Admin\StudentController@show_edit_student');
        //Route to edit the course
        Route::put('/edit_student/{id}', 'Admin\StudentController@edit_student');
   
        //Routes for documents page
        //Route to show documents page
        Route::get('/show_documents', 'Admin\DocumentController@show_documents');
        //Route for adding a new document
        Route::post('/add_document', 'Admin\DocumentController@add_document');  
        //Route to show the page to edit the document
        Route::get('/show_edit_document/{id}', 'Admin\DocumentController@show_edit_document');
        //Route to edit the document
        Route::put('/edit_document/{id}', 'Admin\DocumentController@edit_document');
        //Route to download documents
        Route::get('/download_document/{file_name}', 'Admin\DocumentController@download_document');   
        //Route to delete the document 
        Route::delete('/delete_document/{id}', 'Admin\DocumentController@delete_document');

        //Routes for requests page
        //Route to show requests page
        Route::get('/show_requests', 'Admin\RequestController@show_requests');
        //Route to show the page to edit the request
        Route::get('/show_edit_request/{id}', 'Admin\RequestController@show_edit_request');
        //Route to edit the request
        Route::put('/edit_request/{id}', 'Admin\RequestController@edit_request');
        //Route to edit the request
        Route::get('/show_respond_to_request/{id}', 'Admin\RequestController@show_respond_to_request');
        //Route for responding to request
        Route::post('/respond_to_request/{id}', 'Admin\RequestController@respond_to_request');  
        //Route to delete the request 
        Route::delete('/delete_request/{id}', 'Admin\RequestController@delete_request');
            
        //Routes for users page
        //Route to show users page
        Route::get('/show_users', 'Admin\UserController@show_users');
        //Route to show the page to edit the user
        Route::get('/show_edit_user/{id}', 'Admin\UserController@show_edit_user_view');
        //Route to edit the user 
        Route::put('/edit_user/{id}', 'Admin\UserController@edit_user');

        
        //Route to delete the user 
        Route::delete('/delete_user/{id}', 'Admin\UserController@delete_user');

        //Routes for reports
        //Route to show users page
        Route::get('/show_reports', 'Admin\ReportController@show_reports');

        //Routes for responses
        //Route to show responses page
        Route::get('/show_responses', 'Admin\ResponseController@show_responses');

        //Routes for the requests to students
        //Route to show requests page
        Route::get('/show_requests_to_students', 'Admin\RequesttoStudentsController@show_requests_to_students')->name('request.admin.to.student');
        Route::delete('/show_requests_to_students/delete/{id}', 'Admin\RequesttoStudentsController@delete')->name('request.admin.to.student.delete');
        //Route for adding a new document
        Route::post('/add_request_to', 'Admin\RequesttoStudentsController@add_request_to'); 
        //Route to download documents
        Route::get('/download_response_from_student/{id}', 'Admin\RequesttoStudentsController@download_response_from_student'); 
        Route::get('/view_response_from_student/{id}', 'Admin\RequesttoStudentsController@view_response_from_student'); 
        Route::get('/requirements/uploaded', 'StudentRequirementController@index')->name('requirements.uploaded');
        Route::patch('/requirements/{id}', 'StudentRequirementController@update')->name('requirements.update');


    });
//Routes for the admin panel - dashboard
    //Route for the function not to allow guest users in dashboard panel
        // Route::get('/dashboard', 'Admin\DashboardController@dashboard');
    //Route to view the dashboard panel
    //Route to view the dashboard panel

    Route::get('/notifications/list',function(){
       
        $list = auth()->user()->notifications()->orderBy('id','desc')->limit(5)->get();
        $data = count($list) > 0 ?  $list : [];
        return response()->json([
            'data'=>  $data
        ],200);
    });
    Route::middleware([LoggedInMiddleware::class])->group(function () {
        Route::get('/notifications','NotificationController@index'); 
        Route::post('/logout', 'Security\LoginController@logout');
        Route::get('/requirements', 'RequirementController@index')->name('requirements');
        Route::post('/requirements', 'RequirementController@store')->name('requirements.store');
        Route::get('/notifications/list', 'NotificationController@list')->name('notifications.list');
        Route::get('/notifications/listahan', function(){
            dd('hey');
        });

        Route::get('/notification/{notification}','NotificationController@view')->name('notification.view');  
        Route::patch('/notification/{notification}', 'NotificationController@update')->name('notifications.update');
        Route::get('/requirements/view/{id}', 'StudentRequirementController@view')->name('requirements.view');
        Route::get('/requirements/download/{id}', 'StudentRequirementController@download')->name('requirements.download');
        Route::get('/preview_request/{id}', 'Admin\StudentRequestController@view')->name('request.preview');

        Route::post('/student/delete/{id}', 'Admin\StudentController@delete')->name('student.delete');

    });







    // ============================= Routes for requests page - STUDENT ============================= //

    Route::middleware([StudentMiddleware::class])->group(function () {
            Route::get('/show_dashboard_students','Admin\DashboardController@show_dashboard_students');

            
            Route::post('/requirements/update/{id}', 'RequirementController@update')->name('requirements.update');
            Route::post('/requirements/student', 'StudentRequirementController@store')->name('requirements.student.store');

            // Route::get('/requirements/uploaded', 'StudentRequirementController@index')->name('requirements.uploaded');





            //Route to show requests page
            Route::get('/show_requests_students', 'Admin\StudentRequestController@show_requests_students');
            Route::get('/download_request/{id}', 'Admin\StudentRequestController@download')->name('request.download');
            //Route for adding a new request 
            Route::post('/add_request_students', 'Admin\StudentRequestController@add_request_students');  
            //Route to show the page to edit the request
            Route::get('/show_edit_request_students/{id}', 'Admin\StudentRequestController@show_edit_request_students');
            //Route to edit the request 
            Route::put('/edit_request_students/{id}', 'Admin\StudentRequestController@edit_request_students');
            //Route receive request
            Route::get('/receive_request/{id}', 'Admin\StudentRequestController@receive_request'); 
        
            //Routes for profile page - STUDENT
            //Route to show profile page
            Route::get('/show_profile_students', 'Admin\StudentProfileController@show_profile_students');
            //Route to edit the student profile
            Route::put('/update_profile', 'Admin\StudentProfileController@update_profile')->name('/update_profile');

            //Routes for documents page
            //Route to show documents page
            Route::get('/show_documents_students', 'Admin\StudentDocumentController@show_documents_students');
            //Route for adding a new document
            Route::post('/add_document_students', 'Admin\StudentDocumentController@add_document_students');  
            //Route to show the page to edit the user
            Route::get('/show_edit_documents_students/{id}', 'Admin\StudentDocumentController@show_edit_documents_students'); 
            //Route to edit the document 
            Route::put('/edit_document_students/{id}', 'Admin\StudentDocumentController@edit_document_students');

            //Routes for responses
            //Route to show responses page
            Route::get('/show_responses_students', 'Admin\ResponseController@show_responses_students');
            //Route receive response
            Route::get('/receive_response/{id}', 'Admin\ResponseController@receive_response'); 
            //Route to download documents
            Route::get('/download_document_students/{file_name}', 'Admin\ResponseController@download_document_students');  

            //Requests from Admins
            //Route to show requests page
            Route::get('/show_requests_from_admins', 'Admin\RequesttoStudentsController@show_requests_from_admins')->name('student.request.from.admin');
            //Route to show the page to respond to the request
            Route::get('/respond_to_request_from_admin/{id}', 'Admin\RequesttoStudentsController@respond_to_request_from_admin')->name('request.from.admin.view');
            //Route for responding to request from  admin
            Route::post('/respond_to_request_from_admins/{id}', 'Admin\RequesttoStudentsController@respond_to_request_from_admins');  

            //NOTIFICATIONS - Admin
            Route::get('/newest_requests', 'Admin\DashboardController@newest_requests')->name('/newest_requests');
            Route::get('/show_notifications', 'Admin\DashboardController@show_notifications');

            //NOTIFICATIONS - Students
            Route::get('/newest_response_students', 'Admin\DashboardController@newest_response_students')->name('/newest_response_students');
            Route::get('/show_response_students', 'Admin\DashboardController@show_response_students');
    });
            

