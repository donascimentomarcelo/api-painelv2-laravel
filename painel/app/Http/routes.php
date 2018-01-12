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
		
	Route::get('/','Auth\AuthController@getLogin');

	Route::post('painel/email',['as' => 'painel.email', 'uses' => 'PainelController@email']);
	Route::post('emails/create',['as' => 'painel.emails.create', 'uses' => 'Api\ApiProjectController@create']);
	Route::get('emails/update/{id}/confirmation',['as' => 'email.confirmation', 'uses' => 'EmailController@emailConfirmation']);
	Route::get('emails/success', ['as' => 'emails.success', 'uses' => 'EmailController@successConfirmation']);

	Route::get('auth/login', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');

	Route::group(['prefix'=>'admin', 'middleware'=>'verify', 'as'=>'admin.'],function(){
		
		Route::get('home',['as' => 'painel.index', 'uses' => 'PainelController@index']);
		Route::get('painel/register',['as' => 'painel.user', 'uses' => 'PainelController@createUser']);
		Route::post('painel/save',['as' => 'painel.create.user', 'uses' => 'PainelController@saveUser']);
		Route::post('painel/update',['as' => 'painel.create.update', 'uses' => 'PainelController@updateUser']);
		Route::get('painel/edit/{id}',['as' => 'painel.edit.user', 'uses' => 'PainelController@editUser']);
		Route::get('painel/list',['as' => 'painel.userlist', 'uses' => 'PainelController@listUser']);
		Route::get('painel/index',['as' => 'painel.userIndex', 'uses' => 'PainelController@indexList']);

		Route::get('project/register',['as' => 'painel.project', 'uses' => 'ProjectController@createProject']);
		Route::post('project/save',['as' => 'painel.create.project', 'uses' => 'ProjectController@saveProject']);
		Route::get('project/projects',['as' => 'painel.projectView', 'uses' => 'ProjectController@project']);
		Route::get('project/list',['as' => 'painel.projectlist', 'uses' => 'ProjectController@listProject']);
		Route::get('project/edit',['as' => 'painel.projectedit', 'uses' => 'ProjectController@editProject']);
		Route::get('project/edit/{id}',['as' => 'painel.edit', 'uses' => 'ProjectController@edit']);
		Route::get('project/destroy/{id}',['as' => 'painel.destroy', 'uses' => 'ProjectController@destroyProject']);
		Route::post('project/update',['as' => 'painel.update', 'uses' => 'ProjectController@updateProject']);

		Route::get('image/edit/{id}',['as' => 'painel.image', 'uses' => 'ImageController@editImage']);
		// Route::post('image/update/{id}',['as' => 'painel.image.update', 'uses' => 'ImageController@updateImage']);
		Route::post('image/update',['as' => 'painel.image.update', 'uses' => 'ImageController@updateImage']);
		Route::get('image/delete/{id}',['as' => 'painel.image.delete', 'uses' => 'ImageController@deleteImage']);
		Route::post('image/destroy/{id}',['as' => 'painel.image.destroy', 'uses' => 'ImageController@destroyImage']);
		Route::get('image/add/{id}',['as' => 'painel.image.add', 'uses' => 'ImageController@addImage']);
		Route::post('image/save',['as' => 'painel.image.save', 'uses' => 'ImageController@saveImage']);
		Route::post('image/updateOrder',['as' => 'painel.image.updateOrder', 'uses' => 'ImageController@updateOrder']);
		// Route::post('image/save/{id}',['as' => 'painel.image.save', 'uses' => 'ImageController@saveImage']);

		Route::get('image/multiple/{id}',['as' => 'multiple.order', 'uses' => 'ImageController@indexMultiple']);
		Route::post('image/multiple/{id}',['as' => 'image.update.multiple', 'uses' => 'ImageController@updateMultiple']);
		Route::get('image/single/{id}',['as' => 'single.order', 'uses' => 'ImageController@indexSingle']);
		Route::post('image/single/{id}',['as' => 'image.update.single', 'uses' => 'ImageController@updateSingle']);
		
		Route::get('news/create',['as' => 'painel.news.create', 'uses' => 'NewsController@create']);
		Route::get('news/list',['as' => 'painel.news.list', 'uses' => 'NewsController@show']);
		Route::get('news/edit/{id}',['as' => 'painel.news.edit', 'uses' => 'NewsController@edit']);
		Route::post('news/update/{id}',['as' => 'painel.news.update', 'uses' => 'NewsController@update']);

		Route::post('news/send',['as' => 'painel.email.send', 'uses' => 'EmailController@sendEmail']);
		Route::post('news/update/{id}',['as' => 'painel.email.update', 'uses' => 'EmailController@updateSendEmail']);

		Route::get('emails/list',['as' => 'painel.emails.list', 'uses' => 'EmailController@show']);

		Route::get('promotions/list',['as' => 'painel.promotions.list', 'uses' => 'PromotionsController@index']);
		Route::get('promotions/store',['as' => 'painel.promotions.store', 'uses' => 'PromotionsController@store']);
		Route::get('promotions/show',['as' => 'painel.promotions.show', 'uses' => 'PromotionsController@show']);
		Route::get('promotions/edit/{id}',['as' => 'painel.promotions.edit', 'uses' => 'PromotionsController@edit']);
		Route::get('promotions/edit',['as' => 'painel.promotions.image', 'uses' => 'PromotionsController@image']);
		Route::get('promotions/delete/{id}',['as' => 'painel.promotions.delete', 'uses' => 'PromotionsController@delete']);
		Route::post('promotions/create',['as' => 'painel.promotions.create', 'uses' => 'PromotionsController@create']);
		Route::post('promotions/update',['as' => 'painel.promotions.update', 'uses' => 'PromotionsController@update']);
		Route::post('promotions/addNewImage',['as' => 'painel.promotions.addNewImage', 'uses' => 'PromotionsController@addNewImage']);
		Route::post('promotions/updateImage',['as' => 'painel.promotions.updateImage', 'uses' => 'PromotionsController@updateImage']);
	});
	// Route::get('email/send/multiple',['as' => 'email.send', 'uses' => 'EmailController@sendEmail']);
	
	Route::get('api/project/list',['as' => 'api.project.list', 'uses' => 'Api\ApiProjectController@ApiListProject']);
Route::post('promotions/addNewImage',['as' => 'painel.promotions.addNewImage', 'uses' => 'PromotionsController@addNewImage']);
Route::post('promotions/updateImage',['as' => 'painel.promotions.updateImage', 'uses' => 'PromotionsController@updateImage']);