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
                <button
                    wire:click="create()"
                    class="text-white font-bold py-2 px-4 rounded my-3 bg-indigo-600 mb-6">
                    Create User
                </button>
            @if($isModalCreateUpdateOpen)
                @include('livewire.create_user')
            @endif
            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">No.</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Mail</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if( sizeof($users) == 0)
                    <tr>
                        <td class="border px-4 py-2 text-center" colspan="5">No users found.</td>
                    </tr>
                @else
                    @foreach($users as $user)
                        <tr>
                            <td class="border px-4 py-2">{{ $user->id }}</td>
                            <td class="border px-4 py-2">{{ $user->name }}</td>
                            <td class="border px-4 py-2">{{$user->email}}</td>
                            <td class="border px-4 py-2 text-center">
                                @if($user->hasRole('viewer'))
                                    <span class="font-mono text-green-500">Viewer</span>
                                @elseif($user->hasRole('writer'))
                                    <span class="font-mono text-green-500">Writer</span>
                                @else
                                    <span class="font-mono text-green-500">Admin</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2 flex sm:justify-start">
                                <button
                                    wire:click="edit({{ $user->id }})"
                                    class="ml-4 bg-indigo-600  text-white font-bold py-2 px-4 rounded">
                                    <x-fas-edit class="w-6 h-6 text-white"/>
                                </button>
                                <button
                                    wire:click="delete({{ $user->id }})"
                                    class="ml-4 bg-indigo-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    <x-far-trash-alt class="w-6 h-6 text-white"/>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
