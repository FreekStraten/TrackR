<x-app-layout>
    <body>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
        <div class="flex justify-between items-center mb-8">
            <a href="{{ route('calendar.index', ['year' => $year, 'month' => $month - 1]) }}"
               class="text-blue-600 hover:text-blue-800">&lt; Previous Month</a>
            <h2 class="text-lg font-bold">{{ $firstDayOfMonth->format('F Y') }}</h2>
            <a href="{{ route('calendar.index', ['year' => $year, 'month' => $month + 1]) }}"
               class="text-blue-600 hover:text-blue-800">Next Month &gt;</a>
        </div>

        <div class="grid grid-cols-7 gap-4">

            @foreach ($daysOfWeek as $dayOfWeek)
                <div class="text-center text-gray-500 font-bold">{{ $dayOfWeek }}</div>
            @endforeach

            @foreach ($calendarDays as $key => $day)
                @if ($day !== '')
                            <div
                        class="text-center border rounded p-2 {{ $day === $today->day && $month === $today->month && $year === $today->year ? 'bg-gray-200' : '' }}">
                        {{ $day }}
                        @foreach ($pickUps as $pickUp)
                            @if (\Carbon\Carbon::parse($pickUp->pick_up_date_time)->day === $day)
                                TEST
                            @endif
                        @endforeach
                    </div>
                @else
                    <div></div>
                @endif
            @endforeach
        </div>
    </div>
    </body>
</x-app-layout>
