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
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('items'), $imageName);
            $imagePath = 'items/' . $imageName;
        }

        $item = new Item();
        $item->name = $request->name;
        $item->theme = $request->theme;
        $item->year = $request->year;
        $item->story = $request->story;
        $item->image_path = $imagePath;
        $item->save();

        return response()->json(['message' => 'Sikeres mentés'], 201);
    }

    public function themes()
    {
        $themes = Item::select('theme')->distinct()->pluck('theme');
        return response()->json($themes);
    }
}
