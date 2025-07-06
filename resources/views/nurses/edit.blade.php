@extends('layouts.nurse')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow mt-10">
    <h2 class="text-2xl font-bold text-yellow-900 mb-4">Edit Nurse Info</h2>

    <form method="POST" action="{{ route('nurses.update', $nurse->id) }}">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $nurse->name) }}"
                       class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <!-- Age -->
            <div>
                <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                <input type="number" id="age" name="age" value="{{ old('age', $nurse->age) }}"
                       class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>

            <!-- Position -->
            <div>
                <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                <select name="position" id="position" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="">Select Position</option>
                    <option value="Head Nurse" {{ $nurse->position == 'Head Nurse' ? 'selected' : '' }}>Head Nurse</option>
                    <option value="Staff Nurse" {{ $nurse->position == 'Staff Nurse' ? 'selected' : '' }}>Staff Nurse</option>
                    <option value="Nurse Assistant" {{ $nurse->position == 'Nurse Assistant' ? 'selected' : '' }}>Nurse Assistant</option>
                    <option value="Triage Nurse" {{ $nurse->position == 'Triage Nurse' ? 'selected' : '' }}>Triage Nurse</option>
                    <option value="ICU Nurse" {{ $nurse->position == 'ICU Nurse' ? 'selected' : '' }}>ICU Nurse</option>
                </select>
            </div>

            <!-- Gender -->
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" id="gender" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="">Select Gender</option>
                    <option value="male" {{ $nurse->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $nurse->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end mt-6 gap-4">
            <a href="{{ route('nurses.index') }}" class="text-gray-600 hover:underline">Cancel</a>
            <button type="submit" class="bg-yellow-900 text-white px-6 py-2 rounded hover:bg-yellow-700">Update</button>
        </div>
    </form>
</div>
@endsection
