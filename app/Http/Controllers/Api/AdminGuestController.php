<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateGuestStatusRequest;
use App\Models\Guest;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AdminGuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $statuses = Status::query()->orderBy('created_at', 'desc')->get();
            $guests = Guest::query()->orderBy('created_at', 'desc')->get();

            return response()->json(
                [
                    "statuses"=>$statuses,
                    "guests"=>$guests
                ],
                200
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        try {


            $guest->update([
                'status_id' => $request->status_id
            ]);


            return response()->json([
                'message' => 'Guest updated successfully',
                'guest' => $guest
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
