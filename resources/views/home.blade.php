@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="flex justify-center">
        <div class="w-full max-w-2xl">
            <div class="bg-white shadow-md rounded-lg">
                <div class="bg-blue-500 text-white text-lg font-bold px-6 py-4 rounded-t-lg">
                    {{ __('Dashboard') }}
                </div>

                <div class="p-6">
                    @if (session('status'))
                        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="text-gray-600">{{ __('You are logged in!') }}</p>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>

                <div class="p-6">
                    <h1 class="text-2xl font-bold text-blue-500 mb-4">Items</h1>
                    <a href="{{ route('items.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Create Item</a>
                    @if (session('success'))
                        <p class="text-green-600 mt-4">{{ session('success') }}</p>
                    @endif

                    <div class="mt-6">
                        <h1 class="text-xl font-semibold mb-4">Search Items</h1>
                        <!-- Form pencarian -->
                        <form action="{{ route('home') }}"  class="flex gap-2">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ $query ?? '' }}" 
                                placeholder="Search items..." 
                                class="border border-gray-300 rounded px-4 py-2 w-full"
                            >
                            <button 
                                type="submit" 
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition"
                            >
                                Search
                            </button>
                        </form>
                    </div>

                    <div class="mt-6">
                        <h2 class="text-lg font-semibold">Results:</h2>
                        <ul class="space-y-4 mt-4">
                            @forelse ($data as $item)
                                <li class="border-b border-gray-300 pb-4">
                                    <h2 class="text-lg font-bold">{{ $item->name }}</h2>
                                    <p class="text-gray-600">{{ $item->description }}</p>
                                    <div class="mt-2 flex gap-4">
                                        <a href="{{ route('items.show', $item->id) }}" class="text-blue-500 hover:underline">Show</a>
                                        <a href="{{ route('items.edit', $item->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </div>
                                </li>
                                 @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No items found.</td>
                                    </tr>
                            @endforelse
                        </ul>
                        <!-- Pagination -->
                    
                       
         
                    </div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
