<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

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

Auth::routes();

// TODO: use a middleware to verify requests from Twilio
Route::post('/sms/receive', 'SmsController@receiveSms');

Route::middleware(['auth', 'require-admin'])->group(function () {
    Route::get('/admin', 'AdminController@index')->name('dashboard');

    Route::get('/admin/subscribers', 'SubscriberController@index')->name('subscribers.admin.index');
    Route::get('/admin/subscribers/new', 'SubscriberController@new')->name('subscribers.admin.new');
    Route::post('/admin/subscribers', 'SubscriberController@create')->name('subscribers.admin.create');
    Route::get('/admin/subscribers/new', 'SubscriberController@new')->name('subscribers.admin.new');
    Route::get('/admin/subscribers/{subscriber}', 'SubscriberController@edit')->name('subscribers.admin.edit');
    Route::put('/admin/subscribers/{subscriber}', 'SubscriberController@update')->name('subscribers.admin.update');
    Route::get('/admin/subscribers/{subscriber}/delete', 'SubscriberController@destroy')->name('subscribers.admin.destroy');

    Route::get('/admin/scheduled_messages', 'ScheduledMessageController@index')->name('scheduled_messages.admin.index');
    Route::get('/admin/scheduled_messages/new', 'ScheduledMessageController@new')->name('scheduled_messages.admin.new');
    Route::post('/admin/scheduled_messages', 'ScheduledMessageController@create')->name('scheduled_messages.admin.create');
    Route::get('/admin/scheduled_messages/{scheduled_message}', 'ScheduledMessageController@edit')->name('scheduled_messages.admin.edit');
    Route::put('/admin/scheduled_messages/{scheduled_message}', 'ScheduledMessageController@update')->name('scheduled_messages.admin.update');
    Route::get('/admin/scheduled_messages/{scheduled_message}/delete', 'ScheduledMessageController@destroy')->name('scheduled_messages.admin.destroy');
});

Route::get('/vcard', 'VCardController@index')->name('vcard');

$locale = App::getLocale();
if ($locale === 'en') {
    $locale = '';
}

Route::prefix($locale)->group(function () {
    Route::get('/archive', 'ArchiveController@index')->name('archive');
    Route::get('/resources', 'ResourcesController@index')->name('resources');
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/subscriber/login', 'Auth\SubscriberLoginController@loginForm')->name('subscriber.loginForm'); // TODO: Temp route.
    Route::post('/subscriber/login', 'Auth\SubscriberLoginController@login')->name('subscriber.login');
    Route::get('/subscriber/verify', 'Auth\SubscriberLoginController@verifyForm')->name('subscriber.verifyForm');
    Route::post('/subscriber/verify', 'Auth\SubscriberLoginController@verify')->name('subscriber.verify');

    Route::middleware(['require-subscriber'])->group(function () {
        Route::get('/subscriber', 'SubscriberController@home')->name('subscriber.home');
    });
});
