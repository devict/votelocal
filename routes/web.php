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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/vcard', function () {
    return response()->view('vcard')
        ->header('Content-Type', 'text/vcard; charset=UTF-8')
        ->header('Content-Disposition', 'attachment; filename=' . str_slug(config('app.name')) . '.vcf;');
})->name('vcard');

Auth::routes();

// TODO: use a middleware to verify requests from Twilio
Route::post('/sms/receive', 'TwilioController@receiveSms');

Route::middleware(['auth', 'require-admin'])->group(function () {
    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/subscribers', 'AdminController@subscribers');

    Route::get('/admin/scheduled_messages', 'ScheduledMessageController@index');
    Route::get('/admin/scheduled_messages/new', 'ScheduledMessageController@new');
    Route::post('/admin/scheduled_messages', 'ScheduledMessageController@create');
    Route::get('/admin/scheduled_messages/{scheduled_message}', 'ScheduledMessageController@edit');
    Route::put('/admin/scheduled_messages/{scheduled_message}', 'ScheduledMessageController@update');
    Route::get('/admin/scheduled_messages/{scheduled_message}/delete', 'ScheduledMessageController@destroy');
});
