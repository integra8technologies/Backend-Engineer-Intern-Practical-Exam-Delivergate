<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
        }
        return response()->json($query->get());
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        return response()->json($customer);
    }

    public function store(Request $request)
    {
        // all users can add customers
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:customers,phone',
            'loyalty_points' => 'sometimes|integer|min:0',
        ]);

        $customer = Customer::create($validated);
        return response()->json(['message' => 'Customer created successfully', 'data' => $customer], 201);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        // all users can edit customer details
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|unique:customers,phone,' . $id,
            'loyalty_points' => 'sometimes|integer|min:0',
        ]);

        $customer->update($validated);
        return response()->json(['message' => 'Customer updated successfully', 'data' => $customer]);
    }

    public function destroy(Request $request, $id)
    {
        // owner delete customer
        if ($request->user()->role !== 'owner') {
            return response()->json(['message' => 'Only the Owner is allowed to delete customer records.'], 403);
        }

        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
