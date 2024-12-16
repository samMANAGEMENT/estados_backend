<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;

class AdminStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $statuses = Status::query()->orderBy('created_at', 'desc')->get();

            return response()->json($statuses, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'An error occurred while fetching statuses',
                'error' => $th
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
            ]);

            $status = Status::create($data);

            return response()->json([
                'message' => 'Status created successfully',
                $status
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'An error occurred while saving status',
                'error' => $th
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        try {
            return response()->json([
                'message' => 'Status details',
                $status
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'An error occurred while fetching status details',
                'error' => $th
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
            ]);

            $status->update($data);

            return response()->json([
                'message' => 'Status updated successfully',
                $status
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'An error occurred while fetching statuses',
                'error' => $th
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        try {
            $status->delete();

            return response()->json([
                'message' => 'Status deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'An error occurred while fetching statuses',
                'error' => $th
            ], 500);
        }
    }
}
