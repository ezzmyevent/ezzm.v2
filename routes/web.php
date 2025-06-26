<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RegisteruserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InterfacesController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InviteesController;
use App\Http\Controllers\AppApisController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Admin\MailTemplateController;

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


Route::get('/clear_cache', function() {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    dd('All Cache Cleared');
});

// Route::get('/', [AdminController::class, 'login'])->name('admin-login');
// Route::get('FeedbackForm', [UserController::class, 'FeedbackForm'])->name('FeedbackForm');
// Route::post('save_feedback', [UserController::class, 'saveFeedback'])->name('save_feedback');
// Route::match(['get','post'],'/save_feedback', [UserController::class, 'saveFeedback'])->name('save_feedback');

Route::get('/', [UserController::class, 'index'])->name('main');
Route::get('/ticketBookings/{slug?}', [UserController::class, 'ticketBookings'])->name('ticketBookings');
Route::get('/bookedTickets/{slug?}', [UserController::class, 'bookedTickets'])->name('bookedTickets');
Route::get('/addAttendees/{id?}/{slug?}', [UserController::class, 'addAttendees'])->name('addAttendees');
Route::get('/checkout/{slug?}', [UserController::class, 'checkout'])->name('checkout');
Route::get('/success/{user_id?}', [UserController::class, 'success'])->name('success');
Route::post('/checkSlotAvailability', [UserController::class, 'checkSlotAvailability'])->name('checkSlotAvailability');
Route::post('/saveActivities', [UserController::class, 'saveActivities'])->name('saveActivities');
Route::post('/saveAttendees', [UserController::class, 'saveAttendees'])->name('saveAttendees');
Route::get('/thanksActivity', [UserController::class, 'thanksActivity'])->name('thanksActivity');
Route::get('/getmbadge', [UserController::class, 'getmbadge'])->name('getmbadge');
Route::post('/findmbadge', [UserController::class, 'findmbadge'])->name('findmbadge');
Route::get('/mbadgedownload/{mbadge?}', [UserController::class, 'mbadgedownload'])->name('mbadgedownload');

//login routes
Route::get('/loginSelectUser/{user_id?}', [UserController::class, 'loginSelectUser'])->name('loginSelectUser');
Route::get('/attendeesUser/{user_id?}', [UserController::class, 'attendeesUser'])->name('attendeesUser');
Route::get('/event-status/{user_id?}', [UserController::class, 'eventStatus'])->name('event-status');
Route::post('/event-save-status', [UserController::class, 'eventSaveStatus'])->name('event-save-status');
Route::get('/thanks', [UserController::class, 'thanks'])->name('thanks');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/verifyOTP', [UserController::class, 'verifyOTP'])->name('verifyOTP');
Route::post('/resend-otp', [UserController::class, 'resendOTP'])->name('resendOTP');

//session work
Route::post('/addToCart', [UserController::class, 'addToCart'])->name('addToCart');
Route::post('/removeToCart', [UserController::class, 'removeToCart'])->name('removeToCart');
Route::post('/addNewAttendeeToCart', [UserController::class, 'addNewAttendeeToCart'])->name('addNewAttendeeToCart');
Route::post('/managePackageSummary', [UserController::class, 'managePackageSummary'])->name('managePackageSummary');
Route::post('/manageUserDetails', [UserController::class, 'manageUserDetails'])->name('manageUserDetails');


Route::get('/user_edit/{user_id?}', [UserController::class, 'user_edit'])->name('user_edit');
Route::match(['get','post'],'/user_update', [UserController::class, 'user_update'])->name('user_update');

