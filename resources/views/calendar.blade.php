<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text text-gray-800 leading-tight" dusk="calendar-header">
            {{__('calendar.calendar_overview')}}
        </h3>
    </x-slot>

    <body>

    <div class="pt-12 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-10">
                    <div class="flex justify-between items-center mb-8">
                        <a href="{{ route('calendar.index', ['year' => $year, 'month' => $month - 1]) }}"
                           class="text-blue-600 hover:text-blue-800" dusk="previous-month-link">< {{__('calendar.previous_month')}}</a>

                        <!-- month number from months.php in lang -->
                        <h2 class="text-lg font-bold">{{__('months.' . (int) $firstDayOfMonth->format('m'))}}  {{ $firstDayOfMonth->format('Y') }}</h2>

                        <a href="{{ route('calendar.index', ['year' => $year, 'month' => $month + 1]) }}"
                           class="text-blue-600 hover:text-blue-800" dusk="next-month-link">{{__('calendar.next_month')}} &gt;</a>
                    </div>

                    <div class="grid grid-cols-7 gap-4">

                        @foreach (__('days') as $day)
                            <div class="text-center text-gray-500 font-bold" dusk="calendar-day">{{ $day }}</div>
                        @endforeach

                        @foreach ($calendarDays as $key => $day)
                            @if ($day !== '')
                                @php
                                    $calendarDay = Carbon\Carbon::createFromDate($year, $month, $day, 'CET');
                                @endphp
                                <div class="text-center border rounded p-2 {{ $calendarDay->isSameDay($today) ? 'bg-gray-200' : '' }}" dusk="calendar-day-{{ $day }}">
                                    {{ $day }}
                                    @foreach ($pickUps as $pickUp)
                                        @if ($calendarDay->isSameDay(Carbon\Carbon::parse($pickUp->pick_up_date_time)))
                                            <!-- send to /packets?pickup_id=2 -->
                                            <a href="{{ route('user-packets-list', ['pickup_id' => $pickUp->id]) }}"
                                               class="text-blue-600 hover:text-blue-800" dusk="pickup-id-link-{{ $pickUp->id }}">ID: {{ $pickUp->id }}</a>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div></div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    </body>
</x-app-layout>
