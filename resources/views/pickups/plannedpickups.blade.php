<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('pickups.pickups') }}
        </h2>
    </x-slot>

    <div class="pt-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-2.5 flex justify-between items-center">

                <div class="w-4/5 ml-2 flex">
                    <form action="{{ route('user-packets-list') }}" method="GET" class="w-full mx-2 flex">

{{--                        <input type="hidden" name="page" value="{{ $packets->currentPage() }}">--}}

                    </form>
                </div>

                <div class="w-4/5 ml-2 flex">
                    <!-- button Switch between already planned and unplanned -->
                    <form action="{{ route('pickups.index', $planned) }}" method="GET" class="w-full mx-2 flex">
                        <input type="hidden" name="planned" value="{{ $planned }}">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-800 text-black font-bold py-2 px-3 rounded-md shadow-md no-underline">{{ __('pickups.switch_planned') }}</button>
                    </form>



                </div>

                <div class="text-right mr-2">
                    <a href="{{ route('createLabels') }}"
                       class="bg-blue-600 hover:bg-blue-800 text-black font-bold py-2 px-3 rounded-md shadow-md no-underline">{{ __('messages.bulk_pdf') }}</a>
                </div>
            </div>
        </div>
    </div>


    <div class="pt-1 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="w-32">{{ __('messages.date') }}</th>
                            <th>{{ __('pickups.pickup_location') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($packets))
                            @foreach($packets as $packet)
                                <tr class="align-middle">
                                    <td class="">{{ $packet->pick_up_date_time }}</td>
                                    <td>{{ $packet->pickup_street }}, {{ $packet->pickup_house_number }}
                                        , {{ $packet->pickup_zip_code }} {{ $packet->pickup_city }}</td>
                                    <td>
                                        <a href="{{ route('pickups.show', ['id' => $packet->id]) }}"
                                           class="bg-blue-500 hover:bg-blue-600 text-black font-bold py-1 px-2 rounded-md shadow-md no-underline">{{ __('messages.details') }}</a>

                                    </td>

                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="pb-6 mx-4">
                    <div class="align-middle">
{{--                        {{ $packets->links() }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
