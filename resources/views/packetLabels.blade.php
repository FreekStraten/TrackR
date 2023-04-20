<!DOCTYPE html>
@foreach($packets as $packet)
    <html style="page-break-after: always;">
    <head>
        <meta charset="utf-8">
        <title>{{__('messages.packet_label') }} {{ $packet->tracking_number }} </title>
    </head>
    <body>


    <div class="packet-container page-break">
        <div class="header">
            <h1>{{__('messages.packet_label') }}</h1>
        </div>

        <div class="details">
            <p>{{__('messages.date') }}: {{ $packet->date }}</p>
            <p>{{__('messages.tracking_number') }}: {{ $packet->tracking_number }}</p>
            <p>{{__('messages.format') }}: {{ $packet->format }}</p>
            <p>{{__('messages.weight') }}: {{ $packet->weight }}</p>
        </div>

        <div class="shipping-details">
            <h2>{{__('messages.shipping_address') }}</h2>
            <p>{{ $packet->shipping_street }} {{ $packet->shipping_house_number }}</p>
            <p>{{ $packet->shipping_zip_code }} {{ $packet->shipping_city }}</p>
        </div>

        <div class="delivery-details">
            <h2>{{ __('messages.delivery_address') }}</h2>
            <<p>{{ $packet->delivery_street }} {{ $packet->delivery_house_number }}</p>
            <p>{{ $packet->delivery_zip_code }} {{ $packet->delivery_city }}</p>
        </div>

        <br>
        <div class="footer">
            {!! $qrCodes !!}
            <p>{{ __('messages.generated_by_trackr') }}</p>
        </div>
    </div>
    </body>
    </html>
@endforeach
