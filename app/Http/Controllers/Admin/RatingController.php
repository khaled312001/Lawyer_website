<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\User;
use App\Traits\RedirectHelperTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Modules\Lawyer\app\Models\Lawyer;

class RatingController extends Controller {
    use RedirectHelperTrait;

    /**
     * Display a listing of ratings.
     */
    public function index(Request $request): View {
        checkAdminHasPermissionAndThrowException('rating.view');
        
        $query = Rating::with(['lawyer', 'user']);

        if ($request->filled('lawyer_id')) {
            $query->where('lawyer_id', $request->lawyer_id);
        }

        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            if ($request->type == 'client') {
                $query->where('is_admin_created', false);
            } elseif ($request->type == 'admin') {
                $query->where('is_admin_created', true);
            }
        }

        $orderBy = $request->filled('order_by') && $request->order_by == 1 ? 'asc' : 'desc';

        if ($request->filled('par-page')) {
            $ratings = $request->get('par-page') == 'all' 
                ? $query->orderBy('id', $orderBy)->get() 
                : $query->orderBy('id', $orderBy)->paginate($request->get('par-page'))->withQueryString();
        } else {
            $ratings = $query->orderBy('id', $orderBy)->paginate(10)->withQueryString();
        }

        $lawyers = Lawyer::select('id', 'name')->active()->get();

        return view('admin.ratings.index', compact('ratings', 'lawyers'));
    }

    /**
     * Show the form for creating a new rating.
     */
    public function create(): View {
        checkAdminHasPermissionAndThrowException('rating.create');
        
        $lawyers = Lawyer::select('id', 'name')->active()->get();
        $clients = User::select('id', 'name', 'email')->active()->get();

        return view('admin.ratings.create', compact('lawyers', 'clients'));
    }

    /**
     * Store a newly created rating.
     */
    public function store(Request $request): RedirectResponse {
        checkAdminHasPermissionAndThrowException('rating.store');

        $validated = $request->validate([
            'lawyer_id' => 'required|exists:lawyers,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $validated['is_admin_created'] = true;
        $validated['created_by_admin_id'] = Auth::guard('admin')->user()->id;
        $validated['status'] = true;

        Rating::create($validated);

        return $this->redirectWithMessage(RedirectType::CREATE->value, 'admin.rating.index');
    }

    /**
     * Show the form for editing the specified rating.
     */
    public function edit($id): View {
        checkAdminHasPermissionAndThrowException('rating.edit');
        
        $rating = Rating::findOrFail($id);
        $lawyers = Lawyer::select('id', 'name')->active()->get();
        $clients = User::select('id', 'name', 'email')->active()->get();

        return view('admin.ratings.edit', compact('rating', 'lawyers', 'clients'));
    }

    /**
     * Update the specified rating.
     */
    public function update(Request $request, $id): RedirectResponse {
        checkAdminHasPermissionAndThrowException('rating.update');

        $rating = Rating::findOrFail($id);

        $validated = $request->validate([
            'lawyer_id' => 'required|exists:lawyers,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'user_id' => 'nullable|exists:users,id',
            'status' => 'required|boolean',
        ]);

        $rating->update($validated);

        return $this->redirectWithMessage(RedirectType::UPDATE->value, 'admin.rating.index');
    }

    /**
     * Remove the specified rating.
     */
    public function destroy($id): RedirectResponse {
        checkAdminHasPermissionAndThrowException('rating.delete');

        $rating = Rating::findOrFail($id);
        $rating->delete();

        return $this->redirectWithMessage(RedirectType::DELETE->value, 'admin.rating.index');
    }

    /**
     * Change rating status.
     */
    public function changeStatus($id): RedirectResponse {
        checkAdminHasPermissionAndThrowException('rating.update');

        $rating = Rating::findOrFail($id);
        $rating->status = !$rating->status;
        $rating->save();

        $message = $rating->status ? __('Rating Activated Successfully') : __('Rating Deactivated Successfully');
        $notification = ['message' => $message, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }
}

