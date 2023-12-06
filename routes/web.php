<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\EventMemberController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\UserController;
use App\Models\EventMember;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/sign-up', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/sign-up', [RegisterController::class, 'store']);

Route::get('/sign-in', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/sign-in', [LoginController::class, 'authenticate']);
Route::get('/forgot-password', [LoginController::class, 'forgot_password_view']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::put('/change-password', [LoginController::class, 'updatePassword'])->middleware('auth');

Route::get('/', [UserController::class, 'index'])->middleware('auth');
Route::get('/reminder', [UserController::class, 'reminder'])->middleware('auth');
Route::get('/ongoing', [UserController::class, 'ongoing'])->middleware('auth');
Route::get('/upcoming', [UserController::class, 'upcoming'])->middleware('auth');
Route::get('/profile/{id}', [UserController::class, 'profile_view'])->middleware('auth');
Route::get('/profile/{id}/edit', [UserController::class, 'edit_view'])->middleware('auth');
Route::get('/profile/{id}/password', [UserController::class, 'password_view'])->middleware('auth');
Route::put('/profile', [UserController::class, 'update'])->middleware('auth');
Route::delete('/account', [UserController::class, 'destroy'])->middleware('auth');

Route::post('/users/{id}/profile-picture', [ImageController::class, 'changeProfilePicture'])->middleware('auth');
Route::delete('/users/{id}/profile-picture', [ImageController::class, 'delete'])->middleware('auth');

Route::get('/events', [EventController::class, 'index_view'])->middleware('auth');
Route::get('/events/create', [EventController::class, 'create_view'])->middleware('auth');
Route::post('/events', [EventController::class, 'create'])->middleware('auth');
Route::get('/events/{id}/detail', [EventController::class, 'detail'])->middleware('auth');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');
Route::get('/events/join', [EventController::class, 'join_view'])->middleware('auth');
Route::post('/events/join', [EventController::class, 'join'])->middleware('auth');
Route::get('/events/join/redirect', [EventController::class, 'join_redirect'])->middleware('auth');
Route::get('/events/join/scan', [EventController::class, 'scan'])->middleware('auth');
Route::post('/events/join/qr-image', [EventController::class, 'join_by_upload_qr'])->middleware('auth');
Route::delete('/events/{event_id}/member/{member_id}', [EventMemberController::class, 'destroy'])->middleware('auth');
Route::put('/events/{event_id}/member/{member_id}/role', [EventMemberController::class, 'destroy'])->middleware('auth');

Route::get('/notifications', [NotificationController::class, 'index'])->middleware('auth');
Route::get('/invitations', [InvitationController::class, 'index'])->middleware('auth');
Route::put('/invitations/{id}/accept', [InvitationController::class, 'accept'])->middleware('auth');
Route::put('/invitations/{id}/decline', [InvitationController::class, 'decline'])->middleware('auth');

Route::post('/events/{id}/invite', [InvitationController::class, 'create'])->middleware('auth');

Route::get('/timetables/{event_id}/new', [TimetableController::class, 'create_view'])->middleware('auth');
Route::post('/timetables', [TimetableController::class, 'create'])->middleware('auth');
Route::delete('/timetables/{id}', [TimetableController::class, 'delete'])->middleware('auth');
Route::get('/timetables/{id}/scan-me', [TimetableController::class, 'scan_me_view'])->middleware('auth');
Route::get('/timetables/{id}/presences', [PresenceController::class, 'index_view'])->middleware('auth');

Route::get('/presences/get-device-information', [PresenceController::class, 'get_device_info'])->middleware('auth');
Route::get('/presences/redirect', [PresenceController::class, 'presence_redirect'])->middleware('auth');
Route::get('/presences/history', [PresenceController::class, 'history_view'])->middleware('auth');
