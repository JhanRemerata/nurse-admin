<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use App\Models\DutySchedule;
use App\Models\Note;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $nurseCount = Nurse::count();

        $today = Carbon::today()->toDateString();
        $onDutyCount = DutySchedule::where('duty_date', $today)->count();

        $notes = Note::latest()->take(10)->get();

        return view('dashboard', compact('nurseCount', 'onDutyCount', 'notes'));
    }

    public function storeNote(Request $request)
    {
        $request->validate(['note' => 'required|string|max:255']);
        Note::create(['note' => $request->note]);

        return back()->with('success', 'Note added!');
    }
}
