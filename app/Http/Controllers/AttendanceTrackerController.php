<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nurse;
use App\Models\DutySchedule;
use App\Models\LeaveRequest;
use Carbon\Carbon;

class AttendanceTrackerController extends Controller
{
    
public function index()
{
    $nurses = Nurse::all();
    $startOfWeek = Carbon::now()->startOfWeek();
    $weekDates = collect(range(0, 6))->map(fn($i) => $startOfWeek->copy()->addDays($i)->toDateString());

    $attendance = [];

    foreach ($nurses as $nurse) {
        foreach ($weekDates as $date) {
            $isOnDuty = DutySchedule::where('nurse_id', $nurse->id)->whereDate('duty_date', $date)->exists();
            $isOnLeave = LeaveRequest::where('nurse_id', $nurse->id)->whereDate('leave_date', $date)->exists();

            $attendance[$nurse->id][$date] = $isOnLeave ? 'On Leave' : ($isOnDuty ? 'On Duty' : 'Absent');
        }
    }

    return view('attendance-tracker.index', compact('nurses', 'weekDates', 'attendance'));
}

}
