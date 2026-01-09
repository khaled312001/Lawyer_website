<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\PartnershipRequest;
use App\Notifications\NewPartnershipRequestNotification;
use Illuminate\Http\Request;

class PartnershipRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'partnership_type' => 'required|in:law_firm,legal_tech,business,other',
            'message' => 'required|string',
        ], [
            'name.required' => __('Name is required'),
            'email.required' => __('Email is required'),
            'email.email' => __('Please enter a valid email address'),
            'partnership_type.required' => __('Partnership type is required'),
            'message.required' => __('Message is required'),
        ]);

        $partnershipRequest = PartnershipRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'company' => $request->company,
            'partnership_type' => $request->partnership_type,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        // Send notification to all admins
        try {
            $admins = Admin::all();
            foreach ($admins as $admin) {
                $admin->notify(new NewPartnershipRequestNotification($partnershipRequest));
            }
        } catch (\Exception $e) {
            info('Admin notification error: ' . $e->getMessage());
        }

        return redirect()->route('website.partnerships')
            ->with('success', __('Your partnership request has been submitted successfully. We will contact you soon.'));
    }
}
