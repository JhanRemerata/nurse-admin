@extends('layouts.nurse')

@section('content')
<main class="flex-1 p-6 bg-gray-100 flex flex-col md:flex-row gap-6">
    <!-- Left Section -->
    <section class="w-full md:w-1/3 space-y-6">
        <!-- Nurse Count -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-yellow-900">👩‍⚕️ Nurse Staff</h3>
            <p class="text-3xl mt-2 font-bold text-gray-800">{{ $nurseCount }}</p>
        </div>

        <!-- On Duty Count -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-yellow-900">🟢 On Duty Today</h3>
            <p class="text-3xl mt-2 font-bold text-gray-800">{{ $onDutyCount }}</p>
        </div>
    </section>

    <!-- Right Section -->
    <section class="w-full md:w-2/3 space-y-6">
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-yellow-900">📝 Notes</h3>
            <ul class="mt-2 text-gray-700 list-disc list-inside space-y-1">
                @forelse ($notes as $note)
                    <li>{{ $note->note }}</li>
                @empty
                    <li>No notes added yet.</li>
                @endforelse
            </ul>

            <form action="{{ route('notes.store') }}" method="POST" class="mt-4 space-y-2">
                @csrf
                <textarea name="note" rows="3" class="w-full p-3 border rounded resize-none" placeholder="Add a note..."></textarea>
                <button type="submit" class="bg-yellow-900 text-white px-4 py-2 rounded hover:bg-yellow-700">Save</button>
            </form>
        </div>
    </section>
</main>
@endsection
