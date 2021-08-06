<x-slot name="header">
    <h2 class="text-center">Games</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3 mb-4"
                     role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
                @can('create games')
                    <button
                        wire:click="create()"
                        class="text-white font-bold py-2 px-4 rounded my-3 bg-indigo-600 mb-6">
                        Create Game
                    </button>
                @endcan
            @if($isModalCreateUpdateOpen)
                @include('livewire.create')
            @elseif($isModalShowOpen)
                @include('livewire.show')
            @endif
            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">No.</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Website</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if( sizeof($games) == 0)
                    <tr>
                        <td class="border px-4 py-2 text-center" colspan="5">No games found.</td>
                    </tr>
                @else
                    @foreach($games as $game)
                        <tr>
                            <td class="border px-4 py-2">{{ $game->id }}</td>
                            <td class="border px-4 py-2">{{ $game->name }}</td>
                            <td class="border px-4 py-2">
                                <button class="bg-green-700 text-white font-bold py-2 px-4 rounded my-3 w-full bg-indigo-600">
                                    <a href="{{$game->url}}" target="_blank">Visit web</a>
                                </button>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <span class="font-mono {{$game->status ? 'text-green-500' : 'text-red-500'}}">{{ $game->status ? 'Activo' : 'Inactivo'}}</span>
                            </td>
                            <td class="border px-4 py-2 flex sm:justify-start">
                                <button
                                    wire:click="show({{ $game->id }})"
                                    class="ml-6 bg-indigo-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    <x-fas-eye class="w-6 h-6 text-white"/>
                                </button>
                                @can('edit games')
                                    <button
                                        wire:click="edit({{ $game->id }})"
                                        class="ml-4 bg-indigo-600  text-white font-bold py-2 px-4 rounded">
                                        <x-fas-edit class="w-6 h-6 text-white"/>
                                    </button>
                                @endcan
                                @can('delete games')
                                    <button
                                        wire:click="delete({{ $game->id }})"
                                        class="ml-4 bg-indigo-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        <x-far-trash-alt class="w-6 h-6 text-white"/>
                                    </button>
                                @endcan


                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
