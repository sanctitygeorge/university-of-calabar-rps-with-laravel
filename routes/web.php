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
 // use App\Admin;

Route::get('/', function () {

  //   Admin::create([
		// 'firstName'=>'Sanctity',
		// 'lastName'=>'George',
		// 'email'=>'george@gmail.com',
		// 'password'=>bcrypt('george')
		// ]);

    return view('index');
});



//Pages Routes

Route::get('/pages/about', 'PageController@about')->name('about');
Route::get('/pages/news', 'PageController@news')->name('news');
Route::get('/pages/contact', 'PageController@contact')->name('contact');
Route::post('/pages/contact', 'PageController@store')->name('contact.store');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/results/first', 'ResultController@firstSemester')->name('first');
Route::get('/home/results/second', 'ResultController@secondSemester')->name('second');
Route::get('/home/results/first&second', 'ResultController@index')->name('myResults');

Route::get('/change-password', 'UpdatePasswordController@index')->name('password.form');
Route::post('change-password', 'UpdatePasswordController@update')->name('password.update');


Route::group(['prefix' => 'admin'],
function(){

    Route::get('/dashboard/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/dashboard', 'Admin\AdminController@admin')->name('admin.dashboard')->middleware('auth:admin');

    Route::post('/dashboard/createAdmin', 'Admin\AdminController@createAdmin')->name('createAdmin');
    Route::get('/dashboard/register', 'Admin\AdminController@register')->name('admin.register')->middleware('guest');

    Route::get('/change-admin-password', 'Auth\UpdateAdminPasswordController@index')->name('admin-password.form')->middleware('auth:admin');
    Route::post('change-admin-password', 'Auth\UpdateAdminPasswordController@update')->name('admin-password.update')->middleware('auth:admin');



    Route::get('/', 'Admin\AdminController@index')->name('admin.index')->middleware('auth:admin');

    // Route::get('/dashboard/register', 'Admin\AdminController@register')->name('admin.register')->middleware('guest');
    // Route::get('/dashboard/login', 'Admin\AdminController@showLoginPage')->name('admin.login')->middleware('guest');
    // Route::post('/dashboard/store', 'Admin\AdminController@store')->name('admin.store');
    
    // Route::post('/dashboard/store', 'Admin\AdminController@store');

    Route::get('/eng010/truncate', 'Admin\Eng010Controller@truncate')->name('eng010.truncate')->middleware('auth:admin');
    Route::get('/eng020/truncate', 'Admin\Eng020Controller@truncate')->name('eng020.truncate')->middleware('auth:admin');
    Route::get('/phy010/truncate', 'Admin\Phy010Controller@truncate')->name('phy010.truncate')->middleware('auth:admin');
    Route::get('/phy020/truncate', 'Admin\Phy020Controller@truncate')->name('phy020.truncate')->middleware('auth:admin');
    Route::get('/mth010/truncate', 'Admin\Mth010Controller@truncate')->name('mth010.truncate')->middleware('auth:admin');
    Route::get('/mth020/truncate', 'Admin\Mth020Controller@truncate')->name('mth020.truncate')->middleware('auth:admin');
    Route::get('/chm010/truncate', 'Admin\Chm010Controller@truncate')->name('chm010.truncate')->middleware('auth:admin');
    Route::get('/chm020/truncate', 'Admin\Chm020Controller@truncate')->name('chm020.truncate')->middleware('auth:admin');
    Route::get('/bio010/truncate', 'Admin\Bio010Controller@truncate')->name('bio010.truncate')->middleware('auth:admin');
    Route::get('/bio020/truncate', 'Admin\Bio020Controller@truncate')->name('bio020.truncate')->middleware('auth:admin');





    Route::post('/eng010', 'Admin\Eng010Controller@import')->name('eng010.import')->middleware('auth:admin');
    Route::post('/mth010/import', 'Admin\Mth010Controller@import')->name('mth010.import')->middleware('auth:admin');
    Route::post('/bio010/import', 'Admin\Bio010Controller@import')->name('bio010.import')->middleware('auth:admin');
    Route::post('/chm010/import', 'Admin\Chm010Controller@import')->name('chm010.import')->middleware('auth:admin');
    Route::post('/phy010/import', 'Admin\Phy010Controller@import')->name('phy010.import')->middleware('auth:admin');
    Route::post('/eng010/import', 'Admin\Eng020Controller@import')->name('eng020.import')->middleware('auth:admin');
    Route::post('/mth020/import', 'Admin\Mth020Controller@import')->name('mth020.import')->middleware('auth:admin');
    Route::post('/bio020/import', 'Admin\Bio020Controller@import')->name('bio020.import')->middleware('auth:admin');
    Route::post('/chm020/upload', 'Admin\Chm020Controller@import')->name('import')->middleware('auth:admin');
    Route::post('/phy020/import', 'Admin\Phy020Controller@import')->name('phy020.import')->middleware('auth:admin');
    Route::post('/students/import', 'Admin\UserController@import')->name('students.import')->middleware('auth:admin');


    Route::get('/students/search', 'Admin\UserController@search')->name('students.search')->middleware('auth:admin');
    Route::get('/eng010/search', 'Admin\Eng010Controller@search')->name('eng010.search')->middleware('auth:admin');
    Route::get('/eng020/search', 'Admin\Eng020Controller@search')->name('eng020.search')->middleware('auth:admin');
    Route::get('/bio010/search', 'Admin\Bio010Controller@search')->name('bio010.search')->middleware('auth:admin');
    Route::get('/bio020/search', 'Admin\Bio020Controller@search')->name('bio020.search')->middleware('auth:admin');
    Route::get('/chm010/search', 'Admin\Chm010Controller@search')->name('chm010.search')->middleware('auth:admin');
    Route::get('/chm020/search', 'Admin\Chm020Controller@search')->name('chm020.search')->middleware('auth:admin');
    Route::get('/mth010/search', 'Admin\Mth010Controller@search')->name('mth010.search')->middleware('auth:admin');
    Route::get('/mth020/search', 'Admin\Mth020Controller@search')->name('mth020.search')->middleware('auth:admin');
    Route::get('/phy010/search', 'Admin\Phy010Controller@search')->name('phy010.search')->middleware('auth:admin');
    Route::get('/phy020/search', 'Admin\Phy020Controller@search')->name('phy020.search')->middleware('auth:admin');




    Route::group(['middleware'=>['auth:admin'], 'namespace'=> '\Admin', 'prefix' => 'results'], function(){
        Route::resource('students', 'UserController');
        Route::resource('eng010', 'Eng010Controller');
        Route::resource('eng020', 'Eng020Controller');
        Route::resource('mth010', 'Mth010Controller');
        Route::resource('mth020', 'Mth020Controller');
        Route::resource('bio010', 'Bio010Controller');
        Route::resource('bio020', 'Bio020Controller');
        Route::resource('chm010', 'Chm010Controller');
        Route::resource('chm020', 'Chm020Controller');
        Route::resource('phy010', 'Phy010Controller');
        Route::resource('phy020', 'Phy020Controller');
    });
}
);
