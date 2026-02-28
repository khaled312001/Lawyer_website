<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

//maintenance mode route
Route::get('/maintenance-mode', function () {
    $setting = Illuminate\Support\Facades\Cache::get('setting', null);
    if (! $setting?->maintenance_mode) {
        return redirect()->route('home');
    }
    return view('maintenance');
})->name('maintenance.mode');

Route::get('set-language', [DashboardController::class, 'setLanguage'])->name('set-language');
Route::get('set-currency', [DashboardController::class, 'setCurrency'])->name('set-currency');

require __DIR__ . '/admin.php';
require __DIR__ . '/lawyer.php';
require __DIR__ . '/client.php';
require __DIR__ . '/website.php';

Route::get('/fix-blogs', function () {
    $updates = [
        'التحكيم' => [ 'img' => 'blog_arbitration.png' ],
        'تسجيل الشركات' => [ 'img' => 'blog_company_registration.png', 'feat' => 1 ],
        'التوثيق' => [ 'img' => 'blog_legal_doc.png' ],
        'حل النزاعات' => [ 'img' => 'blog_dispute_resolution.png' ],
        'التمثيل في المحاكم' => [ 'img' => 'blog_court_representation.png' ],
        'صياغة العقود' => [ 'img' => 'blog_contract_drafting.png' ],
        'الاستشارات' => [ 'img' => 'blog_legal_consultation.png' ],
    ];

    $results = [];

    foreach ($updates as $keyword => $data) {
        // Find translation using a partial match
        $translation = \Modules\Blog\app\Models\BlogTranslation::where('title', 'like', "%{$keyword}%")->first();
        
        if ($translation) {
            $blog = \Modules\Blog\app\Models\Blog::find($translation->blog_id);
            if ($blog) {
                $blog->image = 'uploads/custom-images/blog/' . $data['img'];
                $blog->thumbnail_image = 'uploads/custom-images/blog/' . $data['img'];
                $blog->show_homepage = 1;
                $blog->status = 1; // Make it active just in case
                if (isset($data['feat'])) {
                    $blog->is_feature = 1;
                }
                $blog->save();
                $results[] = "Updated blog ID: {$blog->id} - {$translation->title}";
            }
        }
    }

    return response()->json(['message' => 'Blogs updated successfully!', 'updated' => $results]);
});

Route::fallback(function () {
    abort(404);
});