@extends('layouts.layout')

@section('content')
<div class="container mx-auto mt-10 max-w-xl">
    <h1 class="text-3xl font-bold text-center text-blue-500 mb-6">Create Item</h1>
    <form action="{{ route('items.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Name:</label>
            <input 
                type="text" 
                name="name" 
                class="border border-gray-300 rounded w-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                placeholder="Enter item name" 
                required
            >
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Description:</label>
            <textarea 
                name="description" 
                class="border border-gray-300 rounded w-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                rows="4" 
                placeholder="Enter item description" 
                required
            ></textarea>
        </div>
        <div class="text-center">
            <button 
                type="submit" 
                class="bg-blue-500 text-white font-semibold py-2 px-6 rounded-lg hover:bg-blue-600 transition"
            >
                Save
            </button>
        </div>
    </form>
</div>
@endsection
