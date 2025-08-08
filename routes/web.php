<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// نظام التسجيل
Auth::routes();

// تبديل اللغة
Route::get('/language/{locale}', [App\Http\Controllers\Frontend\LanguageController::class, 'switch'])->name('language.switch');

// تضمين مسارات الواجهة الأمامية
require __DIR__.'/frontend.php';

// تضمين مسارات لوحة التحكم
require __DIR__.'/admin.php';
