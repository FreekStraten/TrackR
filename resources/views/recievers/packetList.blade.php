<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-gray-800 leading-tight">
            {{ __('messages.my_packets') }}
        </h3>

        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </x-slot>

    <div class="pt-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-2.5 flex justify-between items-center">

                <div class="w-4/5 ml-2 flex">
                    <form action="{{ route('recievers.index')}}" method="GET" class="w-full mx-2 flex">

                        <input type="hidden" name="page" value="{{ $packets->currentPage() }}">

                        <label for="format" class="sr-only">{{ __('messages.format') }}</label>
                        <select name="format" id="format" class="form-control mr-2" onchange="this.form.submit()">
                            <option
                                value=""{{ empty($selectedFormat) ? ' selected' : '' }}>{{ __('messages.all_formats') }}</option>
                            <option
                                value="letter"{{ $selectedFormat === 'letter' ? ' selected' : '' }}>{{ __('messages.letter') }}</option>
                            <option
                                value="parcel"{{ $selectedFormat === 'parcel' ? ' selected' : '' }}>{{ __('messages.parcel') }}</option>
                        </select>

                        <label for="sortByDate" class="sr-only">{{ __('messages.sort_by_date') }}</label>
                        <select name="sortByDate" id="sortByDate" class="form-control mr-2"
                                onchange="this.form.submit()">
                            <option value="">{{ __('messages.no_date') }}</option>
                            <option
                                value="asc"{{ $sortByDate === 'asc' ? ' selected' : '' }}>{{ __('messages.date_asc') }}</option>
                            <option
                                value="desc"{{ $sortByDate === 'desc' ? ' selected' : '' }}> {{__('messages.date_desc') }}</option>
                        </select>

                        <label for="sortDirection" class="sr-only">{{ __('messages.  sort_direction') }}</label>
                        <select name="sortDirection" id="sortDirection" class="form-control mr-2"
                                onchange="this.form.submit()">
                            <option value="">{{ __('messages.no_weight') }}</option>
                            <option
                                value="asc"{{ $sortDirection === 'asc' ? ' selected' : '' }}>{{ __('messages.weight_asc') }}</option>
                            <option
                                value="desc"{{ $sortDirection === 'desc' ? ' selected' : '' }}> {{__('messages.weight_desc') }}</option>
                        </select>

                        <input type="hidden" name="page" value="{{ $packets->currentPage() }}">
                        <input value="{{ $searchTerm }}" type="text" name="search" class="form-control mr-2"
                               placeholder="{{ __('messages.search') }}"
                               onkeydown="if (event.keyCode === 13) this.form.submit();">
                    </form>
                </div>

                <div class="text-right">
                    <a href="" class="pickup-button invisible bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-3 rounded-md shadow-md no-underline">{{ __('pickups.plan_pickup') }}</a>
                </div>
            </div>
        </div>
    </div>

    Test

    <div class="pt-1 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <table class="table" id="packets-table" dusk="packets-table">
                        <thead>
                        <tr>
                            <th class="hidden"></th>
                            <th class="w-32">{{ __('messages.date') }}</th>
                            <th class="">{{ __('messages.tracking_number') }}</th>
                            <th>{{ __('messages.format') }}</th>
                            <th>{{ __('messages.short_weight') }}</th>
                            <th>{{ __('messages.shipping_address') }}</th>
                            <th>{{ __('messages.delivery_address') }}</th>
                            <th class="w-32">{{ __('messages.deliverer') }}</th>
                            <th>{{__('messages.status')}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($packets))
                            @foreach($packets as $packet)
                                <tr>
                                    <td class="hidden" id="{{ $packet->id }}"></td>
                                    <td>{{ $packet->date }}</td>
                                    <td>{{ $packet->tracking_number }}</td>
                                    <td>{{ $packet->format }}</td>
                                    <td>{{ $packet->weight }}</td>
                                    <td>{{ $packet->shipping_street }}, {{ $packet->shipping_house_number }}
                                        , {{ $packet->shipping_zip_code }} {{ $packet->shipping_city }}</td>
                                    <td>{{ $packet->delivery_street }}, {{ $packet->delivery_house_number }}
                                        , {{ $packet->delivery_zip_code }} {{ $packet->delivery_city }}</td>
                                    <td>
                                        {{ $packet->delivery_driver }}
                                    </td>
                                    <td>
                                        {{__('status.'.$packet->status)}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="pb-6 mx-4">
                    <div class="align-middle">
                        {{ $packets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

