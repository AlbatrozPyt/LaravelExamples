<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoresRequest;
use App\Models\Store;
use App\Models\Users;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Store::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresRequest $request)
    {
        $store = Store::create($request->validated());
        return response()->json($store, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $store = Store::find($id);

        if (is_null($store)) {
            return response()->json(['message' => 'Loja não cadastrada']);
        }

        $store->update($request->all());
        return response()->json($store);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $store = Store::find($id);

        if (is_null($store)) {
            return response()->json(['message' => 'Loja não cadastrada']);
        }

        $store->delete();
        return response(null, 204);
    }
}
