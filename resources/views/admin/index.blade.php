<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('admin.admin') }}
        </h2>
    </x-slot>
    <!-- list of all users -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="container">
                            <div class="row">
                                 <span class="col">
                            {{ __('admin.user_list') }}
                        </span>
                                <span class="col">
                            <a href="{{ route('admin.create') }}" class="btn btn-primary">{{ __('admin.create') }}</a>
                        </span>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('admin.id') }}</th>
                                <th scope="col">{{ __('admin.name') }}</th>
                                <th scope="col">{{ __('admin.email') }}</th>
                                <th scope="col">{{ __('admin.created_at') }}</th>
                                <th scope="col">{{ __('admin.updated_at') }}</th>
                                <th scope="col">{{ __('admin.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>
                                    <td>

                                        <form action="{{ route('admin.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger">{{ __('admin.delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
