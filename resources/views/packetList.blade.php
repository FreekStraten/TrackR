<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-gray-800 leading-tight">
            {{ __('messages.my_packets') }}
        </h3>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
{{--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
    </x-slot>

    <div class="pt-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-2.5 flex justify-between items-center">

                <div class="w-4/5 ml-2 flex">
                    <form action="{{ route('user-packets-list')}}" method="GET" class="w-full mx-2 flex">

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

                <div class="text-right mr-2">
                    <a href="{{ route('createLabels') }}"
                       class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-3 rounded-md shadow-md no-underline">{{ __('messages.bulk_pdf') }}</a>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('pickups.create') }}" method="GET">
        @csrf
        <div class="pt-1 pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('messages.qr') }}</th>
                                <th class="hidden"></th>
                                <th class="w-32">{{ __('messages.date') }}</th>
                                <th class="">{{ __('messages.tracking_number') }}</th>
                                <th>{{ __('messages.format') }}</th>
                                <th>{{ __('messages.short_weight') }}</th>
                                <th>{{ __('messages.shipping_address') }}</th>
                                <th>{{ __('messages.delivery_address') }}</th>
                                <th class="w-32">{{ __('messages.deliverer') }}</th>
                                <th>{{ __('messages.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($packets))
                                @foreach($packets as $packet)
                                    <tr class="cursor-pointer hover:bg-gray-100" onclick="toggleRowSelection(this)">
                                        <td class="hidden" id="{{ $packet->id }}"></td>
                                        <td><a  href="{{ route('showQR', ['id' => $packet->id]) }}" class="fa fa-qrcode no-underline text-black" style="font-size:24px"></a></td>
                                        <td>{{ $packet->date }}</td>
                                        <td>{{ $packet->tracking_number }}</td>
                                        <td>{{ __('messages.' . $packet->format)}}</td>
                                        <td>{{ $packet->weight }}g</td>
                                        <td>{{ $packet->shipping_street }}, {{ $packet->shipping_house_number }}
                                            , {{ $packet->shipping_zip_code }} {{ $packet->shipping_city }}</td>
                                        <td>{{ $packet->delivery_street }}, {{ $packet->delivery_house_number }}
                                            , {{ $packet->delivery_zip_code }} {{ $packet->delivery_city }}</td>
                                        <td>
                                            <form action="{{ route('saveDriver') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $packet->id }}">
                                                <select name="delivery_driver" id="driver-{{ $packet->id }}" class="form-control mr-2"
                                                        onchange="document.getElementById('driver-form-{{ $packet->id }}').submit()">
                                                    <option value="">-</option>
                                                    @foreach($delivery_drivers as $driver)
                                                        <option
                                                            value="{{ $driver->name }}"{{ $driver->name == $packet->delivery_driver ? ' selected' : '' }}>{{ $driver->name }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <td class="flex gap-2 items-center">
                                            <a href="{{ route('createLabel', ['id' => $packet->id]) }}"
                                               class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-2 rounded-md shadow-md no-underline">PDF</a>
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
    </form>
</x-app-layout>


<script>

    let pickupButton = document.querySelector(".pickup-button");
    let pickupsids = [];

    pickupButton.addEventListener('click', function (e) {

        e.preventDefault();

        // Make an AJAX request to the server-side endpoint
        fetch(`/pickups/create?pickupsids=${pickupsids.join(',')}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => {
                // Handle the response from the server
                console.log(response);

                //redirect
                window.location.href = response.url;
            })

    });

    function toggleRowSelection(row) {
        row.classList.toggle('bg-gray-200');

        let selectedRows = document.querySelectorAll(".bg-gray-200");

        if (selectedRows.length > 0) {
            pickupButton.classList.remove("invisible");
        } else {
            pickupButton.classList.add("invisible");
        }

        //loop through all toggled rows
        for (let i = 0; i < selectedRows.length; i++) {

            //add the id of the row to the array if it is not already in the array
            if (!pickupsids.includes(selectedRows[i].firstElementChild.id)) {
                pickupsids.push(selectedRows[i].firstElementChild.id);
            }
        }

    }
</script>

