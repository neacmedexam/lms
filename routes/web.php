<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\FbController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ImportExportInquiries;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\leadDashboardController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\WebAcquisitionController;
use App\Http\Controllers\EventsController;
use App\Models\WebAcquisitionModel;

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
    if(!auth()->user()){
            return view('login', [UserController::class, 'showLogin']);
    }
    else{
        redirect('/home');
    }
})->name('login')->middleware('guest');
//login auth


Route::post('/users/login', [UserController::class,'authenticate']);

Auth::routes();


//logout
Route::post('/logout',[UserController::class, 'logout']);

//-----------------------------------------------------------------------------------home-dashboard
// Route::get('/home', function(){
//     return view('home.homepage');
// });

Route::get('/home', [HomepageController::class, 'showHomepage'])->middleware('auth');
Route::get('/home/search', [HomepageController::class, 'search'])->middleware('auth');
//-----------------------------------------------------------------------------------Account Profile
Route::get('/myprofile/edit/{id}',[AccountsController::class, 'myProfile'])->middleware('auth');

//submit edit employee
Route::put('/myprofile/{edit}', [AccountsController::class,'editProfile'])->middleware('auth');
//---show change password page
Route::get('/myprofile/changepassword/{edit}', [AccountsController::class, 'showChangePasswordPage'])->middleware('auth');


Route::put('/myprofile/changepassword/{edit}', [AccountsController::class,'updatePassword'])->middleware('auth');

//-----------------------------------------------------------------------------------EMPLOYEES
//show Add Employee page

Route::get('/addemployee', [AccountsController::class, 'showAddEmployee'])->middleware('auth');
//show view Employee page
Route::get('/viewemployee',[AccountsController::class, 'viewemployee'])->middleware('auth');
//Create Employees
Route::post('/addemployee', [AccountsController::class, 'addEmployee'])->middleware('auth');



//---Edit employeees
//show edit employee
Route::get('viewemployee/edit/{id}', [AccountsController::class,'showEditEmployee'])->middleware('auth');
//submit edit employee
Route::put('/viewemployee/{edit}', [AccountsController::class,'edit'])->middleware('auth');


//---Delete employees
Route::put('/deleteemployee/{account}', [AccountsController::class,'deleteAccount'])->middleware('auth');
//---reactivate employee
Route::put('/reactivateemployee/{account}',[AccountsController::class,'reactivateAccount'])->middleware('auth');

//-----------------------------------------------------------------------------------/EMPLOYEE




//-----------------------------------------------------------------------------------INQUIRIES
//show Add Inquiry page
Route::get('/addinquiry', [InquiryController::class, 'showAddInquiries'])->middleware('auth');
// show add inquiry page for receptionnist
Route::get('/addinquiries', [InquiryController::class, 'showAddInquiries'])->middleware('auth');
//show View Inquiry page
Route::get('/viewinquiries/{inqID}', [InquiryController::class, 'forViewInquiries'])->middleware('auth');
//show View Inquiry page for Edit
Route::get('/viewinquiries', [InquiryController::class, 'viewInquiries'])->middleware('auth');
//Create Inquiry
Route::post('/addinquiry', [InquiryController::class, 'addInquiry'])->middleware('auth');

//---Edit Inquiries
Route::get('/viewinquiries/edit/{inqID}', [InquiryController::class, 'showEditInquiries'])->middleware('auth');
//submit edit inquiry
Route::put('/viewinquiries/{edit}', [InquiryController::class,'edit'])->middleware('auth');
//request edit inquiry
Route::put('/viewinquiries/{edit}/request', [InquiryController::class,'requestEditInquiry'])->middleware('auth');
//accept edit inquiry request
Route::put('/viewinquiries/{lcID}/accept', [InquiryController::class,'acceptLcRequest'])->middleware('auth');
//---Delete inquiry
Route::put('/deleteinquiry/delete/{inqID}', [InquiryController::class,'deleteInquiry'])->middleware('auth');
//---reactivate Inquiry
Route::put('/reactivateinquiry/{inqID}',[InquiryController::class,'reactivateInquiry'])->middleware('auth');

