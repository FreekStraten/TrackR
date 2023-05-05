<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-gray-800 leading-tight">
            {{ __('pickups.pickups') }} | {{__('pickups.plan_pickup')}}
        </h3>

    </x-slot>

    <div class="pt-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-2.5 flex justify-between items-center">
                <form class="mx-3" method="post" action="{{route('pickups.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="font-semibold" for="date">{{ __('pickups.date') }}</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{old('date')}}"
                                       required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="font-semibold" for="time">{{ __('pickups.time') }}</label>
                                <input type="time" class="form-control" id="time" name="time" value="{{old('time')}}"
                                       required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="font-semibold" for="time">{{ __('pickups.pickup_location') }}</label>
                                <input type="text" name="pickup_street" class="form-control"
                                       placeholder="{{ __('messages.street_name') }} " value="{{old('pickup_street')}}"
                                       required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="font-semibold invisible" for="time">{{ __('pickups.pickup_location') }}</label>
                                <input type="text" name="pickup_house_number" class="form-control"
                                       placeholder="{{ __('messages.house_number') }}"
                                       value="{{old('pickup_house_number')}}" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="font-semibold invisible" for="time">{{ __('pickups.pickup_location') }}</label>
                                <input type="text" name="pickup_city" class="form-control"
                                       placeholder="{{ __('messages.city') }}" value="{{old('pickup_city')}}" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label class="font-semibold invisible" for="time">{{ __('pickups.pickup_location') }}</label>
                                <input type="text" name="pickup_zip_code" class="form-control"
                                       placeholder="{{ __('messages.zip_code') }}" value="{{old('pickup_zip_code')}}"
                                       required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="text-center">
                                @foreach($packets as $packet)
                                    <input type="hidden" name="packetids[]" value="{{$packet->id}}">
                                @endforeach
                                    <label class="font-semibold invisible" for="time">{{ __('pickups.pickup_location') }}</label>
                                <button type="submit" class="btn btn-primary">{{ __('pickups.plan_pickup') }}</button>
                            </div>
                        </div>
                    </div>

                    <div class="row flex gap-3 mx-3">
                        @error('date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @error('time')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                </form>
            </div>
        </div>
    </div>


    <!-- form for planning a pickup time, date of pickup, time of pickup and adress of pickup -->
    <div class="pt-1 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-2.5 flex justify-between items-center">
                <table class="table m-6">
                    <thead>
                    <tr>
                        <th class="w-32">{{ __('messages.date') }}</th>
                        <th class="">{{ __('messages.tracking_number') }}</th>
                        <th>{{ __('messages.format') }}</th>
                        <th>{{ __('messages.short_weight') }}</th>
                        <th>{{ __('messages.shipping_address') }}</th>
                        <th>{{ __('messages.delivery_address') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($packets as $packet)
                        <!-- create a table with the information of the packets -->
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</x-app-layout>
