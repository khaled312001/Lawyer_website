<?php

namespace Modules\RealEstate\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RealEstateInquiry;
use Modules\RealEstate\app\Models\RealEstate;

class RealEstateInquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        checkAdminHasPermissionAndThrowException('real_estate.view');

        $query = RealEstateInquiry::with(['realEstate.translation', 'user']);

        // Search by name, email, phone
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%")
                  ->orWhere('phone', 'like', "%{$keyword}%")
                  ->orWhere('message', 'like', "%{$keyword}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by property
        if ($request->filled('property_id')) {
            $query->where('property_id', $request->property_id);
        }

        // Sort options
        $orderBy = $request->filled('order_by') && $request->order_by == 1 ? 'asc' : 'desc';

        if ($request->filled('par-page')) {
            $inquiries = $request->get('par-page') == 'all'
                ? $query->orderBy('created_at', $orderBy)->get()
                : $query->orderBy('created_at', $orderBy)->paginate($request->get('par-page'))->withQueryString();
        } else {
            $inquiries = $query->orderBy('created_at', $orderBy)->paginate(10)->withQueryString();
        }

        // Get properties for filter dropdown
        $properties = RealEstate::active()->with('translation')->get();

        return view('realestate::inquiries.index', compact('inquiries', 'properties'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        checkAdminHasPermissionAndThrowException('real_estate.view');

        $inquiry = RealEstateInquiry::with(['realEstate.translation', 'user'])->findOrFail($id);

        return view('realestate::inquiries.show', compact('inquiry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        checkAdminHasPermissionAndThrowException('real_estate.update');

        $request->validate([
            'status' => 'required|in:new,pending,contacted,closed',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $inquiry = RealEstateInquiry::findOrFail($id);
        $inquiry->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->back()->with('success', __('Inquiry updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        checkAdminHasPermissionAndThrowException('real_estate.delete');

        RealEstateInquiry::findOrFail($id)->delete();

        return redirect()->route('admin.real-estate.inquiries.index')->with('success', __('Inquiry deleted successfully'));
    }

    public function updateStatus(Request $request, $id)
    {
        checkAdminHasPermissionAndThrowException('real_estate.update');

        $request->validate([
            'status' => 'required|in:new,pending,contacted,closed',
        ]);

        $inquiry = RealEstateInquiry::findOrFail($id);
        $inquiry->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => __('Status updated successfully'),
        ]);
    }
}