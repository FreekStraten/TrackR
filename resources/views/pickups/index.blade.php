<x-app-layout>
    <x-slot name="header">
        <h3 class="font-semibold text-gray-800 leading-tight">
            {{ __('pickups.pickups') }}
        </h3>
    </x-slot>

    <div class="pt-10 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('messages.date') }}</th>
                            <th>{{ __('pickups.pickup_location') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($pickups))
                            @foreach($pickups as $pickup)
                                <tr class="align-middle">
                                    <td class=>{{ $pickup->pick_up_date_time }}</td>
                                    <td>{{ $pickup->pickup_street }}, {{ $pickup->pickup_house_number }}
                                        , {{ $pickup->pickup_zip_code }} {{ $pickup->pickup_city }}</td>

                                    <td>
                                        <a href="{{ route('user-packets-list', ['pickup_id' => $pickup->id]) }}"
                                           class="btn btn-primary">{{ __('messages.packets') }}: {{ $pickup->packets->count() }}</a>
                                    </td>
                                </tr>


                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="pb-6 mx-4">
                    <div class="align-middle">
                        {{--                        {{ $packets->links() }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
