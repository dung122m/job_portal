<?php

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
\Illuminate\Support\Facades\Auth::routes(['verify' => true]);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('email/verify/{id}/{hash}', [App\Http\Controllers\AccountController::class, 'verify'])->name('verification.verify') ->middleware(['signed']);
Route::group(['middleware' => 'guest'], function () {
    Route::get('account/registration', [App\Http\Controllers\AccountController::class, 'register'])->name('registration');
    Route::get('account/login', [App\Http\Controllers\AccountController::class, 'login'])->name('login');
    Route::post('account/process-register', [App\Http\Controllers\AccountController::class, 'processRegistration'])->name('account.processRegistration');
    Route::post('account/process-login', [App\Http\Controllers\AccountController::class, 'processLogin'])->name('account.processLogin');


});

Route::group([ 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

});
Route::group(['middleware' => 'auth', 'prefix' => 'account'], function () {

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('account.profile');
    Route::post('/update-profile', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('account.updateProfile');
    Route::post('/change-password', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('account.changePassword');
    Route::post('/update-profile-picture', [App\Http\Controllers\ProfileController::class, 'updateProfilePicture'])->name('account.updateProfilePicture');
    Route::delete('/delete-profile-picture', [App\Http\Controllers\ProfileController::class, 'deleteProfilePicture'])->name('account.deleteProfilePicture');
    Route::post('/upload-cv', [\App\Http\Controllers\AccountController::class, 'uploadCV'])->name('account.uploadCV');
    Route::delete('/delete-cv', [\App\Http\Controllers\AccountController::class, 'deleteCV'])->name('account.deleteCV');

    Route::post('/logout', function () {
        auth()->logout();
        return redirect()->route('home');
    })->name('logout');
});
Route::group(['prefix' => 'job'], function () {
    Route::get('/details/{id}', [App\Http\Controllers\JobController::class, 'details'])->name('job.details');
    Route::get('/', [\App\Http\Controllers\JobController::class, 'index'])->name('job.index');

});
Route::group(['middleware' => 'auth', 'prefix' => 'job'], function () {
    Route::get('/create', [App\Http\Controllers\JobController::class, 'create'])->name('job.create');
    Route::get('/my-jobs', [App\Http\Controllers\JobController::class, 'myJobs'])->name('job.my-job');
    Route::get('/edit/{id}', [App\Http\Controllers\JobController::class, 'edit'])->name('job.edit');
    Route::get('/applied', [App\Http\Controllers\JobController::class, 'jobApplied'])->name('job.applied');
    Route::get('/saved', [App\Http\Controllers\JobController::class, 'jobSaved'])->name('job.saved');
    Route::put('/job/{id}', [App\Http\Controllers\JobController::class, 'update'])->name('job.update');
    Route::post('/store', [App\Http\Controllers\JobController::class, 'store'])->name('job.store');
    Route::post('/apply/{id}', [App\Http\Controllers\JobController::class, 'apply'])->name('job.apply');
    Route::post('/save/{id}', [App\Http\Controllers\JobController::class, 'save'])->name('job.save');
    Route::delete('/job/{id}', [\App\Http\Controllers\JobController::class, 'destroy'])->name('job.destroy');
    Route::get('/{id}/applicants', [\App\Http\Controllers\JobController::class, 'viewApplicants'])->name('job.applicants');


});