Route::post('/check_slots', [UserController::class, 'checkAvailSlots'])->name('checkAvailSlots');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin'], function()
{
    Route::get('/login', [AdminController::class, 'login'])->name('admin-login');
    Route::post('/authenticate', [AdminController::class, 'authenticate']);
    Route::match(['get','post'],'/authenticate', [AdminController::class, 'authenticate'])->name('admin-authenticate');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'adminauth'], function()
    {
        Route::get('/index', [DashboardController::class, 'index'])->name('adminhome');
        Route::get('/dashboardpage', [DashboardController::class, 'dashboardpage'])->name('dashboardpage');
        Route::get('/eventStatus/{status?}', [DashboardController::class, 'eventStatus'])->name('eventStatus');
        Route::get('/mastersearch', [DashboardController::class, 'mastersearch'])->name('mastersearch');

      //  Route::get('/users', [RegisteruserController::class, 'index'])->name('users');
        Route::get('/GeneralRegistrations', [RegisteruserController::class, 'index'])->name('users');
        Route::get('/OnsiteRegistrations', [RegisteruserController::class, 'OnsiteRegistrations'])->name('OnsiteRegistrations');
        Route::get('/GeneralRegistrations/view/{id?}', [RegisteruserController::class, 'view'])->name('users-view');
        Route::get('/GeneralRegistrations/add', [RegisteruserController::class, 'add'])->name('users-add');
        Route::post('/GeneralRegistrations/save', [RegisteruserController::class, 'save'])->name('users-save');
        Route::get('/GeneralRegistrations/import', [RegisteruserController::class, 'import'])->name('users-import');
        // Route::post('/GeneralRegistrations/uploadcsv', [RegisteruserController::class, 'uploadcsv'])->name('users-uploadcsv');
        Route::post('/GeneralRegistrations/uploadcsvnew', [RegisteruserController::class, 'uploadcsvnew'])->name('users-uploadcsv');
        Route::get('/sampleExcel', [RegisteruserController::class, 'sampleExcel'])->name('sampleExcel');
        Route::get('/GeneralRegistrations/export', [RegisteruserController::class, 'export'])->name('users-export');
        Route::get('/exportUsers', [RegisteruserController::class, 'exportUsers'])->name('exportUsers');
        Route::get('/exportZappingUsers', [RegisteruserController::class, 'exportZappingUsers'])->name('exportZappingUsers');

        Route::get('/exportUsersAll', [RegisteruserController::class, 'exportUsersAll'])->name('exportUsersAll');
        Route::get('/exportRedemptionUsers', [RegisteruserController::class, 'exportRedemptionUsers'])->name('exportRedemptionUsers');
        Route::get('/exportonsiteuser', [RegisteruserController::class, 'exportonsiteuser'])->name('exportonsiteuser');
        Route::get('/exportUsersAllOnsite', [RegisteruserController::class, 'exportUsersAllOnsite'])->name('exportUsersAllOnsite');
        
        Route::get('/onspotExportUsers', [RegisteruserController::class, 'onspotExportUsers'])->name('onspotExportUsers');
        Route::get('/onspotExportUsersAll', [RegisteruserController::class, 'onspotExportUsersAll'])->name('onspotExportUsersAll');
        
        Route::get('/editregistration', [RegisteruserController::class, 'editregistration'])->name('editregistration');
        Route::post('/editregistrationforsave', [RegisteruserController::class, 'editregistrationforsave'])->name('editregistrationforsave');
        Route::get('/exportCategorywise/{type?}/{category?}', [RegisteruserController::class, 'exportCategorywise'])->name('exportCategorywise');
        Route::get('/exportLocationWiseZapping/{type?}/{category?}', [RegisteruserController::class, 'exportLocationWiseZapping'])->name('exportLocationWiseZapping');
        Route::post('/resendmail', [RegisteruserController::class, 'resendmail'])->name('resendmail'); 


        Route::get('/OnspotRegistrations', [RegisteruserController::class, 'onspot'])->name('onspot');
        Route::get('/EntryZapping', [RegisteruserController::class, 'entry_zapping'])->name('EntryZapping');
        Route::get('/Feedback', [RegisteruserController::class, 'feedback'])->name('Feedback');
        Route::get('/feedbackExport', [RegisteruserController::class, 'feedbackExport'])->name('feedbackExport');
        Route::get('/Feedback/view/{id?}', [RegisteruserController::class, 'feedback_view'])->name('feedback_view');


        Route::get('/mail-templates', [MailTemplateController::class, 'index'])->name('mail-template.index');
        Route::get('/mail-template/create', [MailTemplateController::class, 'create'])->name('mail-template.create');
        Route::post('/mail-template/store', [MailTemplateController::class, 'store'])->name('mail-template.store');
        Route::get('/mail-template/edit/{id}', [MailTemplateController::class, 'edit'])->name('mail-template.edit');
        Route::post('/mail-template/update', [MailTemplateController::class, 'update'])->name('mail-template.update');
        Route::get('/mail-template/destroy/{id}', [MailTemplateController::class, 'destroy'])->name('mail-template.destroy');

        Route::post('/shortcode/add', [MailTemplateController::class, 'addshortcode'])->name('shortcode.store');
        Route::post('/shortcode/list', [MailTemplateController::class, 'shortcodelist'])->name('shortcode.list');
    
        Route::post('/sendmailforchecktemplate', [MailTemplateController::class,'sendMailForCheckTemplate'])->name('mail-template.sendtemplatemail');
        Route::post('/sendmailtouser', [MailTemplateController::class,'sendMailToUser'])->name('mail-template.sendmailtouser');
    Route::post('/activetocron', [MailTemplateController::class, 'activetocron'])->name('activetocron');

        // tickets routes
        Route::get('/tickets', [TicketsController::class, 'index'])->name('tickets');
        Route::get('/tickets/create', [TicketsController::class, 'create'])->name('tickets.create');
        Route::get('/tickets/add', [TicketsController::class, 'add'])->name('tickets-add');
        Route::post('/tickets/save', [TicketsController::class, 'save'])->name('tickets-save');
        Route::get('/tickets/edit/{id}', [TicketsController::class, 'edit'])->name('tickets.edit');
        Route::post('/tickets/update', [TicketsController::class, 'update'])->name('tickets.update');
        Route::get('/tickets/view/{id?}', [TicketsController::class, 'view'])->name('tickets-view');
        Route::get('/tickets/status/{id?}', [TicketsController::class, 'status'])->name('tickets-status');
        //tickets routes end
        //Route::get('/eticket', [RegisteruserController::class, 'eticket'])->name('eticket');
        
        /*
        Route::post('/adduser', [RegisteruserController::class, 'adduser']);
        Route::match(['get','post'],'/adduser', [RegisteruserController::class, 'adduser'])->name('adduser');

        Route::post('/uploadUsercsv', [RegisteruserController::class, 'uploadUsercsv']);
        Route::match(['get','post'],'/uploadUsercsv', [RegisteruserController::class, 'uploadUsercsv'])->name('uploadUsercsv');
        Route::post('/changeStatus', [RegisteruserController::class, 'changeStatus']);
        Route::match(['get','post'],'/changeStatus', [RegisteruserController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/deleteUser', [RegisteruserController::class, 'deleteUser']);
        Route::post('/emailUser', [RegisteruserController::class, 'emailUser'])->name('emailUser');
        Route::post('/emailMember', [RegisteruserController::class, 'emailMember'])->name('emailMember');
        Route::match(['get','post'],'/deleteUser', [RegisteruserController::class, 'deleteUser'])->name('deleteUser');
        Route::get('/resetUsers', [RegisteruserController::class, 'resetUsers'])->name('resetUsers');

        Route::get('/exportAttendees', [RegisteruserController::class, 'exportAttendees'])->name('exportAttendees');
        Route::post('/exportAttendeesByDate', [RegisteruserController::class, 'exportAttendeesByDate']);
        Route::match(['get','post'],'/exportAttendeesByDate', [RegisteruserController::class, 'exportAttendeesByDate'])->name('exportAttendeesByDate');

        Route::get('/event-details', [EventController::class, 'event_details'])->name('event_details');
        Route::post('/uploadImg', [EventController::class, 'uploadImg'])->name('uploadImg');

        //tickets
        Route::get('/tickets', [TicketsController::class, 'index'])->name('tickets');
        Route::get('/tickets/add', [TicketsController::class, 'add'])->name('tickets-add');
        Route::post('/tickets/save', [TicketsController::class, 'save'])->name('tickets-save');
        Route::get('/tickets/view/{id?}', [TicketsController::class, 'view'])->name('tickets-view');
        Route::get('/tickets/status/{id?}', [TicketsController::class, 'status'])->name('tickets-status');
        //tickets

        //coupons
        Route::get('/coupons', [CouponsController::class, 'index'])->name('coupons');
        Route::get('/coupons/add', [CouponsController::class, 'add'])->name('coupons-add');
        Route::post('/coupons/save', [CouponsController::class, 'save'])->name('coupons-save');
        Route::get('/coupons/view/{id?}', [CouponsController::class, 'view'])->name('coupons-view');
        Route::get('/coupons/status/{id?}', [CouponsController::class, 'status'])->name('coupons-status');
        Route::get('/coupons/delete/{id?}', [CouponsController::class, 'delete'])->name('coupons-delete');
        //coupons

//Naveen Views
        Route::get('/coupon', [RegisteruserController::class, 'coupon'])->name('coupon');
        Route::get('/sales-report', [RegisteruserController::class, 'sales_report'])->name('sales_report');
        Route::get('/ticket-type-detail', [RegisteruserController::class, 'ticket_type_detail'])->name('ticket_type_detail');        
        Route::get('/form', [RegisteruserController::class, 'form'])->name('form');
        Route::get('/attendee-enquiries', [RegisteruserController::class, 'attendee_enquiries'])->name('attendee_enquiries');
        Route::get('/edit-email', [RegisteruserController::class, 'edit_email'])->name('edit_email');
        //Naveen Views
        
        Route::get('/sampleVIPUserExcel', [InterfacesController::class, 'sampleVIPUserExcel'])->name('sampleVIPUserExcel');
        Route::get('/email-builder', [RegisteruserController::class, 'email_builder'])->name('email_builder');
        */
    });
    
});

 /* Email crons */
 Route::get('/ConfirmationEmail/{limit?}', [EmailController::class, 'ConfirmationEmail'])->name('ConfirmationEmail');
 Route::get('/ReminderEmail/{limit?}', [EmailController::class, 'ReminderEmail'])->name('ReminderEmail');
 Route::get('/FeedbackEmail/{limit?}', [EmailController::class, 'FeedbackEmail'])->name('FeedbackEmail');

//Mpbile App API urls
Route::get('/app_login/{username?}', [AppApisController::class, 'login']);
Route::get('/search_user/{search?}', [AppApisController::class, 'search_user']);
Route::get('/save_onsite_user/{data?}', [AppApisController::class, 'save_onsite_user']);
Route::get('/entryzapping/{unique_code?}/{location?}', [AppApisController::class, 'entryzapping']);
Route::get('/update/{id?}', [AppApisController::class, 'update']);

