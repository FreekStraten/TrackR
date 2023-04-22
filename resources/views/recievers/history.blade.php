<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('reciever.history') }} | {{__('reciever.count')}} : {{$packets->count()}}
        </h2>
    </x-slot>

    <div class="px-12 pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded">

            </div>
        </div>
    </div>


    <div class="px-12 pt-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @foreach($packets as $packet)
                        <div class="card">
                            <div class="card-header">
                                <p class="text-xl bold">{{__('reciever.wasdelivered')}}</p>
                                {{$packet->tracking_number}} | {{$packet->date}}
                            </div>

                            <div>
                                <form action="{{route('recievers.givefeedback')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="packet_id" value="{{$packet->id}}">
                                    <input class="form-control" type="text" name="feedback" id="feedback"
                                           placeholder="{{__('reciever.givefeedback')}}"
                                           onkeydown="if (event.keyCode === 13) this.form.submit();">
                                </form>
                            </div>

                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
