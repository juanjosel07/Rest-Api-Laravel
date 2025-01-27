<?php

namespace App\Http\Controllers;

use App\Http\Requests\Hotel\HotelRequest;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('roomTypes')->get();
        return response()->json(['hotels' => $hotels], 200);
    }

    public function getHotelById(Hotel $hotel)
    {
        return response()->json(['hotel' => $hotel->load('accommodationRoomTypes.roomType', 'accommodationRoomTypes.accommodation')], 200);
    }

    // public function store(Request $request)
    // {
    //     $hotel = new Hotel($request->all());
    //     $hotel->save();
    //     if (!$request->ajax()) return back()->with('success', 'Hotel created successfully');
    //     return response()->json(['status' => 'Hotel created successfully', 'hotel' => $hotel], 201);
    // }

    public function store(HotelRequest $request)
    {
        DB::beginTransaction();

        try {
            $hotel = new Hotel($request->all());
            $hotel->save();
            DB::commit();
            return response()->json(['message' => 'Hotel creado correctamente', 'hotel' => $hotel], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'error' => 'Ocurrió un error al guardar el hotel.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(HotelRequest $request, Hotel $hotel)
    {

        DB::beginTransaction();
        try {
            $hotel->update($request->all());
            DB::commit();
            return response()->json(['message' => 'Hotel actualizado correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'error' => 'Ocurrido un error al actualizar el hotel.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Request $request, Hotel $hotel)
    {
        DB::beginTransaction();
        try {
            $hotel->delete();
            DB::commit();
            return response()->json(['status' => 'Hotel eliminado correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'error' => 'Ocurrido un error al eliminar el hotel.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
