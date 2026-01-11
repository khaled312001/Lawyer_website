<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminAppointment;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Lawyer\app\Models\Department;

class ConsultationAppointmentController extends Controller
{
    /**
     * Display a listing of consultation appointments
     */
    public function index(Request $request)
    {
        checkAdminHasPermissionAndThrowException('admin.view');
        
        $query = AdminAppointment::with(['user', 'admin', 'lawyer.translation', 'department.translation']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $from_date = date('Y-m-d', strtotime($request->from_date));
            $to_date = date('Y-m-d', strtotime($request->to_date));
            $query->whereBetween('appointment_date', [$from_date, $to_date]);
        }

        // Filter by department
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        // Filter by client
        if ($request->filled('client')) {
            $query->where('user_id', $request->client);
        }

        $orderBy = $request->filled('order_by') && $request->order_by == 1 ? 'asc' : 'desc';

        if ($request->filled('par-page')) {
            $appointments = $request->get('par-page') == 'all' 
                ? $query->orderBy('appointment_date', $orderBy)->orderBy('appointment_time', $orderBy)->get() 
                : $query->orderBy('appointment_date', $orderBy)->orderBy('appointment_time', $orderBy)->paginate($request->get('par-page'))->withQueryString();
        } else {
            $appointments = $query->orderBy('appointment_date', $orderBy)->orderBy('appointment_time', $orderBy)->paginate(10)->withQueryString();
        }

        $clients = User::select('name', 'email', 'id')->active()->get();
        $departments = Department::select('id')->with(['translation' => function($q) {
            $q->select('department_id', 'name');
        }])->active()->get();
        
        $title = __('Consultation Appointments');
        
        return view('admin.consultation-appointments.index', compact('appointments', 'clients', 'departments', 'title'));
    }

    /**
     * Show specific consultation appointment
     */
    public function show($id)
    {
        checkAdminHasPermissionAndThrowException('admin.view');
        
        $appointment = AdminAppointment::with(['user', 'admin', 'department.translation'])
            ->findOrFail($id);
        
        return view('admin.consultation-appointments.show', compact('appointment'));
    }

    /**
     * Update consultation appointment status
     */
    public function updateStatus(Request $request, $id)
    {
        checkAdminHasPermissionAndThrowException('admin.view');
        
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'admin_notes' => 'nullable|string',
        ]);

        $appointment = AdminAppointment::findOrFail($id);
        
        $appointment->update([
            'status' => $request->status,
            'admin_id' => $request->filled('admin_id') ? $request->admin_id : auth('admin')->id(),
            'admin_notes' => $request->admin_notes,
        ]);

        $notification = __('Appointment updated successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->route('admin.consultation-appointments.show', $id)->with($notification);
    }

    /**
     * Delete consultation appointment
     */
    public function destroy($id)
    {
        checkAdminHasPermissionAndThrowException('admin.view');
        
        $appointment = AdminAppointment::findOrFail($id);
        $appointment->delete();

        $notification = __('Appointment deleted successfully');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->route('admin.consultation-appointments.index')->with($notification);
    }
}

