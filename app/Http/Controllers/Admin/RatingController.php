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

    /**
     * Create a fake review for a lawyer.
     */
    public function createFakeReview(Request $request, $lawyerId): RedirectResponse {
        checkAdminHasPermissionAndThrowException('rating.create');

        // If lawyerId is 0, get it from request
        if ($lawyerId == 0 && $request->filled('lawyer_id')) {
            $lawyerId = $request->lawyer_id;
        }

        $lawyer = Lawyer::findOrFail($lawyerId);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Fake review data
        $fakeNames = [
            'أحمد محمد', 'فاطمة علي', 'محمد حسن', 'سارة أحمد', 'خالد إبراهيم',
            'نورا محمود', 'عمر يوسف', 'ليلى عبدالله', 'يوسف كمال', 'مريم سالم'
        ];
        $fakeComments = [
            'محامي ممتاز ومحترف جداً. ساعدني في حل قضيتي بسرعة وفعالية.',
            'خدمة رائعة ومهنية عالية. أنصح الجميع بالتعامل معه.',
            'خبرة واسعة ومعرفة عميقة بالقانون. استشارة قيمة جداً.',
            'محامي محترف ومتفهم. شرح لي كل شيء بوضوح.',
            'خدمة ممتازة وتواصل سريع. راضٍ جداً عن الخدمة.',
            'محامي خبير ومتمكن. ساعدني في الحصول على حقوقي.',
            'خدمة احترافية ومتابعة دقيقة. أنصح به بشدة.',
            'محامي متميز وذو خبرة عالية. استشارة مفيدة جداً.',
            'خدمة رائعة وسريعة. محامي محترف ومتفهم.',
            'محامي ممتاز ومحترف. ساعدني في حل مشكلتي القانونية.'
        ];

        // Get random fake name and comment
        $fakeName = $fakeNames[array_rand($fakeNames)];
        $fakeComment = $validated['comment'] ?? $fakeComments[array_rand($fakeComments)];

        // Create a fake user or use null
        $fakeUser = User::where('name', 'like', '%' . $fakeName . '%')->first();
        
        // Create rating
        Rating::create([
            'lawyer_id' => $lawyer->id,
            'user_id' => $fakeUser?->id ?? null,
            'rating' => $validated['rating'],
            'comment' => $fakeComment,
            'is_admin_created' => true,
            'created_by_admin_id' => Auth::guard('admin')->user()->id,
            'status' => true,
        ]);

        $notification = ['message' => __('Fake Review Added Successfully'), 'alert-type' => 'success'];
        return redirect()->back()->with($notification);
    }

    /**
     * Add high ratings (5-10 reviews per lawyer with 4-5 stars) to all lawyers.
     */
    public function addHighRatingsToAllLawyers(): RedirectResponse {
        // Check if admin is authenticated
        $admin = Auth::guard('admin')->user();
        if (!$admin) {
            $notification = ['message' => __('Please login first'), 'alert-type' => 'error'];
            return redirect()->route('admin.login')->with($notification);
        }

        // Allow if has rating.create, rating.store, or is super admin
        $hasPermission = checkAdminHasPermission('rating.create') || 
                        checkAdminHasPermission('rating.store') || 
                        ($admin->is_super_admin ?? false);
        
        if (!$hasPermission) {
            $notification = ['message' => __('Permission denied, you cannot perform this action!'), 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        $lawyers = Lawyer::active()->get();

        if ($lawyers->isEmpty()) {
            $notification = ['message' => __('No active lawyers found'), 'alert-type' => 'warning'];
            return redirect()->back()->with($notification);
        }

        // Fake comments in Arabic
        $fakeComments = [
            'محامي ممتاز ومحترف جداً. ساعدني في حل قضيتي بسرعة وفعالية.',
            'خدمة رائعة ومهنية عالية. أنصح الجميع بالتعامل معه.',
            'خبرة واسعة ومعرفة عميقة بالقانون. استشارة قيمة جداً.',
            'محامي محترف ومتفهم. شرح لي كل شيء بوضوح.',
            'خدمة ممتازة وتواصل سريع. راضٍ جداً عن الخدمة.',
            'محامي خبير ومتمكن. ساعدني في الحصول على حقوقي.',
            'خدمة احترافية ومتابعة دقيقة. أنصح به بشدة.',
            'محامي متميز وذو خبرة عالية. استشارة مفيدة جداً.',
            'خدمة رائعة وسريعة. محامي محترف ومتفهم.',
            'محامي ممتاز ومحترف. ساعدني في حل مشكلتي القانونية.',
            'تجربة ممتازة مع هذا المحامي. أوصي به بشدة.',
            'محامي ذو خبرة عالية ومتعاون. حل مشكلتي بكفاءة.',
            'خدمة قانونية سريعة وفعالة. محامي محترف.',
            'أفضل محامي تعاملت معه على الإطلاق.',
            'دقيق في عمله ويقدم نصائح قيمة.',
            'استشارة مفيدة جداً، شكراً جزيلاً.',
            'فهم عميق للقانون وقدرة على التوجيه الصحيح.',
            'تجاوز توقعاتي، خدمة 5 نجوم.',
            'محامي محترف ومتفاني في عمله.',
            'خدمة ممتازة، أنصح به بشدة.'
        ];

        $totalRatingsAdded = 0;

        foreach ($lawyers as $lawyer) {
            // Random number of reviews between 5 and 10
            $numberOfReviews = rand(5, 10);

            for ($i = 0; $i < $numberOfReviews; $i++) {
                // Random rating between 4 and 5 stars
                $rating = rand(4, 5);
                
                // Random comment
                $comment = $fakeComments[array_rand($fakeComments)];

                Rating::create([
                    'lawyer_id' => $lawyer->id,
                    'user_id' => null, // Fake reviews are not tied to a specific client user
                    'rating' => $rating,
                    'comment' => $comment,
                    'is_admin_created' => true,
                    'created_by_admin_id' => Auth::guard('admin')->user()->id,
                    'status' => true,
                ]);

                $totalRatingsAdded++;
            }
        }

        $notification = [
            'message' => __('High ratings added successfully! Total :count ratings added to :lawyers lawyers.', [
                'count' => $totalRatingsAdded,
                'lawyers' => $lawyers->count()
            ]),
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}

