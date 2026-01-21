<?php

/**
 * Add English translations for blog articles
 * إضافة الترجمات الإنجليزية للمقالات
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Modules\Blog\app\Models\Blog;
use Modules\Blog\app\Models\BlogTranslation;

try {
    echo "========================================\n";
    echo "إضافة الترجمات الإنجليزية للمقالات\n";
    echo "Add English Translations for Blog Articles\n";
    echo "========================================\n\n";

    // تعريف الترجمات الإنجليزية للمقالات
    $englishTranslations = [
        'التوثيق القانوني في سوريا: دليل شامل' => [
            'title' => 'Legal Documentation in Syria: A Comprehensive Guide',
            'sort_description' => 'Learn about the importance of legal documentation in Syria, and how proper documentation can protect you from future legal problems.',
            'description' => '<p>Legal documentation in Syria is the process of documenting all transactions and agreements legally. Proper documentation can protect you from disputes and future problems.</p>

<h3>What is Legal Documentation?</h3>
<p>Legal documentation is the process of formally and legally documenting all transactions and agreements. This includes documenting contracts, agreements, and various transactions.</p>

<h3>Types of Legal Documentation</h3>
<p>We provide documentation services in:</p>
<ul>
<li>Contract documentation</li>
<li>Agreement documentation</li>
<li>Commercial transaction documentation</li>
<li>Property documentation</li>
<li>Will documentation</li>
</ul>

<h3>Why Do You Need Legal Documentation?</h3>
<p>Legal documentation provides:</p>
<ul>
<li>Complete legal protection</li>
<li>Proof of rights</li>
<li>Prevention of disputes</li>
<li>Official recognized documents</li>
<li>Protection against forgery</li>
</ul>

<h3>Our Services</h3>
<p>We provide comprehensive legal documentation services, ensuring that all documents comply with Syrian laws and are officially recognized.</p>',
            'seo_title' => 'Legal Documentation in Syria: A Comprehensive Guide',
            'seo_description' => 'Learn about the importance of legal documentation in Syria, and how proper documentation can protect you from future legal problems.'
        ],
        'التحكيم في سوريا: دليل شامل' => [
            'title' => 'Arbitration in Syria: A Comprehensive Guide',
            'sort_description' => 'Learn about the arbitration system in Syria, and how it can be an effective alternative to courts in resolving commercial and legal disputes.',
            'description' => '<p>Arbitration in Syria is an alternative method for resolving disputes without resorting to courts. Arbitration can be faster and less expensive than traditional courts.</p>

<h3>What is Arbitration?</h3>
<p>Arbitration is the process of resolving disputes through a neutral arbitrator instead of courts. The arbitrator hears all parties and makes a binding decision.</p>

<h3>When to Use Arbitration?</h3>
<p>Arbitration is suitable in the following cases:</p>
<ul>
<li>Commercial disputes</li>
<li>Contract disputes</li>
<li>International commercial disputes</li>
<li>When seeking a quick resolution</li>
<li>When confidentiality is needed</li>
</ul>

<h3>Benefits of Arbitration</h3>
<p>Arbitration provides several benefits:</p>
<ul>
<li>Faster resolution</li>
<li>Lower cost than courts</li>
<li>Flexibility in procedures</li>
<li>Greater confidentiality</li>
<li>Specialized expertise</li>
</ul>

<h3>Our Services</h3>
<p>We provide comprehensive arbitration services, from preparing arbitration agreements to representing you in arbitration sessions.</p>',
            'seo_title' => 'Arbitration in Syria: A Comprehensive Guide',
            'seo_description' => 'Learn about the arbitration system in Syria, and how it can be an effective alternative to courts in resolving commercial and legal disputes.'
        ],
        'حل النزاعات في سوريا: دليل شامل' => [
            'title' => 'Dispute Resolution in Syria: A Comprehensive Guide',
            'sort_description' => 'Learn about methods of dispute resolution in Syria, and how a specialized lawyer can help you resolve your disputes peacefully and effectively.',
            'description' => '<p>Dispute resolution in Syria can be done in several ways, from direct negotiation to arbitration and courts. A specialized lawyer can help you choose the best method to resolve your dispute.</p>

<h3>What are the Methods of Dispute Resolution?</h3>
<p>There are several methods for resolving disputes in Syria:</p>
<ul>
<li>Direct negotiation</li>
<li>Mediation</li>
<li>Arbitration</li>
<li>Courts</li>
</ul>

<h3>When Do You Need a Lawyer for Dispute Resolution?</h3>
<p>You should consult a lawyer in the following cases:</p>
<ul>
<li>When there is a legal dispute</li>
<li>When direct negotiation fails</li>
<li>When legal mediation is needed</li>
<li>When arbitration is needed</li>
<li>When a lawsuit needs to be filed</li>
</ul>

<h3>Benefits of Legal Dispute Resolution</h3>
<p>Legal dispute resolution provides:</p>
<ul>
<li>Quick and effective resolution</li>
<li>Saving time and money</li>
<li>Protection of your rights</li>
<li>Avoiding legal complications</li>
<li>Fair and balanced results</li>
</ul>

<h3>Our Services</h3>
<p>We provide comprehensive dispute resolution services, from negotiation and mediation to arbitration and court representation.</p>',
            'seo_title' => 'Dispute Resolution in Syria: A Comprehensive Guide',
            'seo_description' => 'Learn about methods of dispute resolution in Syria, and how a specialized lawyer can help you resolve your disputes peacefully and effectively.'
        ],
        'تسجيل الشركات في سوريا: دليل شامل' => [
            'title' => 'Company Registration in Syria: A Comprehensive Guide',
            'sort_description' => 'Learn about company registration procedures in Syria, and how a specialized lawyer can help you establish your company legally and correctly.',
            'description' => '<p>Company registration in Syria requires complex legal procedures and multiple documents. A specialized lawyer can facilitate this process and ensure that your company is registered legally and correctly.</p>

<h3>What is Company Registration?</h3>
<p>Company registration is the process of creating a legal company in Syria according to Syrian laws and regulations. Proper registration ensures that your company is legal and can conduct business legally.</p>

<h3>Types of Companies in Syria</h3>
<p>Different types of companies can be registered in Syria:</p>
<ul>
<li>Partnership companies</li>
<li>Limited partnership companies</li>
<li>Joint stock companies</li>
<li>Limited liability companies</li>
<li>Sole proprietorships</li>
</ul>

<h3>Company Registration Procedures</h3>
<p>Company registration requires:</p>
<ul>
<li>Choosing a company name</li>
<li>Determining the company type</li>
<li>Preparing the articles of association</li>
<li>Registering capital</li>
<li>Obtaining necessary licenses</li>
</ul>

<h3>Our Services</h3>
<p>We provide comprehensive company registration services, from the beginning of procedures until obtaining all necessary licenses and permits.</p>',
            'seo_title' => 'Company Registration in Syria: A Comprehensive Guide',
            'seo_description' => 'Learn about company registration procedures in Syria, and how a specialized lawyer can help you establish your company legally and correctly.'
        ],
        'التمثيل في المحاكم في سوريا: دليل شامل' => [
            'title' => 'Court Representation in Syria: A Comprehensive Guide',
            'sort_description' => 'Learn about the importance of legal representation in Syrian courts, and how a specialized lawyer can help you obtain your rights.',
            'description' => '<p>Court representation in Syria requires a specialized lawyer with extensive experience in the Syrian judicial system. A good lawyer can make a big difference in the outcome of your case.</p>

<h3>What is Court Representation?</h3>
<p>Court representation means that the lawyer takes charge of representing you before courts and judicial authorities. The lawyer prepares the case, presents evidence, and defends your rights.</p>

<h3>When Do You Need Legal Representation?</h3>
<p>You should obtain legal representation in the following cases:</p>
<ul>
<li>When filing a lawsuit</li>
<li>When summoned to court</li>
<li>When facing charges</li>
<li>When you need to defend your rights</li>
<li>When dealing with complex cases</li>
</ul>

<h3>Benefits of Legal Representation</h3>
<p>Specialized legal representation provides you with:</p>
<ul>
<li>Extensive legal expertise</li>
<li>Strong case preparation</li>
<li>Effective representation in courts</li>
<li>Increased chances of success</li>
<li>Complete protection of your rights</li>
</ul>

<h3>Our Services</h3>
<p>We provide comprehensive legal representation services in all Syrian courts. Our specialized legal team is ready to represent you and defend your rights.</p>',
            'seo_title' => 'Court Representation in Syria: A Comprehensive Guide',
            'seo_description' => 'Learn about the importance of legal representation in Syrian courts, and how a specialized lawyer can help you obtain your rights.'
        ],
        'صياغة العقود في سوريا: دليل شامل' => [
            'title' => 'Contract Drafting in Syria: A Comprehensive Guide',
            'sort_description' => 'Learn about the importance of drafting contracts correctly in Syria, and how a well-drafted legal contract can protect you from future problems.',
            'description' => '<p>Contract drafting in Syria requires extensive legal experience and precise knowledge of Syrian laws. A well-drafted legal contract can protect you from disputes and future problems.</p>

<h3>What is Contract Drafting?</h3>
<p>Contract drafting is the process of writing a legal contract that clearly and comprehensively defines the rights and obligations of all parties. A good contract should be clear, comprehensive, and compliant with Syrian laws.</p>

<h3>Types of Contracts We Provide</h3>
<p>We provide contract drafting services in all fields:</p>
<ul>
<li>Employment contracts</li>
<li>Sales and purchase contracts</li>
<li>Lease contracts</li>
<li>Partnership contracts</li>
<li>Service contracts</li>
<li>Commercial contracts</li>
</ul>

<h3>Why Do You Need a Lawyer for Contract Drafting?</h3>
<p>A specialized lawyer can:</p>
<ul>
<li>Ensure contract compliance with Syrian laws</li>
<li>Protect your rights in the contract</li>
<li>Avoid legal loopholes</li>
<li>Add appropriate protective clauses</li>
<li>Ensure clarity of all terms</li>
</ul>

<h3>Our Services</h3>
<p>We provide comprehensive contract drafting services, ensuring that all contracts comply with Syrian laws and fully protect your interests.</p>',
            'seo_title' => 'Contract Drafting in Syria: A Comprehensive Guide',
            'seo_description' => 'Learn about the importance of drafting contracts correctly in Syria, and how a well-drafted legal contract can protect you from future problems.'
        ],
        'الاستشارات القانونية في سوريا: دليل شامل' => [
            'title' => 'Legal Consultations in Syria: A Comprehensive Guide',
            'sort_description' => 'Learn about the importance of legal consultations in Syria, and how proper legal advice can help you make the right decisions and protect your legal rights.',
            'description' => '<p>Legal consultations in Syria are among the most important legal services needed by individuals and companies. Proper legal advice can save you a lot of time, effort, and money.</p>

<h3>What are Legal Consultations?</h3>
<p>Legal consultations are the process of obtaining specialized legal opinion on a specific case or legal matter. A specialized lawyer analyzes the legal situation and provides appropriate advice and guidance.</p>

<h3>When Do You Need Legal Consultation?</h3>
<p>You should obtain legal consultation in the following cases:</p>
<ul>
<li>Before signing any important contract</li>
<li>When starting a new business</li>
<li>When facing a legal dispute</li>
<li>When you need to understand your legal rights and obligations</li>
<li>When dealing with legally complex issues</li>
</ul>

<h3>Benefits of Legal Consultations</h3>
<p>Legal consultations provide you with:</p>
<ul>
<li>Clear understanding of your rights and obligations</li>
<li>Avoiding future legal problems</li>
<li>Making correct legal decisions</li>
<li>Saving time and money</li>
<li>Protecting your legal interests</li>
</ul>

<h3>Our Legal Consultation Services</h3>
<p>We provide comprehensive legal consultations in all legal fields in Syria. Our specialized legal team is ready to provide appropriate legal advice and guidance for all your cases.</p>',
            'seo_title' => 'Legal Consultations in Syria: A Comprehensive Guide',
            'seo_description' => 'Learn about the importance of legal consultations in Syria, and how proper legal advice can help you make the right decisions and protect your legal rights.'
        ]
    ];

    $updatedCount = 0;
    $notFoundCount = 0;

    // البحث عن كل مقال وإضافة الترجمة الإنجليزية
    foreach ($englishTranslations as $arabicTitle => $englishContent) {
        // البحث عن المقال بالعنوان العربي
        $blog = Blog::whereHas('translations', function($query) use ($arabicTitle) {
            $query->where('lang_code', 'ar')
                  ->where('title', $arabicTitle);
        })->first();

        if (!$blog) {
            echo "✗ لم يتم العثور على المقال: {$arabicTitle}\n";
            $notFoundCount++;
            continue;
        }

        // التحقق من وجود ترجمة إنجليزية
        $existingTranslation = BlogTranslation::where('blog_id', $blog->id)
            ->where('lang_code', 'en')
            ->first();

        if ($existingTranslation) {
            // تحديث الترجمة الموجودة
            $existingTranslation->update([
                'title' => $englishContent['title'],
                'sort_description' => $englishContent['sort_description'],
                'description' => $englishContent['description'],
                'seo_title' => $englishContent['seo_title'],
                'seo_description' => $englishContent['seo_description'],
            ]);
            echo "✓ تم تحديث الترجمة الإنجليزية للمقال: {$arabicTitle}\n";
        } else {
            // إنشاء ترجمة إنجليزية جديدة
            BlogTranslation::create([
                'blog_id' => $blog->id,
                'lang_code' => 'en',
                'title' => $englishContent['title'],
                'sort_description' => $englishContent['sort_description'],
                'description' => $englishContent['description'],
                'seo_title' => $englishContent['seo_title'],
                'seo_description' => $englishContent['seo_description'],
            ]);
            echo "✓ تم إضافة الترجمة الإنجليزية للمقال: {$arabicTitle}\n";
        }
        $updatedCount++;
    }

    echo "\n========================================\n";
    echo "اكتمل التحديث!\n";
    echo "Completed!\n";
    echo "========================================\n";
    echo "تم تحديث/إضافة: {$updatedCount} مقال\n";
    echo "Updated/Added: {$updatedCount} articles\n";
    if ($notFoundCount > 0) {
        echo "لم يتم العثور على: {$notFoundCount} مقال\n";
        echo "Not found: {$notFoundCount} articles\n";
    }
    echo "========================================\n";

} catch (Exception $e) {
    echo "✗ حدث خطأ: " . $e->getMessage() . "\n";
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
    exit(1);
}
