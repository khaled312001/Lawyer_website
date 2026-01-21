<?php

namespace Modules\Lawyer\app\Http\Controllers;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Traits\RedirectHelperTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Modules\Lawyer\app\Http\Requests\DepartmentRequest;
use Modules\Lawyer\app\Models\Department;
use Modules\Language\app\Enums\TranslationModels;
use Modules\Language\app\Models\Language;
use Modules\Language\app\Traits\GenerateTranslationTrait;

class DepartmentController extends Controller {
    use GenerateTranslationTrait, RedirectHelperTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        checkAdminHasPermissionAndThrowException('department.view');
        $query = Department::query();

        $query->when($request->filled('keyword'), function ($qa) use ($request) {
            $qa->whereHas('translations', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
                $q->orWhere('description', 'like', '%' . $request->keyword . '%');
            });
        });

        $query->when($request->filled('show_homepage'), function ($q) use ($request) {
            $q->where('show_homepage', $request->show_homepage);
        });

        $query->when($request->filled('status'), function ($q) use ($request) {
            $q->where('status', $request->status);
        });

        $orderBy = $request->filled('order_by') && $request->order_by == 1 ? 'asc' : 'desc';

        if ($request->filled('par-page')) {
            $departments = $request->get('par-page') == 'all' ? $query->with('translation')->orderBy('id', $orderBy)->get() : $query->with('translation')->orderBy('id', $orderBy)->paginate($request->get('par-page'))->withQueryString();
        } else {
            $departments = $query->with('translation')->orderBy('id', $orderBy)->paginate(10)->withQueryString();
        }

        return view('lawyer::department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        checkAdminHasPermissionAndThrowException('department.create');
        return view('lawyer::department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request) {
        checkAdminHasPermissionAndThrowException('department.store');
        $department = Department::create(array_merge($request->validated()));

        if ($department && $request->hasFile('image')) {
            $file_name = uploadAndOptimizeImage(
                file: $request->image,
                resize: [350, 240]
            );
            $department->thumbnail_image = $file_name;
            $department->save();
        }

        $this->generateTranslations(
            TranslationModels::Department,
            $department,
            'department_id',
            $request,
        );

        return $this->redirectWithMessage(
            RedirectType::CREATE->value,
            'admin.department.edit',
            [
                'department' => $department->id,
                'code'       => allLanguages()->first()->code,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department) {
        checkAdminHasPermissionAndThrowException('department.edit');
        $code = request('code') ?? getSessionLanguage();
        if (!Language::where('code', $code)->exists()) {
            abort(404);
        }
        $languages = allLanguages();

        return view('lawyer::department.edit', compact('department', 'code', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, $id): RedirectResponse {
        checkAdminHasPermissionAndThrowException('department.update');
        $validatedData = $request->validated();

        $department = Department::findOrFail($id);
        $department->update($request->except('image', 'icon'));

        if ($department && !empty($request->image)) {
            $file_name = file_upload($request->image, 'uploads/custom-images/', $department->thumbnail_image);
            $department->thumbnail_image = $file_name;
            $department->save();
        }

        $this->updateTranslations(
            $department,
            $request,
            $validatedData,
        );

        return $this->redirectWithMessage(
            RedirectType::UPDATE->value,
            'admin.department.edit',
            ['department' => $department->id, 'code' => $request->code]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        checkAdminHasPermissionAndThrowException('department.delete');

        $department = Department::findOrFail($id);
        if ($department->lawyers()->count() > 0) {
            return redirect()->back()->with(['alert-type' => 'error','message' => __('Cannot delete, department has lawyers.')]);
        }

        if ($department->thumbnail_image) {
            if (File::exists(public_path($department->thumbnail_image))) {
                unlink(public_path($department->thumbnail_image));
            }
        }

        $department->delete();

        return $this->redirectWithMessage(RedirectType::DELETE->value, 'admin.department.index');
    }

    public function statusUpdate($id) {
        checkAdminHasPermissionAndThrowException('department.update');

        $department = Department::find($id);
        $status = $department->status == 1 ? 0 : 1;
        $department->update(['status' => $status]);

        $notification = __('Updated successfully');

        return response()->json([
            'success' => true,
            'message' => $notification,
        ]);
    }

    /**
     * Manage departments for homepage
     */
    public function homepageManagement() {
        checkAdminHasPermissionAndThrowException('department.view');
        
        // Get cached order if exists
        $cachedOrder = cache()->get('departments_homepage_order', []);
        
        $departments = Department::with('translation')->get();
        
        // Sort by cached order if exists
        if (!empty($cachedOrder)) {
            $departments = $departments->sortBy(function($department) use ($cachedOrder) {
                $index = array_search($department->id, $cachedOrder);
                return $index !== false ? $index : 999;
            })->values();
        } else {
            // Default sort: homepage first, then by id
            $departments = $departments->sortBy([
                ['show_homepage', 'desc'],
                ['id', 'asc']
            ])->values();
        }
        
        $sectionControl = \Modules\HomeSection\app\Models\SectionControl::first();
        
        return view('lawyer::department.homepage-management', compact('departments', 'sectionControl'));
    }

    /**
     * Update homepage status for department
     */
    public function updateHomepageStatus(Request $request, $id) {
        checkAdminHasPermissionAndThrowException('department.update');
        
        $department = Department::findOrFail($id);
        $department->show_homepage = $request->show_homepage ? 1 : 0;
        $department->save();
        
        return response()->json([
            'success' => true,
            'message' => __('Updated successfully'),
        ]);
    }

    /**
     * Update department order for homepage
     */
    public function updateHomepageOrder(Request $request) {
        checkAdminHasPermissionAndThrowException('department.update');
        
        $order = $request->input('order', []);
        
        // Store order in cache or session for now
        // You can add homepage_order column to departments table later if needed
        cache()->put('departments_homepage_order', $order, now()->addYears(1));
        
        return response()->json([
            'success' => true,
            'message' => __('Order updated successfully'),
        ]);
    }

    /**
     * Update number of departments to show on homepage
     */
    public function updateHomepageCount(Request $request) {
        checkAdminHasPermissionAndThrowException('department.update');
        
        $sectionControl = \Modules\HomeSection\app\Models\SectionControl::first();
        
        if (!$sectionControl) {
            $sectionControl = \Modules\HomeSection\app\Models\SectionControl::create([
                'department_how_many' => $request->count ?? 6,
            ]);
        } else {
            $sectionControl->department_how_many = $request->count ?? 6;
            $sectionControl->save();
        }
        
        return response()->json([
            'success' => true,
            'message' => __('Updated successfully'),
        ]);
    }
}
