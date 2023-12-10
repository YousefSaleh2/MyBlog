<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'user'])->name('welcome');

//######################################################################################################
//######################################## Dashboard Route #############################################

Route::middleware(['auth', 'checkLogin'])->group(function () {

    //##################################### Settings Route #############################################

    Route::get('/setting' , [SettingController::class , 'index'])->name('setting');
    Route::put('/setting.update/{setting}' , [SettingController::class , 'update'])->name('settingUpdate');

    //################################### End Settings Route ###########################################

    //#################################### Users Route #################################################

    Route::resource('/users' , UserController::class);
    Route::get('/users.show_deleted', [UserController::class , 'show_deleted'])->name('users_show_deleted');
    Route::get('/users.force_deleted/{id}', [UserController::class , 'force_deleted'])->name('users_force_deleted');
    Route::get('/users.restore/{id}', [UserController::class , 'restore'])->name('users_restore');
    Route::resource('roles', RoleController::class);

    //################################## End Users Route ###############################################

    //#################################### Posts Route #################################################

    Route::resource('/posts' , PostController::class);
    Route::get('/posts.show_deleted', [PostController::class , 'show_deleted'])->name('posts_show_deleted');
    Route::get('/posts.force_deleted/{id}', [PostController::class , 'force_deleted'])->name('posts_force_deleted');
    Route::get('/posts.restore/{id}', [PostController::class , 'restore'])->name('posts_restore');

    //################################## End Posts Route ###############################################

    //#################################### Categories Route ############################################

    Route::resource('/categories' , CategoryController::class);
    Route::get('/categories.show_deleted', [CategoryController::class , 'show_deleted'])->name('categories_show_deleted');
    Route::get('/categories.force_deleted/{id}', [CategoryController::class , 'force_deleted'])->name('categories_force_deleted');
    Route::get('/categories.restore/{id}', [CategoryController::class , 'restore'])->name('categories_restore');

    //################################## End Categories Route ###########################################

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/{page}', [AdminController::class , 'index' ])->name('index');
});
//####################################### End Dashboard Route ############################################
##########################################################################################################
