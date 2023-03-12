<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Jméno - navrhovatel</th>
                    <th scope="col">Příjmení - navrhovatel</th>
                    <th scope="col">Email - navrhovatel</th>
                    <th scope="col">Fakulta</th>
                    <th scope="col">Jméno - nominovaný</th>
                    <th scope="col">Příjmení - nominovaný</th>
                    <th scope="col">Úspěchy</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nominations as $nomination)
                    <tr>
                        <th scope="row">{{ $nomination['id'] }}</th>
                        <td>{{ $nomination['recommendator_first_name'] }}</td>
                        <td>{{ $nomination['recommendator_last_name'] }}</td>
                        <td>{{ $nomination['recommendator_email'] }}</td>
                        <td>{{ $nomination['faculty_id'] }}</td>
                        <td>{{ $nomination['nominee_first_name'] }}</td>
                        <td>{{ $nomination['nominee_last_name'] }}</td>
                        <td>{{ $nomination['achievements'] }}</td>
                        <td>
                            <button type="submit" class="btn btn-orange">
                                <a href="{{ route('deleteNomination', $nomination['id']) }}">Smazat</a></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
