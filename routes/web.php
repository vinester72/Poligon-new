<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('rest', 'RestTestController')->names('restTest');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'digging_deeper'], function() {
    Route::get('collections', 'DiggingDeeperController@collections')->name('digging_deeper.collections');
});

Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function() {
    Route::resource('posts', 'PostController')->names('blog.posts');
});



Route::get('/admin/blog', [App\Http\Controllers\Blog\Admin\MainController::class, 'dashboard'])->name('blog.admin.dashboard');


$groupData = [
    'namespace' => 'Blog\Admin',
    'prefix' => 'admin/blog',
];



Route::group($groupData, function() {

     //Users 
     Route::resource('users', 'UserController')
     ->names('blog.admin.users');   
     
    //BlogCategory
    $methods = ['index', 'edit', 'update', 'create', 'store', 'show', 'destroy'];
	Route::resource('categories', 'CategoryController')
		->only($methods)
        ->names('blog.admin.categories');
    
    //BlogPost
    Route::get('posts/restore/{id}', 'PostController@restore')->name('blog.admin.posts.restore');
    Route::resource('posts', 'PostController')
        ->except(['show'])
        ->names
        ('blog.admin.posts');

      
});
