<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return Item::with(['category', 'programs'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image_path' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'programs' => 'array|nullable'
        ]);

        $item = Item::create($data);
        if (!empty($data['programs'])) {
            $item->programs()->sync($data['programs']);
        }

        return response()->json($item->load(['category', 'programs']), 201);
    }

    public function show(Item $item)
    {
        return $item->load(['category', 'programs']);
    }

    public function update(Request $request, Item $item)
    {
        $data = $request->validate([
            'name' => 'sometimes',
            'description' => 'nullable',
            'image_path' => 'nullable',
            'category_id' => 'sometimes|exists:categories,id',
            'programs' => 'array|nullable'
        ]);

        $item->update($data);
        if (isset($data['programs'])) {
            $item->programs()->sync($data['programs']);
        }

        return response()->json($item->load(['category', 'programs']), 200);
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->noContent();
    }
}
