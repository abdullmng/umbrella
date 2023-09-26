<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSocialController;
use App\Http\Controllers\WithdrawalController;
use App\Models\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
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
})->name("home");

Route::get('/config', function () {
    dd(Config::find(9)->data);
});

Route::get('/storage/uploads/{filename}', function ($filename)
{
    // Add folder path here instead of storing in the database.
    $path = storage_path('app/public/uploads/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

Route::get('/coupons', [UserController::class, 'coupons'])->name('home.get_coupons');
Route::get('courses', [CourseController::class, 'courses'])->name('home.courses');
Route::get('/courses/{course_id}', [CourseController::class, 'course'])->name('home.course');
Route::get('/tasks', [TaskController::class, 'tasks'])->name('home.tasks');
Route::get('/tasks/{task_id}', [TaskController::class, 'task'])->name('home.task');
Route::get('/top-sellers', [EarningController::class, 'topEarners'])->name('home.top_sellers');


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
        Route::get('/withdrawals', [UserController::class, 'withdrawals'])->name('user.withdrawals');
        Route::get('logout', [UserController::class, 'logout'])->name('user.logout');

        //Post Routes
        Route::post('/bank', [UserController::class, 'updateBank'])->name('user.update_bank');
        Route::post('/socials', [UserSocialController::class, 'store'])->name('user.store_socials');
        Route::post('/dashboard', [UserController::class, 'upload'])->name('user.upload');
        Route::post('/earn', [EarningController::class, 'earn'])->name('user.earn');
        Route::post('/withdrawals', [WithdrawalController::class, 'withdraw'])->name('user.withdraw');

        //vendor routes
        Route::prefix('/vendor')->group(function () {
            Route::group(['middleware' => 'vendor.validate'], function () {
                Route::get('/dashboard', [UserController::class, 'vendorDashboard'])->name('vendor.dashboard');
            });
        });

        //user admin routes
        Route::prefix('super')->group(function () {
            Route::group(['middleware' => 'user_admin.validate'], function () {
                Route::get('/verify-socials', [Usercontroller::class, 'verifySocials'])->name('super.verify_socials');
                Route::get('/verify-socials/{user_id}', [UserController::class, 'verifyUserSocials'])->name('super.verify_user_socials');
                Route::get('/socials/approve/{user_social_id}', [UserController::class, 'approveSocialById'])->name('super.approve');
                Route::get('/socials/decline/{user_social_id}', [UserController::class, 'declineSocialById'])->name('super.decline');
            });
        });
    });

});

Route::prefix('admin')->group(function() {
    Route::get('login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('login', [AdminController::class, 'authenticate'])->name('admin.authenticate');

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name("admin.users");
        Route::get('/users/{user_id}', [AdminController::class,"user"])->name("admin.user");
        Route::post('/users/{user_id}', [AdminController::class,"activateUser"])->name("admin.activate_user");
        Route::post('/set-role/{user_id}', [AdminController::class, 'setRole'])->name('admin.set_role');
        Route::post('/post-earning/{user_id}', [AdminController::class, 'postEarning'])->name('admin.post_earning');
        Route::get('/coupons', [AdminController::class,"coupons"])->name('admin.coupons');
        Route::post('/coupons', [CouponController::class,"generate"])->name('admin.create_coupons');
        Route::get('/courses', [AdminController::class, 'courses'])->name('admin.courses');
        Route::post('/courses', [CourseController::class, 'create'])->name('admin.create_course');
        Route::get('/courses/delete/{course_id}', [CourseController::class, 'delete'])->name('admin.delete_course');
        Route::get('/tasks', [AdminController::class, 'tasks'])->name('admin.tasks');
        Route::post('/tasks', [TaskController::class, 'create'])->name('admin.create_tasks');
        Route::get('/tasks/delete/{task_id}', [TaskController::class, 'delete'])->name('admin.delete_task');
        Route::get('/config', [AdminController::class, 'config'])->name('admin.config');
        Route::post('/config', [ConfigController::class, 'save'])->name('admin.save_config');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});
