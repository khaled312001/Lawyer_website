<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LawyerJoinRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LawyerJoinRequestController extends Controller
{
    public function index(Request $request)
    {
        checkAdminHasPermissionAndThrowException('admin.view');

        $query = LawyerJoinRequest::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('lawyer_name', 'like', "%$search%")
                  ->orWhere('lawyer_email', 'like', "%$search%")
                  ->orWhere('specialization', 'like', "%$search%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orderBy = $request->filled('order_by') && $request->order_by == 1 ? 'asc' : 'desc';
        $perPage = $request->get('per-page', 10);

        $lawyerJoinRequests = $perPage === 'all'
            ? $query->orderBy('created_at', $orderBy)->get()
            : $query->orderBy('created_at', $orderBy)->paginate((int) $perPage)->withQueryString();

        return view('admin.lawyer-join-requests.index', compact('lawyerJoinRequests'));
    }

    public function show($id)
    {
        checkAdminHasPermissionAndThrowException('admin.view');

        $joinRequest = LawyerJoinRequest::findOrFail($id);

        return view('admin.lawyer-join-requests.show', compact('joinRequest'));
    }

    public function update(Request $request, $id)
    {
        checkAdminHasPermissionAndThrowException('admin.view');

        $request->validate([
            'status'      => 'required|in:pending,reviewed,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $joinRequest = LawyerJoinRequest::findOrFail($id);
        $joinRequest->update([
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        $notification = ['message' => __('Request updated successfully'), 'alert-type' => 'success'];
        return redirect()->route('admin.lawyer-join-requests.show', $id)->with($notification);
    }

    public function destroy($id)
    {
        checkAdminHasPermissionAndThrowException('admin.view');

        $joinRequest = LawyerJoinRequest::findOrFail($id);

        if ($joinRequest->cv_path) {
            Storage::disk('public')->delete($joinRequest->cv_path);
        }

        $joinRequest->delete();

        $notification = ['message' => __('Request deleted successfully'), 'alert-type' => 'success'];
        return redirect()->route('admin.lawyer-join-requests.index')->with($notification);
    }
}
