<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Nurse;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::with('nurse')->latest()->paginate(10);
        $nurses = Nurse::paginate(12); // ✅ returns LengthAwarePaginator
        return view('leave-request.index', compact('leaveRequests', 'nurses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nurse_id' => 'required|exists:nurses,id',
            'leave_date' => 'required|date',
            'reason' => 'required|string|max:255',
        ]);

        LeaveRequest::create($request->all());

        return redirect()->back()->with('success', 'Leave request submitted.');
    }
}

