<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ManageProfileController;
use App\Http\Controllers\ManageRegistrationController;
use App\Http\Controllers\ManageResultController;
use App\Http\Controllers\ManageReportController;
use App\Http\Controllers\ManageTimetableController;
use App\Http\Controllers\ManageActivityController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('KAFA/Dashboard', [ManageRegistrationController::class, 'index'])->name('kafa.dashboard')->middleware('kafa');
Route::get('MUIP/Dashboard', [ManageRegistrationController::class, 'index'])->name('muip.dashboard')->middleware('muip');
Route::get('Parent/Dashboard', [ManageRegistrationController::class, 'index'])->name('parent.dashboard')->middleware('parent');
Route::get('Teacher/Dashboard', [ManageRegistrationController::class, 'index'])->name('teacher.dashboard')->middleware('teacher');


Route::get('/result', [ManageResultController::class, 'index'])->name('result');
Route::get('/results/create', [ManageResultController::class, 'create'])->name('results.create');

Route::get('/students/search', [ManageResultController::class, 'searchStudentForm'])->name('students.searchForm');
Route::post('/students/search', [ManageResultController::class, 'searchStudent'])->name('students.search');
Route::get('/results/add/{studentIC}', [ManageResultController::class, 'addResult'])->name('results.add');
Route::post('/results/store', [ManageResultController::class, 'store'])->name('results.store');
Route::get('/results/edit/{studentIC}', [ManageResultController::class, 'edit'])->name('results.edit');
Route::put('/results/update/{studentIC}', [ManageResultController::class, 'update'])->name('results.update');
Route::get('/results/view/{studentIC}', [ManageResultController::class, 'viewResult'])->name('results.view');
Route::delete('/result/delete/{studentIC}/{result_id}', [ManageResultController::class, 'deleteResult'])->name('results.delete');

Route::get('/result/view/{studentId}', [ManageResultController::class, 'viewParent'])->name('parents.view');
Route::get('/parents/search', [ManageResultController::class, 'parentSearch'])->name('parents.search');
Route::post('/parent/search', [ManageResultController::class, 'searchParent'])->name('parents.studentSearch');

Route::post('/kafa/search', [ManageResultController::class, 'searchKafa'])->name('kafa.search');

Route::get('/muip/search', [ManageResultController::class, 'showMuipSearchForm'])->name('muip.showSearchForm');
Route::post('/muip/search', [ManageResultController::class, 'searchMuip'])->name('muip.search');
Route::get('/muip/search/{studentId}', [ManageResultController::class, 'viewMuipResult'])->name('muip.searchStudent');


Route::get('/kafa/search', [ManageResultController::class, 'showKafaSearchForm'])->name('kafa.showSearchForm');
Route::post('/kafa/search', [ManageResultController::class, 'searchKafa'])->name('kafa.search');
Route::get('/kafa/search/{studentIC}', [ManageResultController::class, 'viewKafaResult'])->name('kafa.searchStudent');
Route::get('/results/{id}/delete', [ManageResultController::class, 'showKafaDeleteForm'])->name('results.showKafaDeleteForm');
Route::delete('/results/delete/{studentIC}/{result_id}', [ManageResultController::class, 'deleteResultkafa'])->name('results.deletekafa');
Route::get('result/{id}/delete', [ManageResultController::class, 'showDeleteForm'])->name('results.showDeleteForm');






Route::get('KAFA/ParentTeacherList', [ManageProfileController::class, 'index'])->name('profile.ParentTeacherList');
Route::get('KAFA/parent/{id}', [ManageProfileController::class, 'showParentDetail'])->name('profile.showParent');
Route::get('KAFA/teacher/{id}', [ManageProfileController::class, 'showTeacherDetail'])->name('profile.showTeacher');
Route::get('KAFA/parent/edit/{id}', [ManageProfileController::class, 'editParent'])->name('profile.editParent');
Route::get('KAFA/teacher/edit/{id}', [ManageProfileController::class, 'editTeacher'])->name('profile.editTeacher');
Route::put('KAFA/parent/{id}', [ManageProfileController::class, 'updateParent'])->name('parent.update');
Route::put('KAFA/teacher/{id}', [ManageProfileController::class, 'updateTeacher'])->name('teacher.update');
Route::delete('KAFA/profile/{id}', [ManageProfileController::class, 'delete'])->name('profile.delete');
Route::get('/profile/edit', [ManageProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ManageProfileController::class, 'update'])->name('profile.update');


// Route::get('/manage/timetable/teacher', ManageTimetableController::class.'@teacherTemplateTimetable')->name('manage.timetable.teacher');
// Route::get('/manage/timetable/list', ManageTimetableController::class.'@timetablelist')->name('manage.timetable.list');
// // returns the form for adding a timetable
// Route::get('/manage/timetable/create', ManageTimetableController::class . '@create')->name('manage.timetable.list.create');
// // adds a timetable to the database
// Route::post('/manage/timetable', ManageTimetableController::class .'@store')->name('manage.timetable.list.store');
// // returns a page that shows a full timetable
// Route::get('/manage/timetable/{id}', ManageTimetableController::class .'@show')->name('manage.timetable.list.show');
// // returns the form for editing a timetable
// Route::get('/manage/timetable/{timetable}/edit', ManageTimetableController::class .'@edit')->name('manage.timetable.list.edit');
// // updates a timetable
// Route::put('/manage/timetable/{timetable}', ManageTimetableController::class .'@update')->name('manage.timetable.list.update');
// // deletes a timetable
// Route::delete('/manage/timetable/{timetable}', ManageTimetableController::class .'@destroy')->name('manage.timetable.list.destroy');

