@extends('layouts.layout')

@section('content')
<div class="container mx-auto mt-10 max-w-xl">
    <div class="card">
        <div class="card-header bg-primary text-blue-500">
            <h1 class="text-3xl font-bold text-center text-blue-500 mb-6">{{ $item->name }}</h1>
        </div>
        <div class="card-body">
            <p class="block text-gray-700 font-medium mb-2">{{ $item->description }}</p>
            <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection