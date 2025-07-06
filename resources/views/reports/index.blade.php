@extends('layouts.nurse')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-semibold text-yellow-900 mb-6">Weekly Summary Report</h2>
    <p class="text-sm text-gray-500 mb-4">Week: {{ $startOfWeek->toFormattedDateString() }} - {{ $endOfWeek->toFormattedDateString() }}</p>

    <table class="min-w-full bg-white shadow rounded mb-6 text-sm">
        <thead class="bg-yellow-900 text-white">
            <tr>
                <th class="py-2 px-4 text-left">Nurse</th>
                <th class="py-2 px-4">Duty Dates</th>
                <th class="py-2 px-4">Leaves</th>
                <th class="py-2 px-4">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nurses as $nurse)
                @php
                    $nurseDuties = $duties->where('nurse_id', $nurse->id);
                    $nurseLeaves = $leaves->where('nurse_id', $nurse->id);
                    $status = count($nurseLeaves) > 0 ? 'On Leave' : (count($nurseDuties) > 0 ? 'On Duty' : 'Absent');
                @endphp
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $nurse->name }}</td>
                    <td class="py-2 px-4">
                        @foreach ($nurseDuties as $duty)
                            <div>{{ $duty->duty_date }} - {{ $duty->shift }}</div>
                        @endforeach
                    </td>
                    <td class="py-2 px-4">
                        @foreach ($nurseLeaves as $leave)
                            <div>{{ $leave->leave_date }} - {{ $leave->reason }}</div>
                        @endforeach
                    </td>
                    <td class="py-2 px-4 font-semibold {{ $status === 'Absent' ? 'text-red-500' : ($status === 'On Leave' ? 'text-yellow-600' : 'text-green-600') }}">
                        {{ $status }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
