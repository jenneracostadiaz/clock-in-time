<div class="relative overflow-x-auto bg-gray-100 shadow-xs sm:rounded-lg my-12 max-w-screen-md mx-auto">
    <table class="w-full text-left rtl:text-right text-gray-500 ">
        <thead class="bg-cyan-900 text-lg text-white uppercase">
        <tr class="[&>th]:py-6 [&>th]:px-4">
            <th scope="col">
                Date
            </th>
            <th scope="col">
                Check In
            </th>
            <th scope="col">
                Check Out
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($user_attendances as $attendance)
            <tr class="odd:bg-gray-50 even:bg-gray-100 [&>td]:p-8">
                <td>
                    {{ $attendance->attendance_date->format('d/m/Y') }}
                </td>
                <td>
                    {{ $attendance->check_in_time->setTimezone('America/Lima')->format('H:i') }}
                </td>
                <td>
                    {{ $attendance->check_out_time ? $attendance->check_out_time->setTimezone('America/Lima')->format('H:i') : 'N/A' }}
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
    <div class="p-4">
        {{ $user_attendances->links() }}
    </div>
</div>
