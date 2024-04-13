<?php

use App\Http\Controllers\api\StorageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/api/v1/storage', [StorageController::class, 'storage'])->name('storage.api');
