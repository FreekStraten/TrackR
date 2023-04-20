<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-gray-800 leading-tight">
            {{ __('pickups.pickups') }} | {{__('pickups.plan_pickup')}}
        </h3>

    </x-slot>

    <!-- form for planning a pickup time, date of pickup, time of pickup and adress of pickup -->
    <div class="pt-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-2.5 flex justify-between items-center">

                <form class="m-4" method="post" action="{{route('pickups.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="font-semibold" for="date">{{ __('pickups.date') }}</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{old('date')}}"
                                       required>
                                @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="font-semibold" for="time">{{ __('pickups.time') }}</label>
                                <input type="time" class="form-control" id="time" name="time" value="{{old('time')}}"
                                       required>
                                @error('time')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="form-group">
                        <label for="delivery_address">{{ __('pickups.pickup_location') }}</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="pickup_street" class="form-control"
                                       placeholder="{{ __('messages.street_name') }} " value="{{old('pickup_street')}}"
                                       required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="pickup_house_number" class="form-control"
                                       placeholder="{{ __('messages.house_number') }}"
                                       value="{{old('pickup_house_number')}}" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="pickup_city" class="form-control"
                                       placeholder="{{ __('messages.city') }}" value="{{old('pickup_city')}}" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="pickup_zip_code" class="form-control"
                                       placeholder="{{ __('messages.zip_code') }}" value="{{old('pickup_zip_code')}}"
                                       required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="text-center flex">
                        @foreach($packets as $packet)
                            <input type="hidden" name="packetids[]" value="{{$packet->id}}">
                        @endforeach
                        <button type="submit" class="btn btn-primary ">{{ __('pickups.plan_pickup') }}</button>
                    </div>

                </form>


                <!-- centered card with the information -->
                <div class="card text-center mr-4">
                    <div class="card-header">
                        {{ __('messages.details') }}
                    </div>

                    @foreach($packets as $packet)
                        <div class="card card-body">
                            <div class="container">
                                <div class="row">

                                    <div class="form-group col">
                                        <label class="font-semibold" for="date">{{ __('messages.date') }}</label>
                                        <p class="">{{$packet->date}}</p>
                                    </div>

                                    <div class="form-group col">
                                        <label class="font-semibold" for="format">{{ __('messages.format') }}</label>
                                        <p class="">{{$packet->format}}</p>
                                    </div>

                                    <div class="form-group col">
                                        <label class="font-semibold" for="weight">{{ __('messages.weight') }}</label>
                                        <p class="">{{$packet->weight}}</p>
                                    </div>

                                </div>
                            </div>


                            <!-- 2 cards next to each other containing shipping and delivery locations info -->
                            <div class="card-group">
                                <div class="card">
                                    <div class="card-header">
                                        {{ __('messages.shipping_address') }}
                                    </div>
                                    <div class="card-body">
                                        <p class="">{{$packet->shipping_street}}, {{$packet->shipping_house_number}}
                                            , {{$packet->shipping_zip_code}} {{$packet->shipping_city}}</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        {{ __('messages.delivery_address') }}
                                    </div>
                                    <div class="card-body">
                                        <p class="">{{$packet->delivery_street}}, {{$packet->delivery_house_number}}
                                            , {{$packet->delivery_zip_code}} {{$packet->delivery_city}}</p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
