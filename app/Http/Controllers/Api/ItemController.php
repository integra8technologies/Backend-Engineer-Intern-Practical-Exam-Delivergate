<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        // Optional search by name: /api/items?search=chocolate
        $query = Item::query();
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        return response()->json($query->get());
    }

    public function show($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        return response()->json($item);
    }

    public function store(Request $request)
    {
        // Owner and Manager add items
        if ($request->user()->role === 'cashier') {
            return response()->json(['message' => 'Cashiers are not allowed to add items.'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $item = Item::create($validated);
        return response()->json(['message' => 'Item created successfully', 'data' => $item], 201);
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        // Owner, Manager, and Cashier edit items
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
        ]);

        $item->update($validated);
        return response()->json(['message' => 'Item updated successfully', 'data' => $item]);
    }

    public function destroy(Request $request, $id)
    {
        // owner delete itsms
        if ($request->user()->role !== 'owner') {
            return response()->json(['message' => 'Only the Owner is allowed to delete items.'], 403);
        }

        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $item->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
}
