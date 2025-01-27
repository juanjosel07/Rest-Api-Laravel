<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::with('accommodations')->get();
        return response()->json(['roomTypes' => $roomTypes], 200);
    }
}
