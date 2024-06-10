<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ShowViewController;
use Illuminate\Http\Request;
use App\Models\Course;


//création des routes pour afficher les vues
Route::get('/', function () {return view('login');});


Route::get('/home', function () {return view('home');})->middleware('authenticated');

Route::get('/register', function () {return view('register');});

Route::get('/add-course', function () {return view('add-course');})->middleware('authenticated');

Route::get('/login', function () {return view('login');});

Route::get('/edit-formation', function () {return view('editFormation');});

Route::get('/show', function () {return view('coursesShow');});


Route::get('/email-verify-success', function () {return view('eamils.emailVerificationSucces');});

Route::get('/attributeFormations', function () { return view('attributeFormation');})->middleware('authenticated');

//fin



Route::controller(AuthController::class)->group(function(){
    Route::post('/register-admin', 'registerAdmin')->name('register.admin');
    Route::post('/login', 'login')->name('login.user');
    Route::get('/logout', 'logout')->name('logout.user');
    Route::get('verify-email/{id}', 'verify')->name('verification.verify');


});

Route::controller(AdminController::class)->group(function(){
    Route::get('/home', 'index')->name('user.list');

    Route::delete('/home/{id}', 'destroy')->name('user.delete');
    Route::put('/home/{id}', 'update')->name('user.update');
    Route::post('/home/{id}', 'update')->name('user.update');

});






Route::controller(CourseController::class)->group(function(){
    Route::get('/cours/{id}/fichier', 'showFichier')->name('showFichier');
    Route::get('/list-formations','index')->middleware('authenticated');
    Route::resource('courses', CourseController::class);
});

Route::get('/connected', [AdminController::class, 'showConnectedUsers']);

