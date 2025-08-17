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
use Illuminate\Support\Facades\Artisan;

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

 //Route::get('/', [AdminController::class, 'login'])->name('admin-login');
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

Route::prefix('admin')->group(function() {
    Route::get('/login', [\App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login');
    Route::post('/authenticate', [\App\Http\Controllers\Admin\AdminController::class, 'authenticate']);
    Route::match(['get','post'],'/authenticate', [\App\Http\Controllers\Admin\AdminController::class, 'authenticate'])->name('admin.authenticate');
    Route::get('/logout', [\App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('logout');

    Route::middleware('adminauth')->group(function() {
        Route::get('/index', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('adminhome');
        Route::get('/dashboardpage', [\App\Http\Controllers\Admin\DashboardController::class, 'dashboardpage'])->name('dashboardpage');
        Route::get('/eventStatus/{status?}', [\App\Http\Controllers\Admin\DashboardController::class, 'eventStatus'])->name('eventStatus');
        Route::get('/mastersearch', [\App\Http\Controllers\Admin\DashboardController::class, 'mastersearch'])->name('mastersearch');
        Route::get('/GeneralRegistrations', [\App\Http\Controllers\Admin\RegisteruserController::class, 'index'])->name('users');
        Route::get('/OnsiteRegistrations', [\App\Http\Controllers\Admin\RegisteruserController::class, 'OnsiteRegistrations'])->name('OnsiteRegistrations');
        Route::get('/GeneralRegistrations/view/{id?}', [\App\Http\Controllers\Admin\RegisteruserController::class, 'view'])->name('users-view');
        Route::get('/GeneralRegistrations/add', [\App\Http\Controllers\Admin\RegisteruserController::class, 'add'])->name('users-add');
        Route::post('/GeneralRegistrations/save', [\App\Http\Controllers\Admin\RegisteruserController::class, 'save'])->name('users-save');
        Route::get('/GeneralRegistrations/import', [\App\Http\Controllers\Admin\RegisteruserController::class, 'import'])->name('users-import');
        Route::post('/GeneralRegistrations/uploadcsvnew', [\App\Http\Controllers\Admin\RegisteruserController::class, 'uploadcsvnew'])->name('users-uploadcsv');
        Route::get('/sampleExcel', [\App\Http\Controllers\Admin\RegisteruserController::class, 'sampleExcel'])->name('sampleExcel');
        Route::get('/GeneralRegistrations/export', [\App\Http\Controllers\Admin\RegisteruserController::class, 'export'])->name('users-export');
        Route::get('/exportUsers', [\App\Http\Controllers\Admin\RegisteruserController::class, 'exportUsers'])->name('exportUsers');
        Route::get('/exportZappingUsers', [\App\Http\Controllers\Admin\RegisteruserController::class, 'exportZappingUsers'])->name('exportZappingUsers');
        Route::get('/exportUsersAll', [\App\Http\Controllers\Admin\RegisteruserController::class, 'exportUsersAll'])->name('exportUsersAll');
        Route::get('/exportRedemptionUsers', [\App\Http\Controllers\Admin\RegisteruserController::class, 'exportRedemptionUsers'])->name('exportRedemptionUsers');
        Route::get('/exportonsiteuser', [\App\Http\Controllers\Admin\RegisteruserController::class, 'exportonsiteuser'])->name('exportonsiteuser');
        Route::get('/exportUsersAllOnsite', [\App\Http\Controllers\Admin\RegisteruserController::class, 'exportUsersAllOnsite'])->name('exportUsersAllOnsite');
        Route::get('/onspotExportUsers', [\App\Http\Controllers\Admin\RegisteruserController::class, 'onspotExportUsers'])->name('onspotExportUsers');
        Route::get('/onspotExportUsersAll', [\App\Http\Controllers\Admin\RegisteruserController::class, 'onspotExportUsersAll'])->name('onspotExportUsersAll');
        Route::get('/editregistration', [\App\Http\Controllers\Admin\RegisteruserController::class, 'editregistration'])->name('editregistration');
        Route::post('/editregistrationforsave', [\App\Http\Controllers\Admin\RegisteruserController::class, 'editregistrationforsave'])->name('editregistrationforsave');
        Route::get('/exportCategorywise/{type?}/{category?}', [\App\Http\Controllers\Admin\RegisteruserController::class, 'exportCategorywise'])->name('exportCategorywise');
        Route::get('/exportLocationWiseZapping/{type?}/{category?}', [\App\Http\Controllers\Admin\RegisteruserController::class, 'exportLocationWiseZapping'])->name('exportLocationWiseZapping');
        Route::post('/resendmail', [\App\Http\Controllers\Admin\RegisteruserController::class, 'resendmail'])->name('resendmail');
        Route::get('/OnspotRegistrations', [\App\Http\Controllers\Admin\RegisteruserController::class, 'onspot'])->name('onspot');
        Route::get('/EntryZapping', [\App\Http\Controllers\Admin\RegisteruserController::class, 'entry_zapping'])->name('EntryZapping');
        Route::get('/Feedback', [\App\Http\Controllers\Admin\RegisteruserController::class, 'feedback'])->name('Feedback');
        Route::get('/feedbackExport', [\App\Http\Controllers\Admin\RegisteruserController::class, 'feedbackExport'])->name('feedbackExport');
        Route::get('/Feedback/view/{id?}', [\App\Http\Controllers\Admin\RegisteruserController::class, 'feedback_view'])->name('feedback_view');
        Route::get('/mail-templates', [\App\Http\Controllers\Admin\MailTemplateController::class, 'index'])->name('mail-template.index');
        Route::get('/mail-template/create', [\App\Http\Controllers\Admin\MailTemplateController::class, 'create'])->name('mail-template.create');
        Route::post('/mail-template/store', [\App\Http\Controllers\Admin\MailTemplateController::class, 'store'])->name('mail-template.store');
        Route::get('/mail-template/edit/{id}', [\App\Http\Controllers\Admin\MailTemplateController::class, 'edit'])->name('mail-template.edit');
        Route::post('/mail-template/update', [\App\Http\Controllers\Admin\MailTemplateController::class, 'update'])->name('mail-template.update');
        Route::get('/mail-template/destroy/{id}', [\App\Http\Controllers\Admin\MailTemplateController::class, 'destroy'])->name('mail-template.destroy');
        Route::post('/shortcode/add', [\App\Http\Controllers\Admin\MailTemplateController::class, 'addshortcode'])->name('shortcode.store');
        Route::post('/shortcode/list', [\App\Http\Controllers\Admin\MailTemplateController::class, 'shortcodelist'])->name('shortcode.list');
        Route::post('/sendmailforchecktemplate', [\App\Http\Controllers\Admin\MailTemplateController::class,'sendMailForCheckTemplate'])->name('mail-template.sendtemplatemail');
        Route::post('/sendmailtouser', [\App\Http\Controllers\Admin\MailTemplateController::class,'sendMailToUser'])->name('mail-template.sendmailtouser');
        Route::post('/activetocron', [\App\Http\Controllers\Admin\MailTemplateController::class, 'activetocron'])->name('activetocron');
        Route::get('/tickets', [\App\Http\Controllers\Admin\TicketsController::class, 'index'])->name('tickets');
        Route::get('/tickets/create', [\App\Http\Controllers\Admin\TicketsController::class, 'create'])->name('tickets.create');
        Route::get('/tickets/add', [\App\Http\Controllers\Admin\TicketsController::class, 'add'])->name('tickets-add');
        Route::post('/tickets/save', [\App\Http\Controllers\Admin\TicketsController::class, 'save'])->name('tickets-save');
        Route::get('/tickets/edit/{id}', [\App\Http\Controllers\Admin\TicketsController::class, 'edit'])->name('tickets.edit');
        Route::post('/tickets/update', [\App\Http\Controllers\Admin\TicketsController::class, 'update'])->name('tickets.update');
        Route::get('/tickets/view/{id?}', [\App\Http\Controllers\Admin\TicketsController::class, 'view'])->name('tickets-view');
        Route::get('/tickets/status/{id?}', [\App\Http\Controllers\Admin\TicketsController::class, 'status'])->name('tickets-status');
        Route::get('/eticket', [\App\Http\Controllers\Admin\RegisteruserController::class, 'eticket'])->name('eticket');
        Route::post('/adduser', [\App\Http\Controllers\Admin\RegisteruserController::class, 'adduser']);
        Route::match(['get','post'],'/adduser', [\App\Http\Controllers\Admin\RegisteruserController::class, 'adduser'])->name('adduser');
        Route::post('/uploadUsercsv', [\App\Http\Controllers\Admin\RegisteruserController::class, 'uploadUsercsv']);
        Route::match(['get','post'],'/uploadUsercsv', [\App\Http\Controllers\Admin\RegisteruserController::class, 'uploadUsercsv'])->name('uploadUsercsv');
        Route::post('/changeStatus', [\App\Http\Controllers\Admin\RegisteruserController::class, 'changeStatus']);
        Route::match(['get','post'],'/changeStatus', [\App\Http\Controllers\Admin\RegisteruserController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/deleteUser', [\App\Http\Controllers\Admin\RegisteruserController::class, 'deleteUser']);
        Route::post('/emailUser', [\App\Http\Controllers\Admin\RegisteruserController::class, 'emailUser'])->name('emailUser');
        Route::post('/emailMember', [\App\Http\Controllers\Admin\RegisteruserController::class, 'emailMember'])->name('emailMember');
        Route::match(['get','post'],'/deleteUser', [\App\Http\Controllers\Admin\RegisteruserController::class, 'deleteUser'])->name('deleteUser');
        Route::get('/resetUsers', [\App\Http\Controllers\Admin\RegisteruserController::class, 'resetUsers'])->name('resetUsers');
        Route::get('/exportAttendees', [\App\Http\Controllers\Admin\RegisteruserController::class, 'exportAttendees'])->name('exportAttendees');
        Route::post('/exportAttendeesByDate', [\App\Http\Controllers\Admin\RegisteruserController::class, 'exportAttendeesByDate']);
        Route::match(['get','post'],'/exportAttendeesByDate', [\App\Http\Controllers\Admin\RegisteruserController::class, 'exportAttendeesByDate'])->name('exportAttendeesByDate');
        Route::get('/event-details', [\App\Http\Controllers\Admin\EventController::class, 'event_details'])->name('event_details');
        Route::post('/uploadImg', [\App\Http\Controllers\Admin\EventController::class, 'uploadImg'])->name('uploadImg');
        // duplicate tickets routes removed (already defined above)
        Route::get('/coupons', [\App\Http\Controllers\Admin\CouponsController::class, 'index'])->name('coupons');
        Route::get('/coupons/add', [\App\Http\Controllers\Admin\CouponsController::class, 'add'])->name('coupons-add');
        Route::post('/coupons/save', [\App\Http\Controllers\Admin\CouponsController::class, 'save'])->name('coupons-save');
        Route::get('/coupons/view/{id?}', [\App\Http\Controllers\Admin\CouponsController::class, 'view'])->name('coupons-view');
        Route::get('/coupons/status/{id?}', [\App\Http\Controllers\Admin\CouponsController::class, 'status'])->name('coupons-status');
        Route::get('/coupons/delete/{id?}', [\App\Http\Controllers\Admin\CouponsController::class, 'delete'])->name('coupons-delete');
        Route::get('/coupon', [\App\Http\Controllers\Admin\RegisteruserController::class, 'coupon'])->name('coupon');
        Route::get('/sales-report', [\App\Http\Controllers\Admin\RegisteruserController::class, 'sales_report'])->name('sales_report');
        Route::get('/ticket-type-detail', [\App\Http\Controllers\Admin\RegisteruserController::class, 'ticket_type_detail'])->name('ticket_type_detail');
        Route::get('/form', [\App\Http\Controllers\Admin\RegisteruserController::class, 'form'])->name('form');
        Route::get('/attendee-enquiries', [\App\Http\Controllers\Admin\RegisteruserController::class, 'attendee_enquiries'])->name('attendee_enquiries');
        Route::get('/edit-email', [\App\Http\Controllers\Admin\RegisteruserController::class, 'edit_email'])->name('edit_email');
        Route::get('/sampleVIPUserExcel', [\App\Http\Controllers\Admin\InterfacesController::class, 'sampleVIPUserExcel'])->name('sampleVIPUserExcel');
        Route::get('/email-builder', [\App\Http\Controllers\Admin\RegisteruserController::class, 'email_builder'])->name('email_builder');    });
});

 /* Email crons */
 Route::get('/ConfirmationEmail/{limit?}', [EmailController::class, 'ConfirmationEmail'])->name('ConfirmationEmail');
 Route::get('/ReminderEmail/{limit?}', [EmailController::class, 'ReminderEmail'])->name('ReminderEmail');
 Route::get('/FeedbackEmail/{limit?}', [EmailController::class, 'FeedbackEmail'])->name('FeedbackEmail');



