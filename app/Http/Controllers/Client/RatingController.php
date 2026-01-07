<?php

namespace App\Http\Controllers\Client;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Traits\RedirectHelperTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Lawyer\app\Models\Lawyer;
use Modules\Appointment\app\Models\Appointment;

class RatingController extends Controller {
    use RedirectHelperTrait;

    /**
     * Store a newly created rating.
     */
    public function store(Request $request): RedirectResponse {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            $notification = ['message' => __('Please login to rate'), 'alert-type' => 'error'];
            return redirect()->route('login')->with($notification);
        }

        $validated = $request->validate([
            'lawyer_id' => 'required|exists:lawyers,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Check if user has completed at least one appointment with this lawyer
        $hasCompletedAppointment = Appointment::where('lawyer_id', $validated['lawyer_id'])
            ->where('user_id', $user->id)
            ->where('payment_status', 1)
            ->where('already_treated', 1)
            ->exists();

        if (!$hasCompletedAppointment) {
            $notification = ['message' => __('You can only rate a lawyer after completing a service'), 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        // Check if user already rated this lawyer
        $existingRating = Rating::where('lawyer_id', $validated['lawyer_id'])
            ->where('user_id', $user->id)
            ->where('is_admin_created', false)
            ->first();

        if ($existingRating) {
            $notification = ['message' => __('You have already rated this lawyer'), 'alert-type' => 'warning'];
            return redirect()->back()->with($notification);
        }

        $validated['user_id'] = $user->id;
        $validated['is_admin_created'] = false;
        $validated['status'] = true;

        Rating::create($validated);

        $notification = ['message' => __('Rating Added Successfully'), 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * Update the specified rating.
     */
    public function update(Request $request, $id): RedirectResponse {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            $notification = ['message' => __('Please login'), 'alert-type' => 'error'];
            return redirect()->route('login')->with($notification);
        }

        $rating = Rating::where('id', $id)
            ->where('user_id', $user->id)
            ->where('is_admin_created', false)
            ->firstOrFail();

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $rating->update($validated);

        $notification = ['message' => __('Rating Updated Successfully'), 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified rating.
     */
    public function destroy($id): RedirectResponse {
        $user = Auth::guard('web')->user();
        
        if (!$user) {
            $notification = ['message' => __('Please login'), 'alert-type' => 'error'];
            return redirect()->route('login')->with($notification);
        }

        $rating = Rating::where('id', $id)
            ->where('user_id', $user->id)
            ->where('is_admin_created', false)
            ->firstOrFail();

        $rating->delete();

        $notification = ['message' => __('Rating Deleted Successfully'), 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }
}

