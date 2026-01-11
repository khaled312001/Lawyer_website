<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use App\Models\RealEstateInquiry;
use Modules\Lawyer\app\Models\Lawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RealEstateController extends Controller
{
    /**
     * Display a listing of real estate lawyers
     */
    public function index(Request $request)
    {
        // Get lawyers specialized in real estate law (department name contains "عقار" or "real estate")
        $query = Lawyer::active()->verify()
            ->whereHas('department.translation', function($q) {
                $q->where('name', 'like', '%عقار%')
                  ->orWhere('name', 'like', '%real estate%')
                  ->orWhere('name', 'like', '%property%');
            })
            ->with(['department.translation', 'translation']);

        // Search by lawyer name or department
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('department.translation', function($dept) use ($search) {
                      $dept->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('translation', function($trans) use ($search) {
                      $trans->where('designations', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by department
        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location_id', $request->location);
        }

        // Sort options
        $sortBy = $request->get('sort', 'name');
        switch ($sortBy) {
            case 'experience':
                $query->orderBy('years_of_experience', 'desc');
                break;
            case 'rating':
                $query->orderByRaw('COALESCE(average_rating, 0) DESC');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default: // name
                $query->orderBy('name', 'asc');
        }

        $lawyers = $query->paginate(12)->withQueryString();

        // Add rating data to each lawyer
        foreach ($lawyers as $lawyer) {
            $lawyer->average_rating = $lawyer->getAverageRatingAttribute();
            $lawyer->total_ratings = $lawyer->getTotalRatingsAttribute();
        }

        // Get filter options
        $departments = \Modules\Lawyer\app\Models\Department::active()
            ->whereHas('translation', function($q) {
                $q->where('name', 'like', '%عقار%')
                  ->orWhere('name', 'like', '%real estate%')
                  ->orWhere('name', 'like', '%property%');
            })
            ->with('translation')
            ->get();

        $locations = \Modules\Lawyer\app\Models\Location::active()->with('translation')->get();

        return view('client.real-estate.index', compact(
            'lawyers',
            'departments',
            'locations'
        ));
    }

    /**
     * Display the specified real estate property
     */
    public function show($slug)
    {
        $property = RealEstate::active()->where('slug', $slug)->firstOrFail();

        // Increment views
        $property->incrementViews();

        // Get similar properties
        $similarProperties = RealEstate::active()
            ->where('property_type', $property->property_type)
            ->where('id', '!=', $property->id)
            ->limit(4)
            ->get();

        return view('client.real-estate.show', compact('property', 'similarProperties'));
    }

    /**
     * Show interest form for a property
     */
    public function showInterest($slug)
    {
        $property = RealEstate::active()->where('slug', $slug)->firstOrFail();

        return view('client.real-estate.interest', compact('property'));
    }

    /**
     * Store property interest
     */
    public function storeInterest(Request $request, $slug)
    {
        $property = RealEstate::active()->where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|string|max:1000',
        ]);

        try {
            // Save inquiry to database
            $inquiry = RealEstateInquiry::create([
                'real_estate_id' => $property->id,
                'user_id' => auth()->id(),
                'name' => $validated['name'],
                'email' => $validated['email'] ?? null,
                'phone' => $validated['phone'],
                'message' => $validated['message'] ?? null,
                'preferred_contact_method' => $validated['email'] ? 'both' : 'phone',
                'status' => 'new',
                'metadata' => [
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'source' => 'website_interest_form'
                ]
            ]);

            // Send notification email to property owner
            $this->sendInterestNotification($property, $validated, $inquiry);

            return back()->with('success', __('Thank you for your interest! We will contact you soon.'));
        } catch (\Exception $e) {
            return back()->with('error', __('Failed to submit your inquiry. Please try again.'))->withInput();
        }
    }

    /**
     * Send interest notification email
     */
    private function sendInterestNotification($property, $data, $inquiry)
    {
        // This is a placeholder for email functionality
        // You would implement actual email sending here

        $message = "New interest in property: {$property->title}\n\n";
        $message .= "Inquiry ID: {$inquiry->id}\n";
        $message .= "Property: {$property->title}\n";
        $message .= "Location: {$property->location_string}\n";
        $message .= "Price: {$property->formatted_price}\n\n";

        $message .= "Client Information:\n";
        $message .= "Name: {$data['name']}\n";
        $message .= "Phone: {$data['phone']}\n";
        if (isset($data['email'])) {
            $message .= "Email: {$data['email']}\n";
        }
        if (isset($data['message'])) {
            $message .= "Message: {$data['message']}\n";
        }

        $message .= "\nProperty Contact: {$property->contact_name} - {$property->contact_phone}";
        if ($property->contact_email) {
            $message .= " / {$property->contact_email}";
        }

        // For now, we'll just log it
        \Log::info('Property Interest Notification', [
            'inquiry_id' => $inquiry->id,
            'property' => $property->title,
            'client' => $data['name'] . ' (' . $data['phone'] . ')',
            'contact' => $property->contact_email ?? $property->contact_phone,
            'message' => $message
        ]);
    }
}
