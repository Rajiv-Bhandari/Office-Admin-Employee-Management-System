<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Staff; 
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
    if (session()->has('generated')) {
      
        return redirect()->route('staff.home');
        
    } else {
        
        return view('welcome');
    }
})->name('welcome');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/staff/home', [AuthController::class, 'login'])->name('logincontroller');

//access admin without authentication
Route::get('/create/staff', [AuthController::class, 'createStaff'])->name('staff.create');
Route::get('/department/details', [AuthController::class, 'showDep'])->name('details');
Route::post('/create', [AuthController::class, 'createPage'])->name('home');
Route::get('/create', [AuthController::class, 'homepage'])->name('homepage');
Route::get('/create/department', [AuthController::class, 'createDepartment'])->name('department.create');
Route::post('/create/department/store', [AuthController::class, 'store']);
Route::post('/create/staff/store', [AuthController::class, 'staffstore']);
Route::get('/department/{department}/edit', [AuthController::class, 'adminedit'])->name('adminedit');
Route::put('/department/{department}/update', [AuthController::class, 'adminupdate'])->name('adminupdate');
Route::get('/staff/{staff}/edit', [AuthController::class, 'staffadminedit'])->name('staff.adminedit');
Route::put('/staff/{staff}/update', [AuthController::class, 'staffdetailsupdate'])->name('staffdetailsupdate');
Route::delete('/department/{department}/delete', [AuthController::class, 'destroy'])->name('destroy');
Route::delete('/staff/{staff}/delete', [AuthController::class, 'staffdestroy'])->name('staffdestroy');
Route::get('/staff/details', [AuthController::class, 'showStaff'])->name('staffdetails');


// Add the following middleware group for protected routes
Route::middleware(['auth'])->group(function () {
    
    Route::get('/department/staffdepartmentdetails', [AuthController::class, 'staffdepartmentdetails'])->name('staffdepartmentdetails');
    Route::get('/staff/staffviewstaff', [AuthController::class, 'staffviewstaff'])->name('staffviewstaff');
    Route::get('/staff/home', [AuthController::class, 'staffhome'])->name('staff.home');
    Route::get('/staff/contact', [AuthController::class, 'contatpage'])->name('contatpage'); 
    Route::get('/staff/home/profile/changepassword', [AuthController::class, 'changepassword'])->name('changepassword');
    Route::get('/staff/home/profile', [AuthController::class, 'staffprofile'])->name('staffprofile');
    Route::put('staff/home/update-profile', [AuthController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/staff/home/profile/updatepassword', [AuthController::class, 'updatepassword'])->name('updatepassword');
    Route::post('/staff/contact/sendmail', [AuthController::class, 'sendmail'])->name('sendmail');
    
    // Route::get('/logout', function () {
    //     //Auth::logout(); // Logout the user
    //     session()->invalidate(); // Invalidate the current session
    //     session()->regenerateToken(); // Regenerate the CSRF token
    
    //     return redirect('/login');
    // })->name('logout');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        // Add this route to your web.php


});

// Redirect to the login page for unauthorized access
Route::fallback(function () {
    return Redirect::to('/login');
});
Route::post('/clear-session-token', function () {
    if (Auth::check() && Auth::user() instanceof Staff) {
        Auth::user()->update(['session_token' => null]);
    }
})->middleware('auth');

