<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

// route welcome
Route::get('/', 'WelcomeController@index')->name('welcome');
// route kalender
Route::get('/kalender', 'WelcomeController@kalender')->name('kalender');
// route detail event
Route::get('/event/{id}', 'WelcomeController@event')->name('event');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Event
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventController');

    // Cabor
    Route::delete('cabors/destroy', 'CaborController@massDestroy')->name('cabors.massDestroy');
    Route::post('cabors/media', 'CaborController@storeMedia')->name('cabors.storeMedia');
    Route::post('cabors/ckmedia', 'CaborController@storeCKEditorImages')->name('cabors.storeCKEditorImages');
    Route::post('cabors/parse-csv-import', 'CaborController@parseCsvImport')->name('cabors.parseCsvImport');
    Route::post('cabors/process-csv-import', 'CaborController@processCsvImport')->name('cabors.processCsvImport');
    Route::resource('cabors', 'CaborController');

    // Venue
    Route::delete('venues/destroy', 'VenueController@massDestroy')->name('venues.massDestroy');
    Route::post('venues/parse-csv-import', 'VenueController@parseCsvImport')->name('venues.parseCsvImport');
    Route::post('venues/process-csv-import', 'VenueController@processCsvImport')->name('venues.processCsvImport');
    Route::resource('venues', 'VenueController');

    // Pertandingan
    Route::delete('pertandingans/destroy', 'PertandinganController@massDestroy')->name('pertandingans.massDestroy');
    Route::post('pertandingans/parse-csv-import', 'PertandinganController@parseCsvImport')->name('pertandingans.parseCsvImport');
    Route::post('pertandingans/process-csv-import', 'PertandinganController@processCsvImport')->name('pertandingans.processCsvImport');
    Route::resource('pertandingans', 'PertandinganController');

    // Atlet
    Route::delete('atlets/destroy', 'AtletController@massDestroy')->name('atlets.massDestroy');
    Route::post('atlets/media', 'AtletController@storeMedia')->name('atlets.storeMedia');
    Route::post('atlets/ckmedia', 'AtletController@storeCKEditorImages')->name('atlets.storeCKEditorImages');
    Route::resource('atlets', 'AtletController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
