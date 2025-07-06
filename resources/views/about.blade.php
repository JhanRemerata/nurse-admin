@extends('layouts.nurse')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white p-6 rounded shadow-lg">
        <h1 class="text-3xl font-bold text-yellow-900 mb-4">About NurseAdmin Lite</h1>

        <p class="text-gray-700 mb-4">
            <strong>NurseAdmin Lite</strong> is a simplified, web-based administrative system built to help nursing supervisors and healthcare teams efficiently manage staff-related operations. It offers essential features that streamline scheduling, leave tracking, and attendance monitoring, all in one easy-to-use platform.
        </p>

        <h2 class="text-2xl font-semibold text-yellow-800 mt-6 mb-2">Key Features</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
            <li>👩‍⚕️ <strong>Nurse Directory</strong> – View, add, update, and manage nurse profiles.</li>
            <li>📅 <strong>Duty Scheduling</strong> – Assign and track duty shifts for each nurse.</li>
            <li>🏖️ <strong>Leave Requests</strong> – Request and manage nurse leaves with approval tracking.</li>
            <li>📌 <strong>Attendance Tracker</strong> – Monitor nurse attendance status weekly.</li>
            <li>📄 <strong>Reports</strong> – Generate summaries from all nurse admin records.</li>
            <li>📊 <strong>Dashboard</strong> – Quick view of key stats and nursing activity notes.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-yellow-800 mt-6 mb-2">Purpose</h2>
        <p class="text-gray-700 mb-4">
            The system is designed to reduce manual tracking, improve task visibility, and support better planning within nursing departments — especially in clinical and educational settings.
        </p>

        <h2 class="text-2xl font-semibold text-yellow-800 mt-6 mb-2">Developed By</h2>
        <p class="text-gray-700">
            NurseAdmin Lite was built by a nursing student passionate about integrating technology into healthcare practice. This project demonstrates how even a lightweight tool can improve daily nursing workflows and reduce administrative burdens.
        </p>
    </div>
</div>
@endsection
