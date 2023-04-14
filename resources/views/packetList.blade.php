<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-gray-800 leading-tight">
            {{ __('messages.my_packets') }}
        </h3>
    </x-slot>

    <div class="pt-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-2.5 flex justify-between items-center">
                <div class="w-1/3 ml-2">
                    <form action="{{ route('user-packets-list') }}" method="GET" class="w-1/3 ml-2">
                        <label for="format" class="sr-only">{{ __('messages.format') }}</label>
                        <select name="format" id="format" class="form-control" onchange="this.form.submit()" required>
                            <option value=""{{ empty($selectedFormat) ? ' selected' : '' }}>{{ __('messages.all_formats') }}</option>
                            <option value="letter"{{ $selectedFormat === 'letter' ? ' selected' : '' }}>{{ __('messages.letter') }}</option>
                            <option value="parcel"{{ $selectedFormat === 'parcel' ? ' selected' : '' }}>{{ __('messages.parcel') }}</option>
                        </select>
                    </form>
                </div>
                <div class="w-2/3 text-right mr-2">
                    <a href="{{ route('createLabels') }}"
                       class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-1.5 px-3 rounded-md shadow-md no-underline">{{ __('messages.bulk_pdf') }}</a>
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
                            <th>{{ __('messages.actions') }}</th>
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
                    {{--                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
                    {{--                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
                    <div class="align-middle">
                        {{ $packets->links() }}
                    </div>
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
