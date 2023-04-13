<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-gray-800 leading-tight">
            {{ __('messages.my_packets') }}
        </h3>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('messages.date') }}</th>
                            <th>{{ __('messages.tracking_number') }}</th>
                            <th>{{ __('messages.format') }}</th>
                            <th>{{ __('messages.short_weight') }}</th>
                            <th>{{ __('messages.shipping_address') }}</th>
                            <th>{{ __('messages.delivery_address') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($packets))
                            @foreach($packets as $packet)
                                <tr>
                                    <td>{{ $packet->date }}</td>
                                    <td>{{ $packet->tracking_number }}</td>
                                    <td>{{ $packet->format }}</td>
                                    <td>{{ $packet->weight }}</td>
                                    <td>{{ $packet->shipping_street }}, {{ $packet->shipping_house_number }}
                                        , {{ $packet->shipping_zip_code }} {{ $packet->shipping_city }}</td>
                                    <td>{{ $packet->delivery_street }}, {{ $packet->delivery_house_number }}
                                        , {{ $packet->delivery_zip_code }} {{ $packet->delivery_city }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
