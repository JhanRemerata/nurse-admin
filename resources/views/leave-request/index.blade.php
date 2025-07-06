@extends('layouts.nurse')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-semibold text-yellow-900 mb-6">Leave Requests</h2>

    <!-- Nurse Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-8">
        @foreach ($nurses as $nurse)
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
                <img src="{{ asset('images/' . ($nurse->gender === 'male' ? 'nurse-male.png' : 'nurse-icon.png')) }}"
                     alt="Nurse Icon"
                     class="w-24 h-24 mx-auto rounded-full object-cover border border-gray-300 mb-3">

                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $nurse->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $nurse->position }}</p>
                    <button onclick="openModal({{ $nurse->id }}, '{{ $nurse->name }}')"
                            class="mt-3 bg-yellow-900 text-white px-4 py-2 rounded hover:bg-yellow-700">
                        Request Leave
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mb-8">
        {{ $nurses->links() }}
    </div>
</div>

<!-- Leave Request Modal -->
<div id="leaveModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg space-y-4">
        <h2 class="text-xl font-bold text-yellow-900">Leave Request for <span id="modalNurseName"></span></h2>
        <form method="POST" action="{{ route('leave-request.store') }}">
            @csrf
            <input type="hidden" name="nurse_id" id="modalNurseId">

            <div>
                <label for="leave_date" class="block text-sm font-medium text-gray-700">Leave Date</label>
                <input type="date" name="leave_date" required
                       class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div>
                <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                <textarea name="reason" rows="3" required
                          class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
            </div>

            <div class="flex justify-end gap-4">
                <button type="button" onclick="closeModal()" class="text-gray-600 hover:text-gray-800">Cancel</button>
                <button type="submit" class="bg-yellow-900 text-white px-4 py-2 rounded hover:bg-yellow-700">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(nurseId, nurseName) {
        document.getElementById('modalNurseId').value = nurseId;
        document.getElementById('modalNurseName').textContent = nurseName;
        document.getElementById('leaveModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('leaveModal').classList.add('hidden');
    }
</script>
@endsection
