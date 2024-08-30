<?php

namespace App\Http\Controllers;

use App\Models\Rest;
use Illuminate\Http\Request;

class RestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Rest::all();
        return response()->json(['data' => $items], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = Rest::create($request->all());
        return response()->json(['data' => $item], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rest $rest)
    {
        $item = Rest::find($rest);
        if ($item) {
            return response()->json(['data' => $item], 200);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rest $rest)
    {
        $update = [
            'message' => $request->message,
            'url' => $request->url
        ];
        $item = Rest::where('id', $rest->id)->update($update);
        if ($item) {
            return response()->json(['message' => 'Updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rest $rest)
    {
        $item = Rest::where('id', $rest->id)->delete();
        if ($item) {
            return response()->json(['message' => 'Deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Not found'], 404);
        }
    }
}
