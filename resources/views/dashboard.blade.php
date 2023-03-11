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

<div class="card">
    <div class="card-header text-center font-weight-bold">
        Nominace
    </div>
    <div class="card-body">
        <form name="add-blog-post-form" id="add-blog-post-form" method="post"
            action="{{ url('admin/nominations') }}">
            @csrf
            <div class="form-group mt-2">
                <label for="name" class="form-label">Jméno</label>
                <input type="name" class="form-control" id="name" name="name"
                    placeholder="Karel Svobodný">
            </div>
            <div class="form-group mt-2">
                <label for="name" class="form-label">Jméno</label>
                <input type="name" class="form-control" id="name" name="name"
                    placeholder="Karel Svobodný">
            </div>
            <div class="form-group mt-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    placeholder="kaja@bourak.com">
            </div>
            <div class="form-group mt-2">
                <label for="tel" class="form-label">Telefon</label>
                <input type="tel" class="form-control" id="tel" name="tel"
                    placeholder="555 252 222">
            </div>
            <div class="form-group mt-2">
                <label for="note" class="form-label">Poznámka</label>
                <textarea class="form-control" id="note" name="note" placeholder=""></textarea>
            </div>
            <div class="form-group mt-2">
                <label for="stand" class="form-label">Na stání</label>
                <input type="number" class="form-control" id="stand" name="stand" placeholder="">
            </div>
            <div class="form-group mt-2">
                <label for="seat">Sedadla</label>
                <select class="form-control" name="seats[]" id="seats"  multiple="multiple">
                    @foreach ($seats as $seat)
                        <option value="{{ $seat['id'] }}">{{ $seat['alias'] }}</option>
                    @endforeach
                </select>
            </div>

            <br>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-blue">Rezervovat</button>
            </div>
        </form>
    </div>
</div>
</div>
</x-app-layout>
