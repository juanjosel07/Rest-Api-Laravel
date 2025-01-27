<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\RoomRequest;
use App\Models\Hotel;
use App\Models\HotelAccommodationRoomType;

class RoomController extends Controller
{
    public function index(Hotel $hotel)
    {
        $roomAssignments = $hotel->accommodationRoomTypes()
            ->with('roomType', 'accommodation')
            ->get();
        return response()->json(['roomAssignments' => $roomAssignments], 200);
    }

    public function store(RoomRequest $request, Hotel $hotel)
    {


        $currentQuantity = $hotel->totalRoomsAssigned;
        $totalQuantity = $currentQuantity + $request->quantity;

        if ($totalQuantity > $hotel->rooms_number) {
            return response()->json([
                'status' => false,
                'message' => 'La cantidad de habitaciones asignadas supera el número de habitaciones disponibles en el hotel',
            ], 422);
        }

        HotelAccommodationRoomType::create([
            'hotel_id' => $hotel->id,
            'accommodation_id' => $request->accommodation_id,
            'room_type_id' => $request->room_type_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Habitaciones asignadas correctamente',
        ], 200);
    }

    public function getRoomById(Hotel $hotel, HotelAccommodationRoomType $roomType)
    {
        return response()->json(['roomType' => $roomType->load('roomType', 'accommodation')], 200);
    }

    public function update(RoomRequest $request, Hotel $hotel,  $assignmentId)
    {

        $assignment = HotelAccommodationRoomType::find($assignmentId);

        if (!$assignment || $assignment->hotel_id != $hotel->id) {
            return response()->json([
                'status' => false,
                'error' => 'Asignación de habitacion no encontrada',
            ]);
        }


        $currentQuantity = $hotel->totalRoomsAssigned - $assignment->quantity;
        $totalQuantity = $currentQuantity + $request->quantity;


        if ($totalQuantity > $hotel->rooms_number) {
            return response()->json(['error' => 'La cantidad de habitaciones asignadas supera el número de habitaciones disponibles en el hotel.'], 422);
        }

        $assignment->update([
            'quantity' => $request->quantity,
            'accommodation_id' => $request->accommodation_id,
            'room_type_id' => $request->room_type_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Habitaciones actualizadas correctamente',
        ], 200);
    }

    public function destroy(Hotel $hotel, $assignmentId)
    {

        $assignment = HotelAccommodationRoomType::find($assignmentId);

        if (!$assignment || $assignment->hotel_id != $hotel->id) {
            return response()->json([
                'status' => false,
                'error' => 'Asignación de habitacion no encontrada',
            ]);
        }

        $assignment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Asignación de habitaciones eliminada correctamente',
        ], 201);
    }
}
