<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSocialController;
use App\Models\Config;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/sym', function () {
    $target = '/home/lifespr3/test.lifespringminna.sch.ng/umbrella-aca/storage';

    $shortcut = '/home/lifespr3/test.lifespringminna.sch.ng/';

    symlink($target, $shortcut);
});

Route::get('/config', function () {
    dd(Config::find(9)->data);
});

Route::get('/coupons', [UserController::class, 'coupons'])->name('home.get_coupons');
Route::get('courses', [CourseController::class, 'courses'])->name('home.courses');
Route::get('/courses/{course_id}', [CourseController::class, 'course'])->name('home.course');


Route::prefix('users')->group(function () {
    /*
        ** Open Routes
    */

    // Get Routes
    Route::get('/login', [UserController::class, 'login'])->name('user.login');
    Route::get('/register', [UserController::class, 'register'])->name('user.register');

    // Post requests
    Route::post('/login', [UserController::class, 'authenticate'])->name('user.auth');
    Route::post('/register', [UserController::class, 'store'])->name('user.store');

    /*
        ** Protected Routes
    */
    Route::group(['middleware' => 'auth'], function () {
        // Get routes
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/bank', [UserController::class, 'bank'])->name('user.bank');
        Route::get('/socials', [UserController::class, 'socials'])->name('user.socials');
        Route::get('/activity', [UserController::class, 'activities'])->name('user.activities');
        Route::get('logout', [UserController::class, 'logout'])->name('user.logout');

        //
        Route::post('/bank', [UserController::class, 'updateBank'])->name('user.update_bank');
        Route::post('/socials', [UserSocialController::class, 'store'])->name('user.store_socials');
        Route::post('/dashboard', [UserController::class, 'upload'])->name('user.upload');
    });

});
