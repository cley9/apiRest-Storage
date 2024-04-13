<?php

use App\Http\Controllers\api\StorageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "ApiRest Storage"
});
Route::post('/api/v1/storage', [StorageController::class, 'storage'])->name('storage.api');
Route::get('/api/v1/image/{token}', [StorageController::class, 'enmascarar'])->name('image.api.enmascarar');
