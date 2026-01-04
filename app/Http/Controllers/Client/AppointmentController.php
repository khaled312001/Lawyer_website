<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Modules\Day\app\Models\Day;
use Modules\Leave\app\Models\Leave;
use App\Http\Controllers\Controller;
use Modules\Lawyer\app\Models\Lawyer;
use Gloudemans\Shoppingcart\Facades\Cart;
use Modules\Lawyer\app\Models\Department;
use Modules\Schedule\app\Models\Schedule;

class AppointmentController extends Controller {
    public function getAppointment(Request $request) {
        $leave = Leave::where(['lawyer_id' => $request?->lawyer_id, 'date' => $request?->date])->count();
        $html = "";
        if ($leave == 0) {
            $lawyer_id = $request->lawyer_id;
            $day_name = date('l', strtotime($request->date));
            $day = Day::where('slug', strtolower($day_name))->active()->first();
            
            if (!$day) {
                $html = "<h4 class='text-danger'>" . __('Day not found or inactive') . "</h4>";
                return response()->json(['error' => $html]);
            }
            
            $schedules = Schedule::where(['lawyer_id' => $lawyer_id, 'day_id' => $day->id])
                ->active()
                ->get();
            
            // If no schedule exists, create default schedules for this day (fallback)
            if ($schedules->count() == 0) {
                // Create default schedules for all times of the day
                $defaultSchedules = [
                    ['start_time' => '9:00 AM', 'end_time' => '10:00 AM'],
                    ['start_time' => '10:00 AM', 'end_time' => '11:00 AM'],
                    ['start_time' => '11:00 AM', 'end_time' => '12:00 PM'],
                    ['start_time' => '12:00 PM', 'end_time' => '1:00 PM'],
                    ['start_time' => '1:00 PM', 'end_time' => '2:00 PM'],
                    ['start_time' => '2:00 PM', 'end_time' => '3:00 PM'],
                    ['start_time' => '3:00 PM', 'end_time' => '4:00 PM'],
                    ['start_time' => '4:00 PM', 'end_time' => '5:00 PM'],
                ];
                
                $scheduleDataArray = [];
                foreach ($defaultSchedules as $scheduleData) {
                    $scheduleDataArray[] = [
                        'lawyer_id' => $lawyer_id,
                        'day_id' => $day->id,
                        'start_time' => $scheduleData['start_time'],
                        'end_time' => $scheduleData['end_time'],
                        'quantity' => 10,
                        'status' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                
                Schedule::insert($scheduleDataArray);
                
                // Get the newly created schedules
                $schedules = Schedule::where(['lawyer_id' => $lawyer_id, 'day_id' => $day->id])
                    ->active()
                    ->get();
            }
                
            if ($schedules->count() != 0) {
                foreach ($schedules as $index => $schedule) {
                    $html .= '<option value="' . $schedule->id . '">' . strtoupper($schedule->start_time) . '-' . strtoupper($schedule->end_time) . '</option>';
                }
                return response()->json(['success' => $html]);
            } else {
                $html = "<h4 class='text-danger'>" . __('Schedule Not Found') . "</h4>";
                return response()->json(['error' => $html]);
            }
        } else {
            $html = "<h4 class='text-danger'>" . __('Lawyer is unavailable on the selected date') . "</h4>";
            return response()->json(['error' => $html]);
        }
    }

    public function getDepartmentLawyer($id) {
        $lawyers = Lawyer::where(['department_id' => $id])->active()->verify()->paid()->get();
        $html = '<option value="">' . __('Lawyer') . '</option>';
        if ($lawyers) {
            foreach ($lawyers as $lawyer) {
                $html .= '<option value="' . $lawyer?->id . '">' . ucfirst($lawyer?->name) . '</option>';
            }
        }
        return response()->json($html);
    }

    public function createAppointment(Request $request) {
        $lawyer_id = $request->lawyer_id;
        $department_id = $request->department_id;
        $date = $request->date;
        $schedule_id = $request->schedule_id;

        $schedule = Schedule::find($schedule_id);
        $lawyer = Lawyer::find($lawyer_id);
        $department = Department::find($department_id);

        $options['lawyer_id'] = $lawyer_id;
        $options['department_id'] = $department?->id;
        $options['location_id'] = $lawyer?->location?->id;
        $options['date'] = $date;
        $options['time'] = $schedule?->start_time . '-' . $schedule?->end_time;
        $options['schedule_id'] = $schedule?->id;
        $options['day_id'] = $schedule?->day_id;
        
        Cart::add(date('ymdis'), $lawyer?->name, 1, $lawyer?->fee, 0, $options);

        $notification = ['message' => __('Appointment Created Successfully'), 'alert-type' => 'success'];
        return to_route('client.payment')->with($notification);
    }

    public function removeAppointment($id) {
        Cart::remove($id);
        $notification = ['message' => __('Deleted Successfully'), 'alert-type' => 'success'];
        return back()->with($notification);
    }

    public function getLawyerDepartment($id) {
        $lawyer = Lawyer::find($id);
        if ($lawyer) {
            return response()->json(['department_id' => $lawyer->department_id]);
        }
        return response()->json(['department_id' => null], 404);
    }
}
