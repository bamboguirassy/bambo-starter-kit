<?php
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

Route::get('/home', function () {
    return redirect()->route('app.home');
})->middleware('auth');

Auth::routes();

Route::name('app.')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('home');

    Route::resource('groupe', GroupeController::class, [
        'only' => ['index', 'show']
    ]);
    // role routes
    Route::resource('role', RoleController::class, [
        'only' => ['index']
    ]);
    // user routes
    Route::resource('user', UserController::class, [
        'only' => ['index', 'show']
    ]);
    Route::get('/user-profil', [UserController::class, 'showProfil'])
        ->name('user.profil')->middleware('auth');
    // notification routes
    Route::resource('notification', NotificationController::class, [
        'only' => ['index', 'show']
    ]);
});

Route::name('dashboard.')->middleware('auth')->group(function () {

});

Route::get('/mail', function () {
});

//temp rout
Route::get('/generate-admin', function () {
    $user = new User([
        'email' => 'didegassama@gmail.com', 'name' => 'Moussa FOFANA',
        'password' => Hash::make('passer123'), 'role' => 'admin', 'enabled' => true
    ]);
    $user->saveOrFail();
});
