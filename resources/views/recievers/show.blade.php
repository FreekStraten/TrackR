<x-app-layout>

    <x-slot name="header">
        <h3 class="font-semibold text text-gray-800 leading-tight">
            {{__('reciever.track')}}
        </h3>
    </x-slot>

    <div class="flex justify-center items-center h-screen">
        <div class="">
            <form action="{{ route('recievers.track') }}" method="POST">
                @csrf
                <div>
                    <label for="tracking_number" class="block font-medium text-sm text-gray-700">{{__('reciever.TrackingNumber')}}</label>
                    <input type="text" name="tracking_number" id="tracking_number" class="mt-1 p-2 border border-gray-300 rounded-md" required>
                </div>


                @if (isset($error))
                    <!-- errors -->
                    <div class="mt-2">
                        <ul class="list-disc list-inside text-sm text-red-600">
                            <li>{{ $error }}</li>
                        </ul>
                    </div>
                @endif

                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">{{__('reciever.StartTracking')}}</button>
                </div>

                <div class="mt-8">
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md">{{__('reciever.login')}}</a>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
