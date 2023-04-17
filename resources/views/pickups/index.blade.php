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
                    <form action="{{ route('pickups.planned') }}" method="GET" class="w-full mx-2 flex">
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
                            <th class="">{{ __('messages.tracking_number') }}</th>
                            <th>{{ __('messages.format') }}</th>
                            <th>{{ __('messages.short_weight') }}</th>
                            <th>{{ __('messages.shipping_address') }}</th>
                            <th>{{ __('messages.delivery_address') }}</th>
                            <th class="w-32">{{ __('messages.deliverer') }}</th>
                            <th>{{ __('messages.createpickupaction') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($packets))
                            @foreach($packets as $packet)
                                <tr class="align-middle">
                                    <td>{{ $packet->date }}</td>
                                    <td>{{ $packet->tracking_number }}</td>
                                    <td>{{ $packet->format }}</td>
                                    <td>{{ $packet->weight }}</td>
                                    <td>{{ $packet->shipping_street }}, {{ $packet->shipping_house_number }}
                                        , {{ $packet->shipping_zip_code }} {{ $packet->shipping_city }}</td>
                                    <td>{{ $packet->delivery_street }}, {{ $packet->delivery_house_number }}
                                        , {{ $packet->delivery_zip_code }} {{ $packet->delivery_city }}</td>
                                    <td>

                                        <!-- if the delivery is null, it is 'unchosendriver' otherwise show it -->
                                        @if($packet->delivery_id == null)
                                            {{ __('messages.unchosendriver') }}
                                        @else
                                            {{ $packet->delivery->name }}
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('pickups.create', ['id' => $packet->id]) }}"
                                           class="btn btn-bg btn-primary">{{__('pickups.plan')}}</a>
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
