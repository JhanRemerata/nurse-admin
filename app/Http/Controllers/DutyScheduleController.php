<?php

namespace App\Http\Controllers;

use App\Models\DutySchedule;
use App\Models\Nurse;
use Illuminate\Http\Request;

class DutyScheduleController extends Controller
{
    public function index()
    {
        $duties = DutySchedule::with('nurse')->latest()->paginate(10);
        $nurses = Nurse::all();
        return view('duty-scheduling.index', compact('duties', 'nurses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nurse_id' => 'required|exists:nurses,id',
            'duty_date' => 'required|date',
            'shift' => 'required|in:Morning,Afternoon,Night',
        ]);

        DutySchedule::create($validated);
        return back()->with('success', 'Duty schedule added.');
    }

    public function destroy(DutySchedule $dutySchedule)
    {
        $dutySchedule->delete();
        return back()->with('success', 'Schedule deleted.');
    }
}
