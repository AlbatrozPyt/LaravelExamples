<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserTypesRequest;
use App\Http\Resources\UsersTypesResource;
use App\Models\UserTypes;
use Illuminate\Http\Request;

class UsersTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userTypes = UserTypes::all();
        return response()->json($userTypes);
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
    public function store(UserTypesRequest $request)
    {
        $userTypes = UserTypes::create($request->validated());

        return response()->json($userTypes, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserTypes $userTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserTypes $userTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserTypes $userTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $searchUserTypes = UserTypes::destroy($id);

        return response(null, 204);
    }
}
