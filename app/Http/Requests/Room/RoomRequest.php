<?php

namespace App\Http\Requests\Room;

use App\Models\Accommodation;
use App\Models\HotelAccommodationRoomType;
use App\Models\RoomType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;


class RoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        $rules = [
            'accommodation_id' => ['required', 'exists:accommodations,id'],
            'room_type_id' => ['required', 'exists:room_types,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];

        return $rules;
    }
    /**
     * Personalizar la lógica de validación para el tipo de habitación y acomodación.
     *
     * @return array
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->count() === 0) {
                    $accommodation = Accommodation::find($this->input('accommodation_id'));
                    $roomType = RoomType::find($this->input('room_type_id'));

                    // Verificamos si la relación existe entre el tipo de habitación y la acomodación
                    if (!$accommodation->roomTypes->contains($roomType)) {
                        $validator->errors()->add('accommodation_id', 'La acomodación no pertenece al tipo de habitación.');
                    }

                    $existingRoomAssignment = HotelAccommodationRoomType::where('accommodation_id', $accommodation->id)
                        ->where('room_type_id', $roomType->id)
                        ->where('hotel_id', $this->hotel->id)
                        ->first();

                    if ($this->method() === 'POST') {
                        if ($existingRoomAssignment) {
                            $validator->errors()->add('room_type_id', 'Ya existe una asignación de habitaciones para este tipo de habitación y acomodación.');
                        }
                    } else {
                        if ($existingRoomAssignment && $existingRoomAssignment->id != $this->assignmentId) {
                            $validator->errors()->add('room_type_id', 'Ya existe una asignación de habitaciones para este tipo de habitación y acomodación.');
                        }
                    }
                }
            }
        ];
    }

    public function messages(): array
    {
        return [
            'accommodation_id.exists' => 'La acomodación no existe.',
            'accommodation_id.required' => 'La acomodación es requerida.',
            'room_type_id.exists' => 'El tipo de habitación no existe.',
            'room_type_id.required' => 'El tipo de habitación es requerido.',
            'quantity.required' => 'La cantidad es requerida.',
        ];
    }
}
