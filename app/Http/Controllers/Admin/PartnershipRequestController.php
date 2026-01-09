<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipRequest;
use Illuminate\Http\Request;

class PartnershipRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        checkAdminHasPermissionAndThrowException('partnership.request.view');
        
        $query = PartnershipRequest::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by partnership type
        if ($request->filled('partnership_type')) {
            $query->where('partnership_type', $request->partnership_type);
        }

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%");
            });
        }

        $orderBy = $request->filled('order_by') && $request->order_by == 1 ? 'asc' : 'desc';
        $perPage = $request->filled('per-page') ? $request->get('per-page') : 10;

        $partnershipRequests = $query->orderBy('created_at', $orderBy)->paginate($perPage)->withQueryString();

        return view('admin.partnership-requests.index', compact('partnershipRequests'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        checkAdminHasPermissionAndThrowException('partnership.request.view');
        
        $partnershipRequest = PartnershipRequest::findOrFail($id);
        
        return view('admin.partnership-requests.show', compact('partnershipRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        checkAdminHasPermissionAndThrowException('partnership.request.update');
        
        $request->validate([
            'status' => 'required|in:pending,reviewed,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $partnershipRequest = PartnershipRequest::findOrFail($id);
        $partnershipRequest->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->route('admin.partnership-requests.index')
            ->with('success', __('Partnership request updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        checkAdminHasPermissionAndThrowException('partnership.request.delete');
        
        $partnershipRequest = PartnershipRequest::findOrFail($id);
        $partnershipRequest->delete();

        return redirect()->route('admin.partnership-requests.index')
            ->with('success', __('Partnership request deleted successfully.'));
    }
}
