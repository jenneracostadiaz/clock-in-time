@php
    $user_attendances = auth()->user()->attendances;
@endphp

@extends('layouts.app')

@section('content')



    <div class="relative overflow-x-auto bg-gray-100 shadow-xs sm:rounded-lg my-12 max-w-screen-md mx-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs bg-cyan-800 text-white uppercase">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Check In
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Check Out
                    </th><th scope="col" class="px-6 py-3">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($user_attendances as $attendance)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4">
                            {{ $attendance->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $attendance->check_in_time->setTimezone('America/Lima')->format('H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $attendance->check_out_time ? $attendance->check_out_time->setTimezone('America/Lima')->format('H:i') : 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $attendance->status ? 'Present' : 'Absent' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">
                            No records found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


@endsection