//---IMPORT INQUIRIES
Route::get('/importinquiries', [InquiryController::class, 'showImportInquiries'])->middleware('auth');



//---LC dashboard
Route::get('/lcdashboard', [leadDashboardController::class, 'showDashboard'])->middleware('auth');
Route::get('/lcdashboard/search', [leadDashboardController::class, 'search'])->middleware('auth');

//---ADD REPORT
Route::get('/addreport/categories', [CampaignController::class, 'showAddReportCategories'])->middleware('auth');
//---EDIT REPORT
Route::get('/editreport/categories', [CampaignController::class, 'showEditReportCategories'])->middleware('auth');
//---CATEGORIES
Route::get('/viewreports/category', [CampaignController::class, 'showCategories'])->middleware('auth');


//---EVENTS
Route::get('/events/showaddevents', [EventsController::class, 'showAddEvents'])->middleware('auth');
Route::post('/events/addevents', [EventsController::class, 'addEvents'])->middleware('auth');
Route::get('/events/viewevents', [EventsController::class, 'viewEvents'])->middleware('auth');
Route::get('/events/viewevents/edit/{id}', [EventsController::class, 'showEditEvent'])->middleware('auth')->name('events.edit');
Route::put('/events/viewevents/edit/{id}/update', [EventsController::class, 'editEvent'])->middleware('auth')->name('events.update');
Route::put('/events/viewevents/edit/{id}/delete', [EventsController::class, 'deleteEvent'])->middleware('auth')->name('events.deleteevent');
Route::put('/events/viewevents/edit/{id}/reactivate', [EventsController::class, 'reactivateEvent'])->middleware('auth')->name('events.reactivateevent');

//--EVENTS RECORDS

Route::get('/events/{id}/addparticipants', [EventsController::class, 'showAddParticipants'])->middleware('auth')->name('events.showaddparticipants');
Route::post('/events/addparticipants/', [EventsController::class, 'addParticipants'])->middleware('auth')->name('events.addparticipants');
Route::get('/events/participant/{id}', [EventsController::class, 'showEditParticipants'])->middleware('auth')->name('events.viewparticipants');
Route::put('/events/participant/{id}/edit', [EventsController::class, 'editParticipant'])->middleware('auth')->name('events.editparticipant');
Route::put('/events/participant/{id}/delete', [EventsController::class, 'deleteParticipant'])->middleware('auth')->name('events.deleteparticipant');
Route::put('/events/participant/{id}/reactivate', [EventsController::class, 'reactivateParticipant'])->middleware('auth')->name('events.reactivateparticipant');
Route::get('/events/viewevents/record/{id}', [EventsController::class, 'viewEventsRecords'])->middleware('auth')->name('events.vieweventsrecords');



//---CATEGORY FB ANALYTICS
Route::get('/viewreport/fbanalytics', [FbController::class, 'showFbAnalytics'])->middleware('auth');
Route::get('/viewreport/fbanalytics/search', [FbController::class, 'searchFbAnalytics'])->middleware('auth');
//show Add Report FB ANALYTICS page
Route::get('/addreport/fbanalytics', [FbController::class, 'showAddReportFB'])->middleware('auth');
//Create Report FB ANALYTICS
Route::post('/addreport/fbanalytics', [FbController::class, 'addFbAnalytics'])->middleware('auth');
//View Report
Route::get('/editreport/fbanalytics', [FbController::class, 'viewFbAnalyticsRecord'])->middleware('auth');
//Show Edit Report
Route::get('/editreport/fbanalytics/edit/{fbanalytics_number}', [FbController::class, 'showEditFbAnalyticsReport'])->middleware('auth');
//Edit report
Route::put('/editreport/fbanalytics/edit/{edit}', [FbController::class,'editFbAnalyticsRecord'])->middleware('auth');
//Delete report
Route::put('/deletereport/fbanalytics/{edit}', [FbController::class,'deleteFbAnalyticsRecord'])->middleware('auth');
//Reactivate Report
Route::put('/reactivatereport/fbanalytics/{edit}',[FbController::class,'reactivateFbAnalyticsReport'])->middleware('auth');



