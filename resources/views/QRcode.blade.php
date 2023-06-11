<x-app-layout>

    <div class="flex h-screen items-center justify-center">
        <p hidden>{{ $packet->tracking_number }}</p>
        <p id="qr-code">{{ $packet->qrCode }}</p>
    </div>

</x-app-layout>
