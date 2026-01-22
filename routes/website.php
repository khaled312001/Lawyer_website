<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RealEstateController;
use App\Http\Controllers\Client\AppointmentController;
use App\Http\Controllers\Client\BlogController;
use Illuminate\Support\Facades\Route;

// Sitemap route (should be accessible without maintenance mode)
Route::get('sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');

// Redirect old language-prefixed URLs to correct format (301 permanent redirects)
Route::middleware(['translation', 'maintenance.mode'])->group(function () {
    // Redirect /en/real-estate/{slug} to /real-estate/{slug}
    Route::get('/en/real-estate/{slug}', function ($slug) {
        return redirect()->route('website.real-estate.show', $slug)->setStatusCode(301);
    });
    
    // Redirect /ar/real-estate/{slug} to /real-estate/{slug}
    Route::get('/ar/real-estate/{slug}', function ($slug) {
        return redirect()->route('website.real-estate.show', $slug)->setStatusCode(301);
    });
    
    // Redirect /en/blog-details/{slug} to /blog-details/{slug}
    Route::get('/en/blog-details/{slug}', function ($slug) {
        return redirect()->route('website.blog.details', $slug)->setStatusCode(301);
    });
    
    // Redirect /ar/blog-details/{slug} to /blog-details/{slug}
    Route::get('/ar/blog-details/{slug}', function ($slug) {
        return redirect()->route('website.blog.details', $slug)->setStatusCode(301);
    });
});

Route::middleware(['translation', 'maintenance.mode'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('home', fn() => to_route('home'));

    Route::name('website.')->group(function () {
        Route::view('contact-us', 'client.contact-us')->name('contact-us');
        Route::controller(HomeController::class)->group(function () {
            Route::get('/about-us', 'aboutUs');
            Route::get('/service', 'service')->name('services');
            Route::get('service-details/{slug}', 'serviceDetails')->name('service.details');
            Route::get('api/service-details/{slug}', 'getServiceDetails')->name('api.service.details');
            Route::get('/real-estate', [RealEstateController::class, 'index'])->name('real-estate');
            Route::get('/real-estate/{slug}', [RealEstateController::class, 'show'])->name('real-estate.show');
            Route::get('/real-estate/{slug}/interest', [RealEstateController::class, 'showInterest'])->name('real-estate.interest');
            Route::post('/real-estate/{slug}/interest', [RealEstateController::class, 'storeInterest'])->name('real-estate.store-interest');
            Route::get('/department', 'department')->name('departments');
            Route::get('/department-details/{slug}', 'departmentDetails')->name('department.details');
            Route::get('lawyers', 'lawyers')->name('lawyers');
            Route::get('lawyer-details/{slug}', 'lawyerDetails')->name('lawyer.details');
            Route::get('/search-lawyer', 'searchLawyer')->name('search.lawyer');
            Route::get('/testimonial', 'testimonial')->name('testimonial');
            Route::get('/faq', 'faq')->name('faq');
            Route::get('privacy-policy', 'privacyPolicy')->name('privacy-policy');
            Route::get('terms-condition', 'termsCondition')->name('termsCondition');
            Route::get('/business-subscription', 'businessSubscription')->name('business.subscription');
            Route::get('/partnerships', 'partnerships')->name('partnerships');
            Route::get('/legal-aid-check', 'legalAidCheck')->name('legal.aid.check');
            Route::get('/book-appointment', 'bookAppointment')->name('book.appointment');
            Route::get('/book-consultation-appointment', 'bookConsultationAppointment')->name('book.consultation.appointment');
        });
        Route::controller(BlogController::class)->group(function () {
            Route::get('/blog', 'blog')->name('blogs');
            Route::get('/blog-details/{slug}', 'blogDetails')->name('blog.details');
            Route::get('/blog-category/{slug}', 'blogCategory')->name('blog.category');
            Route::post('comment-store/{slug}', 'commentStore')->name('comment.store');
        });

        Route::controller(AppointmentController::class)->group(function () {
            // ajax request for appointment
            Route::get('get-appointment/', 'getAppointment');
            Route::get('get-department-lawyer/{id}', 'getDepartmentLawyer');
            Route::get('get-lawyer-department/{id}', 'getLawyerDepartment');

            //appointment add to cart
            Route::post('create-appointment', 'createAppointment')->name('create.appointment');
            Route::get('remove-appointment/{id}', 'removeAppointment');
        });

        Route::controller(\App\Http\Controllers\Client\ConsultationAppointmentController::class)->group(function () {
            Route::post('create-consultation-appointment', 'store')->name('create.consultation.appointment');
        });

        Route::controller(\App\Http\Controllers\Client\PartnershipRequestController::class)->group(function () {
            Route::post('partnership-request', 'store')->name('partnership-request.store');
        });

        Route::controller(\App\Http\Controllers\Client\LegalAidCheckController::class)->group(function () {
            Route::post('legal-aid-check', 'store')->name('legal-aid-check.store');
        });

        Route::get('page/{slug}', [HomeController::class, 'customPage'])->name('page');
    });
});