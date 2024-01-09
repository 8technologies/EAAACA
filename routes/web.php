<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Gen;
use App\Models\User;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;


Route::get('policy', function () {
    return view('policy');
});

Route::get('/gen-form', function () {
    die(Gen::find($_GET['id'])->make_forms());
})->name("gen-form");


Route::get('generate-class', [MainController::class, 'generate_class']);
Route::get('auth/register', [MainController::class, 'register'])->name('form');
Route::get('pending', [MainController::class, 'pending'])->name('pending');
Route::get('2fa', [MainController::class, 'two_fa']);
Route::post('2fa', function () {
    $u = Admin::user();
    if ($u == null) {
        die("user not found");
    }
    $u = User::find($u->id);
    if ($u == null) {
        die("user not found");
    }
    if ($u->code != $_POST['code']) {
        $url = url('2fa?error=1');
        die("<script>location.href='$url';</script>");
    }
    $u->code_sent = 'Yes';
    $u->code_verified = 'Yes';
    $u->save();
    $url = admin_url();
    die("<script>location.href='$url';</script>");
});

Route::get('/gen', function () {
    die(Gen::find($_GET['id'])->do_get());
})->name("gen");
 

/* 

Route::get('generate-variables', [MainController::class, 'generate_variables']); 
Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/about-us', [MainController::class, 'about_us']);
Route::get('/our-team', [MainController::class, 'our_team']);
Route::get('/news-category/{id}', [MainController::class, 'news_category']);
Route::get('/news-category', [MainController::class, 'news_category']);
Route::get('/news', [MainController::class, 'news_category']);
Route::get('/news/{id}', [MainController::class, 'news']);
Route::get('/members', [MainController::class, 'members']);
Route::get('/dinner', [MainController::class, 'dinner']);
Route::get('/ucc', function(){ return view('chair-person-message'); });
Route::get('/vision-mission', function(){ return view('vision-mission'); }); 
Route::get('/constitution', function(){ return view('constitution'); }); 
Route::get('/register', [AccountController::class, 'register'])->name('register');

Route::get('/login', [AccountController::class, 'login'])->name('login')
    ->middleware(RedirectIfAuthenticated::class);

Route::post('/register', [AccountController::class, 'register_post'])
    ->middleware(RedirectIfAuthenticated::class);

Route::post('/login', [AccountController::class, 'login_post'])
    ->middleware(RedirectIfAuthenticated::class);


Route::get('/dashboard', [AccountController::class, 'dashboard'])
    ->middleware(Authenticate::class);


Route::get('/account-details', [AccountController::class, 'account_details'])
    ->middleware(Authenticate::class);

Route::post('/account-details', [AccountController::class, 'account_details_post'])
    ->middleware(Authenticate::class);

Route::get('/logout', [AccountController::class, 'logout']);
 */