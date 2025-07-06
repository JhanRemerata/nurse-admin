@extends('layouts.nurse')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-semibold text-yellow-900 mb-6">Attendance Tracker</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Nurse</th>
                    @foreach ($weekDates as $date)
                        <th class="px-4 py-2 border">{{ \Carbon\Carbon::parse($date)->format('D, M d') }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($nurses as $nurse)
                    <tr>
                        <td class="border px-4 py-2 font-semibold">{{ $nurse->name }}</td>
                        @foreach ($weekDates as $date)
                            @php
                                $status = $attendance[$nurse->id][$date] ?? 'Absent';
                                $color = match($status) {
                                    'On Duty' => 'bg-green-100 text-green-800',
                                    'On Leave' => 'bg-yellow-100 text-yellow-800',
                                    default => 'bg-red-100 text-red-800'
                                };
                            @endphp
                            <td class="border px-4 py-2 text-center">
                                <span class="px-2 py-1 rounded-full text-sm {{ $color }}">{{ $status }}</span>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
