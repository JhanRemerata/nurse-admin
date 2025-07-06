<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use App\Models\DutySchedule;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $nurses = Nurse::all();

        $duties = DutySchedule::with('nurse')
                    ->whereBetween('duty_date', [$startOfWeek, $endOfWeek])
                    ->get();

        $leaves = LeaveRequest::with('nurse')
                    ->whereBetween('leave_date', [$startOfWeek, $endOfWeek])
                    ->get();

        return view('reports.index', compact('nurses', 'duties', 'leaves', 'startOfWeek', 'endOfWeek'));
    }
}

