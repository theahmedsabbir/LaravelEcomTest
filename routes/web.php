<?php

use Illuminate\Support\Facades\Route;

/*
Pages Routes (Frontend)
all front end pages routes and functions are here
*/

Route::get('/', 'Frontend\PagesController@index')->name('index');
Route::get('/contact', 'Frontend\PagesController@contact')->name('contact');
Route::get('/search/', 'Frontend\PagesController@search')->name('search');





// User Verification Route Group
Route::group( ['prefix' => '/users'], function(){
	Route::get('/verification/{token}', 'Frontend\VerificationController@verify')->name('user.verification');
	Route::get('/dashboard', 'Frontend\UsersController@dashboard')->name('user.dashboard');
	Route::get('/edit', 'Frontend\UsersController@edit')->name('user.edit');
	Route::post('/update', 'Frontend\UsersController@update')->name('user.update');
});

// Cart Route Group
// Route::group( ['prefix' => '/cart'], function(){
// 	Route::get('/', 'Frontend\CartsController@index')->name('cart.index');
// 	Route::post('/store', 'Frontend\CartsController@store')->name('cart.store');
// 	Route::post('/update', 'Frontend\CartsController@update')->name('cart.update');
// 	Route::post('/delete', 'Frontend\CartsController@destroy')->name('cart.delete');
// });

// Checkouts Route Group
Route::group( ['prefix' => '/checkout'], function(){
	Route::get('/', 'Frontend\CheckoutsController@index')->name('checkout.index');
	Route::post('/store', 'Frontend\CheckoutsController@store')->name('checkout.store');
});




// Product Routes 


Route::group([ 'prefix' => '/products' ], function(){
	Route::get('/', 'Frontend\ProductsController@index')->name('products');
	Route::get('/{slug}', 'Frontend\ProductsController@show')->name('products.show');

	Route::get('/categories', 'Frontend\CategoriesController@index')->name('categories.index');
	Route::get('/categories/{slug}', 'Frontend\CategoriesController@show')->name('categories.show');
});





// admin route group
Route::group( ['prefix' => '/admin'], function(){

	Route::get('/', 'Backend\PagesController@index')->name('admin.index');

	// Admin login routes
	Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login/submit', 'Auth\Admin\LoginController@login')->name('admin.login.submit');
	Route::post('/logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');

	// send reset password email
	Route::get('/password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('/password/email', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

	// password reset
	Route::get('/password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
	Route::post('/password/reset', 'Auth\Admin\ResetPasswordController@reset')->name('admin.password.update');


	// product route group
	Route::group( ['prefix' => '/product'], function(){

		Route::get('/', 'Backend\ProductsController@index')->name('admin.product.index');

		Route::get('/create', 'Backend\ProductsController@create')->name('admin.product.create');

		Route::post('/create', 'Backend\ProductsController@store')->name('admin.product.store');

		Route::get('/edit/{id}', 'Backend\ProductsController@edit')->name('admin.product.edit');

		Route::post('/edit/{id}', 'Backend\ProductsController@update')->name('admin.product.update');

		Route::post('/delete/{id}', 'Backend\ProductsController@delete')->name('admin.product.delete');

	});



	// orders route group
	Route::group( ['prefix' => '/orders'], function(){

		Route::get('/', 'Backend\OrdersController@index')->name('admin.order.index');

		Route::get('/view/{id}', 'Backend\OrdersController@show')->name('admin.order.show');

		Route::post('/delete/{id}', 'Backend\OrdersController@delete')->name('admin.order.delete');

		Route::post('/order_completed/{id}', 'Backend\OrdersController@order_completed')->name('admin.order.completed');

		Route::post('/order_paid/{id}', 'Backend\OrdersController@order_paid')->name('admin.order.paid');

		Route::post('/chargeUpdate/{id}', 'Backend\OrdersController@chargeUpdate')->name('admin.order.chargeUpdate');

		Route::get('/generateInvoice/{id}', 'Backend\OrdersController@generateInvoice')->name('admin.order.generateInvoice');

	});

	// brand route group
	Route::group( ['prefix' => '/brands'], function(){

		Route::get('/', 'Backend\BrandsController@index')->name('admin.brand.index');

		Route::get('/create', 'Backend\BrandsController@create')->name('admin.brand.create');

		Route::post('/create', 'Backend\BrandsController@store')->name('admin.brand.store');

		Route::get('/edit/{id}', 'Backend\BrandsController@edit')->name('admin.brand.edit');

		Route::post('/edit/{id}', 'Backend\BrandsController@update')->name('admin.brand.update');

		Route::post('/delete/{id}', 'Backend\BrandsController@delete')->name('admin.brand.delete');

	});

	// Category route group
	Route::group( ['prefix' => '/category'], function(){

		Route::get('/', 'Backend\CategoriesController@index')->name('admin.category.index');

		Route::get('/create', 'Backend\CategoriesController@create')->name('admin.category.create');

		Route::post('/create', 'Backend\CategoriesController@store')->name('admin.category.store');

		Route::get('/edit/{id}', 'Backend\CategoriesController@edit')->name('admin.category.edit');

		Route::post('/edit/{id}', 'Backend\CategoriesController@update')->name('admin.category.update');

		Route::post('/delete/{id}', 'Backend\CategoriesController@delete')->name('admin.category.delete');

	});

	// Division route group
	Route::group( ['prefix' => '/divisions'], function(){

		Route::get('/', 'Backend\DivisionsController@index')->name('admin.division.index');

		Route::get('/create', 'Backend\DivisionsController@create')->name('admin.division.create');

		Route::post('/create', 'Backend\DivisionsController@store')->name('admin.division.store');

		Route::get('/edit/{id}', 'Backend\DivisionsController@edit')->name('admin.division.edit');

		Route::post('/edit/{id}', 'Backend\DivisionsController@update')->name('admin.division.update');

		Route::post('/delete/{id}', 'Backend\DivisionsController@delete')->name('admin.division.delete');

	});

	// District route group
	Route::group( ['prefix' => '/districts'], function(){

		Route::get('/', 'Backend\DistrictsController@index')->name('admin.district.index');

		Route::get('/create', 'Backend\DistrictsController@create')->name('admin.district.create');

		Route::post('/create', 'Backend\DistrictsController@store')->name('admin.district.store');

		Route::get('/edit/{id}', 'Backend\DistrictsController@edit')->name('admin.district.edit');

		Route::post('/edit/{id}', 'Backend\DistrictsController@update')->name('admin.district.update');

		Route::post('/delete/{id}', 'Backend\DistrictsController@delete')->name('admin.district.delete');

	});

	// Slider route group
	Route::group( ['prefix' => '/sliders'], function(){

		Route::get('/', 'Backend\SlidersController@index')->name('admin.slider.index');

		Route::post('/create', 'Backend\SlidersController@store')->name('admin.slider.store');

		Route::post('/edit/{id}', 'Backend\SlidersController@update')->name('admin.slider.update');

		Route::post('/delete/{id}', 'Backend\SlidersController@delete')->name('admin.slider.delete');

	});

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/get-district/{id}', function( $id ){
	return json_encode( App\Models\District::where('division_id', $id)->get() );
});
