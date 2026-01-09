<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\LegalAidCheck;
use App\Notifications\NewLegalAidCheckNotification;
use Illuminate\Http\Request;

class LegalAidCheckController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'legal_issue_type' => 'required|string|max:255',
            'has_insurance' => 'required|in:yes,no,unsure',
            'income_range' => 'required|in:low,average,above_average,high',
            'employment_status' => 'required|in:employed,unemployed,self_employed',
        ], [
            'name.required' => __('Name is required'),
            'email.required' => __('Email is required'),
            'email.email' => __('Please enter a valid email address'),
            'phone.required' => __('Phone is required'),
            'legal_issue_type.required' => __('Legal issue type is required'),
            'has_insurance.required' => __('Insurance status is required'),
            'income_range.required' => __('Income range is required'),
            'employment_status.required' => __('Employment status is required'),
        ]);

        $legalAidCheck = LegalAidCheck::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'legal_issue_type' => $request->legal_issue_type,
            'has_insurance' => $request->has_insurance,
            'income_range' => $request->income_range,
            'employment_status' => $request->employment_status,
            'status' => 'pending',
        ]);

        // Send notification to all admins
        try {
            $admins = Admin::all();
            foreach ($admins as $admin) {
                $admin->notify(new NewLegalAidCheckNotification($legalAidCheck));
            }
        } catch (\Exception $e) {
            info('Admin notification error: ' . $e->getMessage());
        }

        // Determine eligibility
        $isEligible = $request->has_insurance === 'yes' || $request->income_range === 'low';

        return response()->json([
            'success' => true,
            'eligible' => $isEligible,
            'message' => $isEligible 
                ? __('Based on your answers, you may be eligible for financial assistance. Our team will review your information and contact you within 24 hours to discuss your options.')
                : __('While you may not qualify for traditional legal aid, we offer affordable fixed-price legal services. Contact us to discuss payment plans and options that work for you.')
        ]);
    }
}

