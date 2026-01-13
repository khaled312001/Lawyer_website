<?php

namespace Modules\RealEstate\app\Http\Controllers;

use App\Enums\RedirectType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\RedirectHelperTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Modules\RealEstate\app\Models\RealEstate;
use Modules\Language\app\Models\Language;
use Modules\RealEstate\app\Models\RealEstateTranslation;
use Modules\Language\app\Enums\TranslationModels;
use Modules\RealEstate\app\Http\Requests\RealEstateRequest;
use Modules\Language\app\Traits\GenerateTranslationTrait;

class RealEstateController extends Controller
{
    use GenerateTranslationTrait, RedirectHelperTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        checkAdminHasPermissionAndThrowException('real_estate.view');
        $query = RealEstate::query();

        $query->when($request->filled('keyword'), function ($qa) use ($request) {
            $qa->whereHas('translations', function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->keyword.'%');
                $q->orWhere('description', 'like', '%'.$request->keyword.'%');
            });
        });

        $query->when($request->filled('property_type'), function ($q) use ($request) {
            $q->where('property_type', $request->property_type);
        });

        $query->when($request->filled('listing_type'), function ($q) use ($request) {
            $q->where('listing_type', $request->listing_type);
        });

        $query->when($request->filled('status'), function ($q) use ($request) {
            $q->where('status', $request->status);
        });

        $query->when($request->filled('featured'), function ($q) use ($request) {
            $q->where('featured', $request->boolean('featured'));
        });

        $orderBy = $request->filled( 'order_by' ) && $request->order_by == 1 ? 'asc' : 'desc';

        if ($request->filled('par-page')) {
            $realEstates = $request->get('par-page') == 'all' ? $query->with('translation')->orderBy( 'created_at', $orderBy )->get() : $query->with('translation')->orderBy( 'created_at', $orderBy )->paginate($request->get('par-page'))->withQueryString();
        } else {
            $realEstates = $query->with('translation')->orderBy( 'created_at', $orderBy )->paginate(10)->withQueryString();
        }

        return view('realestate::index', compact('realEstates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        checkAdminHasPermissionAndThrowException('real_estate.create');
        return view('realestate::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RealEstateRequest $request)
    {
        checkAdminHasPermissionAndThrowException('real_estate.store');

        $validatedData = $request->validated();

        // Handle image uploads
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = uploadAndOptimizeImage(
                    file: $image,
                    resize: [800,600]
                );
            }
        }

        $featuredImage = null;
        if ($request->hasFile('featured_image')) {
            $featuredImage = uploadAndOptimizeImage(
                file: $request->featured_image,
                resize: [800,600]
            );
        }

        $realEstate = RealEstate::create(array_merge($validatedData, [
            'images' => $images,
            'featured_image' => $featuredImage,
        ]));

        // Generate translations
        $this->generateTranslations(
            TranslationModels::RealEstate,
            $realEstate,
            'real_estate_id',
            $request,
            ['title', 'description', 'seo_title', 'seo_description']
        );

        return $this->redirectWithMessage(
            RedirectType::CREATE->value,
            'admin.real-estate.edit',
            [
                'real_estate' => $realEstate->id,
                'code' => allLanguages()->first()->code,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RealEstate $realEstate)
    {
        checkAdminHasPermissionAndThrowException('real_estate.edit');
        $code = request('code') ?? getSessionLanguage();
        if (! Language::where('code', $code)->exists()) {
            abort(404);
        }
        $languages = allLanguages();

        return view('realestate::edit', compact('realEstate', 'code', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RealEstateRequest $request, RealEstate $realEstate)
    {
        checkAdminHasPermissionAndThrowException('real_estate.update');

        $validatedData = $request->validated();

        // Handle image uploads
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = uploadAndOptimizeImage(
                    file: $image,
                    resize: [800,600]
                );
            }
            $validatedData['images'] = $images;
        }

        if ($request->hasFile('featured_image')) {
            $featuredImage = uploadAndOptimizeImage(
                file: $request->featured_image,
                resize: [800,600]
            );
            $validatedData['featured_image'] = $featuredImage;
        }

        $realEstate->update($validatedData);

        // Update translations
        $this->updateTranslations(
            $realEstate,
            $request,
            $validatedData,
        );

        return $this->redirectWithMessage(
            RedirectType::UPDATE->value,
            'admin.real-estate.edit',
            ['real_estate' => $realEstate->id, 'code' => $request->code]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        checkAdminHasPermissionAndThrowException('real_estate.delete');

        RealEstate::findOrFail($id)->delete();

        return $this->redirectWithMessage(RedirectType::DELETE->value, 'admin.real-estate.index');
    }

    public function statusUpdate($id)
    {
        checkAdminHasPermissionAndThrowException('real_estate.update');

        $realEstate = RealEstate::find($id);
        $status = $realEstate->status == 'active' ? 'inactive' : 'active';
        $realEstate->update(['status' => $status]);

        $notification = __('Updated successfully');

        return response()->json([
            'success' => true,
            'message' => $notification,
        ]);
    }

    public function featuredUpdate($id)
    {
        checkAdminHasPermissionAndThrowException('real_estate.update');

        $realEstate = RealEstate::find($id);
        $featured = !$realEstate->featured;
        $realEstate->update(['featured' => $featured]);

        $notification = __('Updated successfully');

        return response()->json([
            'success' => true,
            'message' => $notification,
        ]);
    }
}