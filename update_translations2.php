<?php

$translations = [
    "منصّة قانونية مُدارة من سويسرا" => "Legal platform managed from Switzerland",
    "خبراء القانون" => "Law Experts",
    "السوري والسويسري" => "Syrian and Swiss",
    "Aman Law – أمان لو" => "Aman Law - أمان لو",
    "نربط بين محامين مختصين داخل سوريا وعملاء حول العالم، لتقديم استشارات قانونية موثوقة وتمثيل قضائي احترافي بإشراف سويسري." => "We connect specialized lawyers inside Syria with clients worldwide, providing reliable legal consultations and professional representation under Swiss supervision.",
    "احجز استشارة مجانية" => "Book a Free Consultation"
];

$jsonPath = __DIR__ . '/lang/en.json';
if(file_exists($jsonPath)) {
    $data = json_decode(file_get_contents($jsonPath), true);
    foreach ($translations as $ar => $en) {
        if (!isset($data[$ar])) {
            $data[$ar] = $en;
        }
    }
    file_put_contents($jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "en.json updated.\n";
} else {
    echo "en.json not found at $jsonPath.\n";
}
