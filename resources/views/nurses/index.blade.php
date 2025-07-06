@extends('layouts.nurse')

@section('content')
<div class="container mx-auto px-4">
    <!-- Header with Title and Add Button -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-3">
        <h2 class="text-2xl font-semibold text-yellow-900">Nurse Staff</h2>
        <button onclick="openModal()"
            class="bg-yellow-900 hover:bg-yellow-700 text-white px-6 py-2 rounded-2xl shadow transition self-start sm:self-auto">
            + Add Nurse
        </button>
    </div>

    <!-- Grid -->
    <div id="nurseGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
        @foreach ($nurses as $nurse)
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition cursor-pointer group relative">
                <!-- Profile image -->
                <img src="{{ asset('images/' . ($nurse->gender === 'male' ? 'nurse-male.png' : 'nurse-icon.png')) }}"
                     alt="Nurse Icon"
                     class="w-24 h-24 mx-auto rounded-full object-cover border border-gray-300 mb-3">

                <!-- Info -->
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $nurse->name }}</h3>
                    <p class="text-sm text-gray-600">Age: {{ $nurse->age }}</p>
                    <p class="text-sm text-gray-600">Position: {{ $nurse->position }}</p>
                </div>

                <!-- Edit/Delete Overlay -->
                <div class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center space-x-4 opacity-0 group-hover:opacity-100 transition">
                    <a href="{{ route('nurses.edit', $nurse->id) }}" class="text-white font-semibold hover:underline">Edit</a>
                    <form method="POST" action="{{ route('nurses.destroy', $nurse->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-300 hover:text-red-500 font-semibold">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-6">
        {{ $nurses->links() }}
    </div>
</div>
@endsection

<!-- Add Nurse Modal -->
<div id="addNurseModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg w-full max-w-md space-y-4 shadow-lg">
        <h2 class="text-xl font-bold text-yellow-900">Add New Nurse</h2>
        <form id="addNurseForm">
            @csrf
            <div class="space-y-3">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div>
                    <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                    <input type="number" name="age" id="age" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                    <select name="position" id="position" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        <option value="">Select Position...</option>
                        <option value="Head Nurse">Head Nurse</option>
                        <option value="Staff Nurse">Staff Nurse</option>
                        <option value="Nursing Assistant">Nursing Assistant</option>
                        <option value="Charge Nurse">Charge Nurse</option>
                        <option value="Clinical Nurse">Clinical Nurse</option>
                        <option value="ICU Nurse">ICU Nurse</option>
                        <option value="ER Nurse">ER Nurse</option>
                        <option value="Pediatric Nurse">Pediatric Nurse</option>
                    </select>

                </div>
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" id="gender" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        <option value="">Select...</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
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
        document.getElementById('addNurseModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('addNurseModal').classList.add('hidden');
        document.getElementById('addNurseForm').reset(); // clear form
    }

    document.getElementById('addNurseForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        try {
            const response = await fetch("{{ route('nurses.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok || !data.success) {
                alert('Error: ' + (data.message || 'Failed to add nurse.'));
                return;
            }

            const n = data.nurse;

            const card = document.createElement('div');
            card.className = "bg-white p-4 rounded-lg shadow hover:shadow-lg transition cursor-pointer group relative";
            card.innerHTML = `
                <img src="/images/${n.gender === 'male' ? 'nurse-male.png' : 'nurse-icon.png'}"
                     alt="Nurse Icon"
                     class="w-24 h-24 mx-auto rounded-full object-cover border border-gray-300 mb-3">

                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-800">${n.name}</h3>
                    <p class="text-sm text-gray-600">Age: ${n.age}</p>
                    <p class="text-sm text-gray-600">Position: ${n.position}</p>
                </div>

                <div class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center space-x-4 opacity-0 group-hover:opacity-100 transition">
                    <a href="/nurses/${n.id}/edit" class="text-white font-semibold hover:underline">Edit</a>
                    <form method="POST" action="/nurses/${n.id}" onsubmit="return confirm('Are you sure?')">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="text-red-300 hover:text-red-500 font-semibold">Delete</button>
                    </form>
                </div>
            `;

            document.getElementById('nurseGrid').appendChild(card);

            card.style.opacity = 0;
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease-in-out';
                card.style.opacity = 1;
            }, 10);

            closeModal();
        } catch (err) {
            alert('Something went wrong. Please try again.');
            console.error(err);
        }
    });
</script>
