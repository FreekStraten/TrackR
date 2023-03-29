<x-app-layout>
    <head>
        <title>{{ trans('messages.create_packet') }}</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
    </head>
    <body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <hr>
                <h1 id="title">{{ trans('messages.create_packet') }}</h1>
                <form method="PUT" action="/api/packets">
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
                                <input type="text" name="shipping_housenumber" class="form-control"
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
                                <input type="text" name="delivery_housenumber" class="form-control"
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
                    <button type="submit" class="btn btn-primary">{{ trans('messages.create_packet_button') }}</button>
                </form>
            </div>
        </div>
    </div>
    </body>
</x-app-layout>
