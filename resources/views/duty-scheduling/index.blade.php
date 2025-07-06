@extends('layouts.nurse')

@section('content')
<div class="container mx-auto px-4">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-3">
        <h2 class="text-2xl font-semibold text-yellow-900">Duty Scheduling</h2>

        <!-- Button to trigger modal -->
        <button onclick="openModal()"
            class="bg-yellow-900 hover:bg-yellow-700 text-white px-6 py-2 rounded-2xl shadow transition self-start sm:self-auto">
            + Add Duty
        </button>
    </div>

    <!-- Duty Schedule List -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse ($duties as $duty)
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ $duty->nurse->name ?? 'Unknown' }}</h3>
                <p class="text-sm text-gray-600">Date: {{ \Carbon\Carbon::parse($duty->duty_date)->format('F j, Y') }}</p>
                <p class="text-sm text-gray-600">Shift: {{ $duty->shift }}</p>

                <form action="{{ route('duty.destroy', $duty->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="text-red-500 hover:text-red-700 text-sm underline">
                        Delete
                    </button>
                </form>
            </div>
        @empty
            <p class="text-gray-500">No duty schedules found.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $duties->links() }}
    </div>
</div>

<!-- Modal -->
<div id="addDutyModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg w-full max-w-md space-y-4 shadow-lg">
        <h2 class="text-xl font-bold text-yellow-900">Add Duty Schedule</h2>
        <form method="POST" action="{{ route('duty.store') }}">
            @csrf
            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nurse</label>
                    <select name="nurse_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        <option value="">Select Nurse</option>
                        @foreach ($nurses as $nurse)
                            <option value="{{ $nurse->id }}">{{ $nurse->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="duty_date" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Shift</label>
                    <select name="shift" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        <option value="">Select Shift</option>
                        <option value="Morning">Morning (6 AM - 2 PM)</option>
                        <option value="Afternoon">Afternoon (2 PM - 10 PM)</option>
                        <option value="Night">Night (10 PM - 6 AM)</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end gap-4 mt-4">
                <button type="button" onclick="closeModal()" class="text-gray-600 hover:text-gray-800">Cancel</button>
                <button type="submit" class="bg-yellow-900 text-white px-4 py-2 rounded hover:bg-yellow-700">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('addDutyModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('addDutyModal').classList.add('hidden');
    }
</script>
@endsection
