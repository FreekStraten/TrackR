<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>{{__('reciever.count')}} : {{$packets->count()}}</p>
                    @foreach($packets as $packet)
                        <div class="card">
                            <div class="card-header">
                                <p class="text-xl bold">{{__('reciever.wasdelivered')}}</p>
                                {{$packet->tracking_number}}
                                <br>

                                {{$packet->date}}

                            </div>

                            <div>
                                <form action="{{route('recievers.givefeedback')}}" method="post">
                                    <label class="form-label" >{{__('reciever.givefeedback')}}</label>
                                    <input  class="form-control" type="text" name="feedback" id="feedback">
                                    <input class="btn btn-primary" type="submit" value="{{__('reciever.submit')}}">
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
