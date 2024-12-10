<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;


class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search'); // Ambil input pencarian

        // Pencarian dan paginasi
        $data = Item::when($query, function ($q) use ($query) {
            return $q->where('name', 'like', "%{$query}%")
                     ->orWhere('description', 'like', "%{$query}%");
        })->paginate(7); // Gunakan paginate untuk paginasi

        // Kirim data ke view
        
        // $items = Item::all(); // Mengambil semua data dari tabel items
        // return response()->json($data); // Mengembalikan data sebagai JSON
        // return view('home', compact('items', 'query'));
        return view('home', compact('data', 'query'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Item::create($request->only(['name', 'description']));

        return redirect()->route('home')->with('success', 'Item created successfully.');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:500',
    ]);

    $item->update($request->only(['name', 'description']));

    return redirect()->route('home')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('home')->with('success', 'Item deleted successfully.');
    }
}