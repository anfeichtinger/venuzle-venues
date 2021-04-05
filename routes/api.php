<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\VenueController;

Route::group(['prefix' => 'venues'], function () {
    Route::get('/', [VenueController::class, 'index']);
    Route::post('add', [VenueController::class, 'add']);
    Route::get('edit/{id}', [VenueController::class, 'edit']);
    Route::post('update/{id}', [VenueController::class, 'update']);
    Route::delete('delete/{id}', [VenueController::class, 'delete']);
});