//---CATEGORY WEB ACQUISITION
Route::get('/viewreport/webacquisition', [WebAcquisitionController::class, 'showWebAcquisition'])->middleware('auth');
Route::get('/viewreport/webacquisition/search', [WebAcquisitionController::class, 'searchWebAcquisition'])->middleware('auth');
//show Add Report  WEB ACQUISITION page
Route::get('/addreport/webacquisition', [WebAcquisitionController::class, 'showAddReportWebAcquisition'])->middleware('auth');
//Create Report  WEB ACQUISITION
Route::post('/addreport/webacquisition', [WebAcquisitionController::class, 'addWebAcquisition'])->middleware('auth');
//View Report
Route::get('/editreport/webacquisition', [WebAcquisitionController::class, 'viewWebAcquisitionRecord'])->middleware('auth');
//Show Edit Report
Route::get('/editreport/webacquisition/edit/{webacquisition_number}', [WebAcquisitionController::class, 'showEditWebAcquisitionReport'])->middleware('auth');
//Edit report
Route::put('/editreport/webacquisition/edit/{edit}', [WebAcquisitionController::class,'editWebAcquisitionRecord'])->middleware('auth');
//Delete report
Route::put('/deletereport/webacquisition/{edit}', [WebAcquisitionController::class,'deleteWebAcquisitionRecord'])->middleware('auth');
//Reactivate Report
Route::put('/reactivatereport/webacquisition/{edit}',[WebAcquisitionController::class,'reactivateWebAcquisitionReport'])->middleware('auth');




//---CATEGORY Campaign Dashboard
Route::get('/viewreport/campaigndashboard', [CampaignController::class, 'showCampaignDashboard'])->middleware('auth');
Route::get('/viewreport/campaigndashboard/search', [CampaignController::class, 'searchCampaign'])->middleware('auth');
//show Add Campaign page
Route::get('/addreport/campaign', [CampaignController::class, 'showAddReportCampaign'])->middleware('auth');
//View Report
Route::get('/editreport/campaign', [CampaignController::class, 'viewCampaignRecord'])->middleware('auth');
//Show Edit Report
Route::get('/editreport/campaign/edit/{campaign_number}', [CampaignController::class, 'showEditReport'])->middleware('auth');
//Edit report
Route::put('/editreport/campaign/edit/{edit}', [CampaignController::class,'editCampaignRecord'])->middleware('auth');
//Delete report
Route::put('/deletereport/campaign/{edit}', [CampaignController::class,'deleteCampaignRecord'])->middleware('auth');
//Reactivate Report
Route::put('/reactivatereport/campaign/{edit}',[CampaignController::class,'reactivateReport'])->middleware('auth');

//Create Report Campaign
Route::post('/addreport/campaign', [CampaignController::class, 'addReport'])->middleware('auth');


//---Settings Controller

Route::get('/settings', [SettingsController::class, 'showSettings'])->middleware('auth');

//---Scoring

//showEditScoring
Route::get('/settings/scoring/edit/{scoringID}', [SettingsController::class, 'showEditScoring'])->middleware('auth');
//Submit Edit Scoring
Route::put('/settings/scoring/edit/{edit}', [SettingsController::class,'editScoring'])->middleware('auth');
//showAddScoring
Route::get('/settings/services/addscoring',[SettingsController::class, 'showAddScoring'])->middleware('auth');
//addScoring
Route::post('/settings/services/addnewscoring', [SettingsController::class, 'addScoring'])->middleware('auth');
//Delete Scoring
Route::put('/deletescoring/{scoringID}', [SettingsController::class,'deleteScoring'])->middleware('auth');
//---reactivate scoring
Route::put('/reactivatescoring/{scoringID}',[SettingsController::class,'reactivateScoring'])->middleware('auth');


//---Status

