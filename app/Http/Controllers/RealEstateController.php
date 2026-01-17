<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use App\Models\RealEstateInquiry;
use Modules\RealEstate\app\Models\RealEstate as ModuleRealEstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RealEstateController extends Controller
{
    /**
     * Display a listing of real estate properties
     */
    public function index(Request $request)
    {
        // Get real estate properties
        $query = ModuleRealEstate::active()->with(['translation', 'translations']);

        // Search by title or description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('translation', function($trans) use ($search) {
                    $trans->where('title', 'like', "%{$search}%")
                          ->orWhere('description', 'like', "%{$search}%");
                });
            });
        }

        // Filter by property type
        if ($request->filled('property_type')) {
            $query->where('property_type', $request->property_type);
        }

        // Filter by listing type
        if ($request->filled('listing_type')) {
            $query->where('listing_type', $request->listing_type);
        }

        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by area
        if ($request->filled('min_area')) {
            $query->where('area', '>=', $request->min_area);
        }
        if ($request->filled('max_area')) {
            $query->where('area', '<=', $request->max_area);
        }

        // Sort options
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'area':
                $query->orderBy('area', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default: // latest
                $query->orderBy('created_at', 'desc');
        }

        $properties = $query->paginate(12)->withQueryString();

        // Get filter options
        $cities = ModuleRealEstate::active()
            ->select('city')
            ->distinct()
            ->pluck('city')
            ->filter()
            ->sort();

        $propertyTypes = [
            'apartment' => __('Apartment'),
            'villa' => __('Villa'),
            'office' => __('Office'),
            'land' => __('Land'),
            'shop' => __('Shop'),
            'warehouse' => __('Warehouse'),
        ];

        return view('client.real-estate.index', compact(
            'properties',
            'cities',
            'propertyTypes'
        ));
    }

    /**
     * Display the specified real estate property
     */
    public function show($slug)
    {
        $property = ModuleRealEstate::active()->where('slug', $slug)->with(['translation', 'translations'])->firstOrFail();

        // Increment views
        $property->incrementViews();

        // Get similar properties
        $similarProperties = ModuleRealEstate::active()
            ->where('property_type', $property->property_type)
            ->where('id', '!=', $property->id)
            ->with(['translation', 'translations'])
            ->limit(4)
            ->get();

        return view('client.real-estate.show', compact('property', 'similarProperties'));
    }

    /**
     * Show interest form for a property
     */
    public function showInterest($slug)
    {
        $property = ModuleRealEstate::active()->where('slug', $slug)->with('translation')->firstOrFail();

        return view('client.real-estate.interest', compact('property'));
    }

    /**
     * Store property interest
     */
    public function storeInterest(Request $request, $slug)
    {
        $property = ModuleRealEstate::active()->where('slug', $slug)->with('translation')->firstOrFail();

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
