<x-app-layout>
    <head>
        <title>{{ trans('messages.create_packet') }}</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
    </head>

    <body>
    <div class="container">
        <h3 id="title" class="mt-3 mb-3">{{ trans('messages.upload_csv') }}</h3>
        <form method="POST" action="{{ route('packet_create.uploadCsv') }}" class="text-left mt-1.5 mb-0" enctype="multipart/form-data">
            @csrf
            <label for="csv_file" class="btn btn-secondary mt-2">
                {{ trans('messages.choose_file') }}
                <input type="file" name="csv_file" id="csv_file" accept=".csv" class="">
            </label>

            <button type="submit" class="btn btn-primary">{{ trans('messages.upload') }}</button>
        </form>

        <div class="row">
            <div class="col-md-12">
                <hr>
                <h1 id="title">{{ trans('messages.create_packet') }}</h1>
                <form method="POST" action={{ route('packet_create.store') }}>
                    @csrf
                    <div class="form-group">
                        <label for="date">{{ trans('messages.date') }}</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tracking_number">{{ trans('messages.tracking_number') }}</label>
                        <input type="text" name="tracking_number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="format">{{ trans('messages.format') }}</label>
                        <select name="format" class="form-control" required>
                            <option value="letter">{{ trans('messages.letter') }}</option>
                            <option value="parcel">{{ trans('messages.parcel') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="weight">{{ trans('messages.weight') }}</label>
                        <input type="number" name="weight" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="shipping_address">{{ trans('messages.shipping_address') }}</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="shipping_streetname" class="form-control"
                                       placeholder="{{ trans('messages.street_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="shipping_housenumber" class="form-control"
                                       placeholder="{{ trans('messages.house_number') }}" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="shipping_city" class="form-control"
                                       placeholder="{{ trans('messages.city') }}" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="shipping_zipcode" class="form-control"
                                       placeholder="{{ trans('messages.zip_code') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="delivery_address">{{ trans('messages.delivery_address') }}</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="delivery_streetname" class="form-control"
                                       placeholder="{{ trans('messages.street_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="delivery_housenumber" class="form-control"
                                       placeholder="{{ trans('messages.house_number') }}" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="delivery_city" class="form-control"
                                       placeholder="{{ trans('messages.city') }}" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="delivery_zipcode" class="form-control"
                                       placeholder="{{ trans('messages.zip_code') }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                            class="btn btn-primary">{{ trans('messages.create_packet_button') }}</button>
                </form>
            </div>
        </div>
    </div>
    </body>
</x-app-layout>