Route::get('Teacher/try', [ManageActivityController::class, 'index'])->name('teacher.try');

Route::get('/search', [ManageActivityController::class, 'index'])->name('activities.search');
Route::get('/search/{id}', [ManageActivityController::class, 'show'])->name('activities.show');
Route::get('/activities/create', [ManageActivityController::class, 'create'])->name('activities.create');
Route::post('/activities', [ManageActivityController::class, 'store'])->name('activities.store');
Route::get('/activities/{id}/', [ManageActivityController::class, 'edit'])->name('activities.edit');
Route::put('/activities/{id}', [ManageActivityController::class, 'update'])->name('activities.update');
Route::delete('/activities/{id}', [ManageActivityController::class, 'destroy'])->name('activities.destroy');

Route::get('/KAFAadminsearch', [ManageActivityController::class, 'KAFAindex'])->name('KAFAadmin.activities.search');
Route::get('/KAFAadminsearch/{id}', [ManageActivityController::class, 'KAFAshow'])->name('KAFAadmin.activities.show');

Route::get('/MUIPadminsearch', [ManageActivityController::class, 'MUIPindex'])->name('MUIPadmin.activities.search');
Route::get('/MUIPadminsearch/{id}', [ManageActivityController::class, 'MUIPshow'])->name('MUIPadmin.activities.show');

Route::get('/Parentsearch', [ManageActivityController::class, 'Parentindex'])->name('Parent.activities.search');
Route::get('/Parentsearch/{id}', [ManageActivityController::class, 'Parentshow'])->name('Parent.activities.show');

Route::get('KAFA/ViewActivityList', [ManageReportController::class, 'index'])->name('report.ViewActivityList');
Route::get('KAFA/ViewActivityDetail/{id}', [ManageReportController::class, 'show'])->name('report.ViewActivityDetail');
Route::post('KAFA/ViewActivityDetail/{id}/AddPostMortem', [ManageReportController::class, 'create'])->name('report.AddPostMortemForm');
Route::post('KAFA/ViewActivityDetail/{id}/StorePostMortem', [ManageReportController::class, 'store'])->name('report.PostMortemStore');
Route::get('KAFA/ViewActivityDetail/{id}/ViewCompletePostMortem', [ManageReportController::class, 'showPostMortem'])->name('report.ViewCompletePostMortem');
Route::get('KAFA/ViewActivityDetail/{id}/EditPostMortem/{postMortemId}', [ManageReportController::class, 'edit'])->name('report.EditPostMortemForm');
Route::put('KAFA/ViewActivityDetail/{id}/UpdatePostMortem/{postMortemId}', [ManageReportController::class, 'update'])->name('report.PostMortemUpdate');

Route::get('MUIP/ViewActivityList', [ManageReportController::class, 'indexMuip'])->name('report.ViewFinishActivityList');
Route::get('MUIP/{id}/ViewCompletePostMortem', [ManageReportController::class, 'showPostMortemMuip'])->name('report.MuipViewCompletePostMortem');
Route::get('MUIP/YearOption', [ManageReportController::class, 'showYears'])->name('report.AcademicYearOption');
Route::get('MUIP/YearOption/{year}', [ManageReportController::class, 'showStudentsByYear'])->name('report.StudentByYear');
Route::get('MUIP/{id}/AcademicPerformance', [ManageReportController::class, 'viewAcademicPerformance'])->name('report.ViewAcademicPerformance');


// Timetable management routes
Route::get('/manage/timetable/list', ManageTimetableController::class . '@index')->name('manage.timetable.list'); // Display the list of timetables
Route::get('/manage/timetable/{id}', ManageTimetableController::class . '@display')->name('manage.timetable.list.show'); // Display a specific timetable
Route::get('/manage/timetable/list/create', ManageTimetableController::class . '@add')->name('manage.timetable.list.create'); // Show form for creating a timetable
Route::post('/manage/timetable', ManageTimetableController::class . '@store')->name('manage.timetable.list.store'); // Store a new timetable
Route::get('/manage/timetable/{timetable}/edit', ManageTimetableController::class . '@edit')->name('manage.timetable.list.edit'); // Show form for editing a timetable
Route::put('/manage/timetable/{timetable}', ManageTimetableController::class . '@update')->name('manage.timetable.list.update'); // Update a timetable
Route::delete('/manage/timetable/{timetable}', ManageTimetableController::class . '@delete')->name('manage.timetable.list.destroy'); // Delete a timetable
Route::get('/manage/timetable/{timetable}/confirm', ManageTimetableController::class . '@confirm')->name('manage.timetable.list.confirm'); // Confirmation for deleting a timetable
Route::get('/manage/timetable/req/{timetable}', ManageTimetableController::class . '@addRequest')->name('manage.timetable.list.reqform'); // Show form for adding a timetable request
Route::post('/manage/timetable/req', ManageTimetableController::class . '@storeRequest')->name('manage.timetable.list.reqrecord'); // Store a new timetable request
Route::get('/request/timetable/lists', ManageTimetableController::class . '@displayRequestList')->name('manage.timetable.list.request'); // Display list of timetable requests
Route::get('/manage/timetable/request/{id}', ManageTimetableController::class . '@displayRequest')->name('manage.timetable.list.showrequest'); // Display a specific timetable request
Route::delete('manage/timetable/request/delete/{requestID}', ManageTimetableController::class .'@deleteRequest')->name('manage.timetable.requestlist.delete'); // Delete a timetable request
