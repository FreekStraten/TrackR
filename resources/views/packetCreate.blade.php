<x-app-layout>
    <head>
        <title>{{ __('messages.create_packet') }}</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
    </head>


    <x-slot name="header">
        <h3 class="font-semibold text text-gray-800 leading-tight">
            {{ __('messages.create_packet') }}
        </h3>
    </x-slot>

    <body>

    <div class="flex max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="pt-10">
            <div
                class="bg-white overflow-hidden shadow-xl sm:rounded-lg inline-block px-2 mr-1 cursor-pointer active-tab"
                data-tab="tab1">
                Pakket Maken
            </div>
        </div>

        <div class="pt-10">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg inline-block px-2 cursor-pointer"
                 data-tab="tab2">
                CSV Importeren
            </div>
        </div>
    </div>


    <div class="pt-1 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <br>

                            <!-- Packet Create Forum Content -->
                            <div id="tab1" class="tab-content">
                                <form method="POST" action={{ route('packet_create.store') }}>
                                    @csrf
                                    <div class="form-group">
                                        <label for="date">{{ __('messages.date') }}</label>
                                        <input type="date" name="date" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="format">{{ __('messages.format') }}</label>
                                        <select name="format" class="form-control" required>
                                            <option value="letter">{{ __('messages.letter') }}</option>
                                            <option value="parcel">{{ __('messages.parcel') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="weight">{{ __('messages.weight') }}</label>
                                        <input type="number" name="weight" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="shipping_address">{{ __('messages.shipping_address') }}</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="shipping_streetname" class="form-control"
                                                       placeholder="{{ __('messages.street_name') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" name="shipping_housenumber" class="form-control"
                                                       placeholder="{{ __('messages.house_number') }}" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="shipping_city" class="form-control"
                                                       placeholder="{{ __('messages.city') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="shipping_zipcode" class="form-control"
                                                       placeholder="{{ __('messages.zip_code') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="delivery_address">{{ __('messages.delivery_address') }}</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="delivery_streetname" class="form-control"
                                                       placeholder="{{ __('messages.street_name') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" name="delivery_housenumber" class="form-control"
                                                       placeholder="{{ __('messages.house_number') }}" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="delivery_city" class="form-control"
                                                       placeholder="{{ __('messages.city') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="delivery_zipcode" class="form-control"
                                                       placeholder="{{ __('messages.zip_code') }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit"
                                            class="btn btn-primary">{{ __('messages.create_packet_button') }}</button>
                                </form>
                            </div>


                            <!-- Packet CSV Creation !-->
                            <div id="tab2" class="tab-content" style="display:none;">
                                <form method="POST" enctype="multipart/form-data" action={{ route('packet_create.uploadCsv') }}>
                                    @csrf
                                    <div class="form-group">
                                        <label for="csv">{{ __('messages.choose_file') }}</label>
                                        <input type="file" name="csv" accept=".csv" class="form-control-file" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{ __('messages.upload') }}</button>
                                </form>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
</x-app-layout>
