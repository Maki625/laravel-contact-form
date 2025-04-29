<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// お問合せフォーム入力ページ
Route::get('/', [ContactFormController::class, 'index'])->name('contact.index');

// フォームの確認画面
Route::post('/confirm', [ContactFormController::class, 'submitForm']);

// 送信して保存
Route::post('/submit', [ContactFormController::class, 'store']);

// サンクスページ
Route::get('/thanks', [ContactFormController::class, 'thanks']);

// 管理画面
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/export', [AdminController::class, 'export']);

// 登録フォーム・登録処理
Route::get('/register', [RegisterController::class, 'showForm']);
Route::post('/register', [RegisterController::class, 'register']);

// ログインフォーム・ログイン処理
Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