//showEditStatus
Route::get('/settings/inquirystatus/edit/{statusID}', [SettingsController::class, 'showEditStatus'])->middleware('auth');
//Submit Edit Status
Route::put('/settings/inquirystatus/edit/{edit}', [SettingsController::class,'editStatus'])->middleware('auth');
//showAddStatus
Route::get('/settings/services/addstatus',[SettingsController::class, 'showAddStatus'])->middleware('auth');
//addStatus
Route::post('/settings/services/addnewinquirystatus', [SettingsController::class, 'addStatus'])->middleware('auth');
//Delete Status
Route::put('/deletestatus/{statusID}', [SettingsController::class,'deleteStatus'])->middleware('auth');
//reactivate status
Route::put('/reactivatestatus/{statusID}',[SettingsController::class,'reactivateStatus'])->middleware('auth');



//---UserType

//showEditUserType
Route::get('/settings/usertype/edit/{utID}', [SettingsController::class, 'showEditUsertype'])->middleware('auth');
//Submit Edit UserType
Route::put('/settings/usertype/edit/{edit}', [SettingsController::class,'editUsertype'])->middleware('auth');
//showAddUserType
Route::get('/settings/services/addusertype',[SettingsController::class, 'showAddUserType'])->middleware('auth');
//addUserType
Route::post('/settings/services/addnewusertype', [SettingsController::class, 'addUserType'])->middleware('auth');
//Delete UserType
Route::put('/deleteusertype/{utID}', [SettingsController::class,'deleteUsertype'])->middleware('auth');
//reactivate UserType
Route::put('/reactivateusertype/{utID}',[SettingsController::class,'reactivateUserType'])->middleware('auth');


//---LeadSource

//showEditLeadSource
Route::get('/settings/leadsource/edit/{leadsourceID}', [SettingsController::class, 'showEditLeadSource'])->middleware('auth');
//Submit Edit LeadSource
Route::put('/settings/leadsource/edit/{edit}', [SettingsController::class,'editLeadSource'])->middleware('auth');
//showLeadSource
Route::get('/settings/services/addleadsource',[SettingsController::class, 'showAddLeadSource'])->middleware('auth');
//addLeadSource
Route::post('/settings/services/addnewleadsource', [SettingsController::class, 'addLeadSource'])->middleware('auth');
//Delete LeadSource
Route::put('/deleteleadsource/{leadsourceID}', [SettingsController::class,'deleteLeadSource'])->middleware('auth');
//reactivate LeadSource
Route::put('/reactivateleadsource/{leadsourceID}',[SettingsController::class,'reactivateLeadSource'])->middleware('auth');


//---Services

//showEditServices
Route::get('/settings/services/edit/{serviceID}', [SettingsController::class, 'showEditServices'])->middleware('auth');
//Submit Edit Services
Route::put('/settings/{edit}', [SettingsController::class,'editServices'])->middleware('auth');
//showAddServices
Route::get('/settings/services/addservice',[SettingsController::class, 'showAddServices'])->middleware('auth');
//addService
Route::post('/settings/services/addnewservice', [SettingsController::class, 'addService'])->middleware('auth');
//Delete Services
Route::put('/deleteservice/{serviceID}', [SettingsController::class,'deleteServices'])->middleware('auth');
//reactivate Services
Route::put('/reactivateservice/{serviceID}',[SettingsController::class,'reactivateService'])->middleware('auth');


///////////////MAIL

// Route::get('send-mail', function () {
   
//     $details = [
//         'title' => 'Mail from ItSolutionStuff.com',
//         'body' => 'This is for testing email using smtp'
//     ];
   
//     Mail::to('trestizajason1@gmail.com')->send(new \App\Mail\MyMail($details));
   
//     dd("Email is Sent.");
// });

Route::get('/sendmail/{id}', [MailController::class, 'showSendMail']);

Route::post('/sendmail/send/{id}',[MailController::class, 'sendMail']);


//////////////////EXPORT IMPORT 

Route::controller(ImportExportInquiries::class)->group(function(){
    Route::get('users', 'index');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');
});