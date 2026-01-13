<?php

use Illuminate\Support\Facades\Route;
use Modules\RealEstate\app\Http\Controllers\RealEstateController;
use Modules\RealEstate\app\Http\Controllers\RealEstateInquiryController;

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth:admin', 'translation']], function () {
    Route::resource('real-estate', RealEstateController::class)->names('real-estate')->except('show');
    Route::put('/real-estate/status-update/{id}', [RealEstateController::class, 'statusUpdate'])->name('real-estate.status-update');
    Route::put('/real-estate/featured-update/{id}', [RealEstateController::class, 'featuredUpdate'])->name('real-estate.featured-update');

    // Real Estate Inquiries
    Route::resource('real-estate-inquiries', RealEstateInquiryController::class)->names('real-estate.inquiries')->only(['index', 'show', 'update', 'destroy']);
    Route::put('/real-estate-inquiries/status-update/{id}', [RealEstateInquiryController::class, 'updateStatus'])->name('real-estate.inquiries.status-update');
});