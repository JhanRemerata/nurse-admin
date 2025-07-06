<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use Illuminate\Http\Request;

class NurseController extends Controller
{
    public function index()
    {
        $nurses = Nurse::latest()->paginate(12); // or ->get() if you don’t want pagination
        return view('nurses.index', compact('nurses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
            'position' => 'required|string',
            'gender' => 'required|in:male,female',
        ]);

        $nurse = Nurse::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'nurse' => $nurse
            ]);
        }

        return redirect()->route('nurses.index')->with('success', 'Nurse added successfully.');
    }

    public function destroy(Nurse $nurse)
    {
        $nurse->delete();
        return redirect()->route('nurses.index')->with('success', 'Nurse deleted.');
    }

    public function edit(Nurse $nurse)
    {
        return view('nurses.edit', compact('nurse'));
    }

    public function update(Request $request, Nurse $nurse)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
            'position' => 'required|string',
            'gender' => 'required|in:male,female',
        ]);

        $nurse->update($validated);

        return redirect()->route('nurses.index')->with('success', 'Nurse updated successfully.');
    }
}
