<x-app-layout>

    <x-slot name="header">
        <h3 class="font-semibold text text-gray-800 leading-tight">
            {{__('reciever.trackedPacket')}}
        </h3>
    </x-slot>

    <!-- Content here -->

    <div class="mt-8 text-center">
        <div>
            <h2 class="text-2xl font-semibold">{{__('reciever.PackageInfo')}}</h2>
            <p><strong>{{__('reciever.TrackingNumber')}}</strong> {{ $packet->tracking_number }}</p>
        </div>

        <div class="mt-4">
            <h2 class="text-2xl font-semibold">{{__('reciever.PackageStatus')}}</h2>
            <p><strong>{{__('reciever.date')}}:</strong> {{ $packet->date }}</p>
            <p><strong>{{__('reciever.status')}}:</strong> {{ __('status.'.$packet->status) }}</p>
        </div>

        <div class="mt-8">
            <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md">{{__('reciever.login')}}</a>
        </div>
    </div>

</x-app-layout>
