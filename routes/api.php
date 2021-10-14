<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;

use Illuminate\Http\Request;

// начальные установки
Route::post('/settings', [SettingController::class, 'index']);

