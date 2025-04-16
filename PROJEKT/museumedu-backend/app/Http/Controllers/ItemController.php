<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        return Item::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'theme' => 'required|string|max:255',
            'year' => 'required|integer',
            'story' => 'required|string',
            'image' => 'required|image'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('items', 'public');
        }

        $item = new Item();
        $item->name = $request->name;
        $item->theme = $request->theme;
        $item->year = $request->year;
        $item->story = $request->story;
        $item->image_path = 'storage/' . $imagePath;
        $item->save();

        return response()->json(['message' => 'Sikeres mentés'], 201);
    }

    public function themes()
    {
        $themes = Item::select('theme')->distinct()->pluck('theme');
        return response()->json($themes);
    }
}
