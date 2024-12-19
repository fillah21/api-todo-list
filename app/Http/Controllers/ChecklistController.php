<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChecklistRequest;
use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checklist = Checklist::where('user_id', Auth::id())->with(['user'])->get();

        return response()->json([
            'status_code' => 200,
            'message' => "Checklist current user successfull show",
            'data' => $checklist,
        ]);
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
    public function store(ChecklistRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();

        Checklist::create($data);

        return response()->json([
            'status_code' => 200,
            'message' => "Checklist successfull created"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $checklist = Checklist::where('id', $id)->with(['user', 'todo'])->first();

        return response()->json([
            'status_code' => 200,
            'message' => "Detail checklis successfull show",
            'data' => $checklist,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $checklist = Checklist::find($id);

        if(Auth::id() != $checklist->user_id) {
            return response()->json([
                'status_code' => 403,
                'message' => "This checklist is not your"
            ], 403);    
        }

        $checklist->delete();

        return response()->json([
            'status_code' => 200,
            'message' => "Checklist successfull deleted"
        ]);
    }
}
