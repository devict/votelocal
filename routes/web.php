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

Auth::routes();

// TODO: use a middleware to verify requests from Twilio
Route::post('/sms/receive', 'SmsController@receiveSms');

Route::middleware(['auth', 'require-admin'])->group(function () {
    Route::get('/admin', 'AdminController@index');

    Route::get('/admin/subscribers', 'SubscriberController@index')->name('subscribers.admin.index');
    Route::get('/admin/subscribers/new', 'SubscriberController@new')->name('subscribers.admin.new');
    Route::post('/admin/subscribers', 'SubscriberController@create')->name('subscribers.admin.create');
    Route::get('/admin/subscribers/new', 'SubscriberController@new')->name('subscribers.admin.new');
    Route::get('/admin/subscribers/{subscriber}/messages', 'SubscriberController@messages')->name('subscribers.admin.messages');
    Route::get('/admin/subscribers/{subscriber}', 'SubscriberController@edit')->name('subscribers.admin.edit');
    Route::put('/admin/subscribers/{subscriber}', 'SubscriberController@update')->name('subscribers.admin.update');
    Route::get('/admin/subscribers/{subscriber}/delete', 'SubscriberController@destroy')->name('subscribers.admin.destroy');

    Route::get('/admin/scheduled_messages', 'ScheduledMessageController@index');
    Route::get('/admin/scheduled_messages/new', 'ScheduledMessageController@new');
    Route::post('/admin/scheduled_messages', 'ScheduledMessageController@create');
    Route::get('/admin/scheduled_messages/{scheduled_message}', 'ScheduledMessageController@edit');
    Route::get('/admin/scheduled_messages/{scheduled_message}/messages', 'ScheduledMessageController@messages');
    Route::put('/admin/scheduled_messages/{scheduled_message}', 'ScheduledMessageController@update');
    Route::get('/admin/scheduled_messages/{scheduled_message}/delete', 'ScheduledMessageController@destroy');
});

Route::get('/vcard', 'VCardController@index')->name('vcard');

$locale = App::getLocale();
if ($locale === 'en') {
    $locale = '';
}

Route::prefix($locale)->group(function () {
    Route::get('/archive', 'ArchiveController@index')->name('archive');
    Route::get('/', 'HomeController@index')->name('home');
});
