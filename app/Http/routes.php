<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'welcomeController@show' )->name('welcome');

Route::auth();

Route::resource('users', 'UsersController');

Route::get('admin/login', 'adminController@showLoginForm');

Route::post('users/changePassowrd', 'UsersController@changePassword')->name('users.changePassowrd');

Route::post('admin/login', 'adminController@login');

Route::get('admin/logout', 'adminController@logout');

Route::group(['middleware' => 'auth:admins'], function(){

	Route::resource('admin', 'adminController');

	Route::resource('adm/users', 'adminUsersController');

	Route::get('adm/users/data/{id}', 'adminUsersController@getUserInfo')->name('adm.users.data');

	Route::get('adm/admins/data/{id}', 'AdminsController@getAdminInfo')->name('adm.admins.data');

	Route::get('adm/users/destroy/{id}', 'adminUsersController@destroy')->name('adm.users.destroy');

	Route::get('adm/destroy/{id}', 'AdminsController@destroy')->name('adm.destroy');	

	Route::resource('adm/admins', 'AdminsController');	

	Route::resource('adm/logs', 'LogsController');	

	Route::get('adm/users/edit/{id}/{edit}', 'adminUsersController@edit')->name('adm.users.edit');
	
	Route::get('adm/users/download/{url}', 'adminUsersController@download')->name('adm.users.download');

	Route::get('adm/users/add/{id}/{add}', 'adminUsersController@add')->name('adm.users.add');

	Route::get('adm/change_locale/{lang}', 'LangController@switchLang');
});


Route::group(['middleware' => 'auth'], function(){

	Route::get('educations/add/{id}', 'EducationsController@add')->name('educations.add');

	Route::get('essay/download{url}', 'EssaysController@download')->name('essay.download');

	Route::get('educations/download/score{score}', 'EducationsController@downloadScore')->name('educations.download.score');

	Route::get('educations/download/sat{sat}', 'EducationsController@downloadSat')->name('educations.download.sat');

	Route::get('educations/download/toefl{toefl}', 'EducationsController@downloadToefl')->name('educations.download.toefl');

	Route::resource('personals', 'PersonalsController');

	Route::resource('educations', 'EducationsController');

	Route::resource('familiars', 'FamiliarsController');

	Route::resource('awards', 'AwardsController');

	Route::resource('essays', 'EssaysController');

	Route::get('educations/destroy/{id}', 'EducationsController@destroy')->name('educations.destroy');

});
	Route::post('forgotPassword/send', 'forgotPasswordController@send')->name('forgotPassword.send');
	Route::get('change_locale/{lang}', 'LangController@switchLang')->name('change_locale');
	
	Route::get('states/{id}', 'StatesController@getStates')->name('states');

Route::get('/login', ['as' => 'login', function () {	
    return view('auth.login');
}]);

