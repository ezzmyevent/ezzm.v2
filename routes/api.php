<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppApisController;

use App\Http\Controllers\Api\CronController;
use App\Http\Controllers\Api\OngroundController;
use App\Http\Controllers\Api\ZappingApiController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AppApisController::class, 'login']);



/* send  m-badge to already registered users */
Route::get('/sendmbadge_whatsapp', [CronController::class, 'sendwhatsappremidnerfirst']);
Route::get('/sendemail', [CronController::class, 'sendemail']);
Route::get('/sendotp', [CronController::class, 'sendotp']);

Route::get('/reminder_sendemail', [CronController::class, 'reminder_sendemail']);
Route::get('/send_reminder_whatsapp', [CronController::class, 'send_reminder_whatsapp']);
Route::get('/test', [CronController::class, 'test']);



Route::get('/whatsapp_one', [CronController::class, 'whatsapp_one']);
Route::get('/whatsapp_two', [CronController::class, 'whatsapp_two']);
Route::get('/whatsapp_three', [CronController::class, 'whatsapp_three']);


//api
Route::get('/login/{username?}', [OngroundController::class, 'login']);
Route::get('/search/{keyword?}', [OngroundController::class, 'search']);

Route::get('/get_form_details/{category_id?}', [OngroundController::class, 'get_form_details']);

Route::post('/update', [OngroundController::class, 'updateuser']);
Route::post('/usersave', [OngroundController::class, 'usersave']);


Route::post('/edituser', [OngroundController::class, 'edituserDetails']);

Route::post('/add_guest', [OngroundController::class, 'addGuest']);
Route::post('/allotdelegatekit', [OngroundController::class, 'allotDelegateKit']);
Route::post('/alloteduser', [OngroundController::class, 'alloteduser']);

// zapping api
Route::get('zapping/{location}/{code}',[ZappingApiController::class, 'zapping']);

// Mobile App API urls
Route::get('/app_login/{username?}', [AppApisController::class, 'login']);
Route::get('/search_user/{search?}', [AppApisController::class, 'search_user']);
Route::get('/save_onsite_user/{data?}', [AppApisController::class, 'save_onsite_user']);
Route::get('/entryzapping/{unique_code?}/{location?}', [AppApisController::class, 'entryzapping']);
Route::get('/update/{id}', [AppApisController::class, 'update']);