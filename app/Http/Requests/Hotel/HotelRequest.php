<?php

namespace App\Http\Requests\Hotel;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'nit' => ['required', 'string', 'max:255'],
            'rooms_number' => ['required', 'integer', 'min:1'],
        ];

        if ($this->method() === 'POST') {
            array_push($rules['name'], 'unique:hotels,name');
            array_push($rules['address'], 'unique:hotels,address');
        } else {
            array_push($rules['name'], 'unique:hotels,name,' . $this->hotel->id);
            array_push($rules['address'], 'unique:hotels,address,' . $this->hotel->id);
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.unique' => 'El nombre ya está en uso',
            'address.required' => 'La dirección es requerida',
            'address.unique' => 'La dirección ya está en uso',
            'city.required' => 'La ciudad es requerida',
            'nit.required' => 'El NIT es requerido',
            'rooms_number.required' => 'El número de habitaciones es requerido',
            'rooms_number.integer' => 'El número de habitaciones debe ser un número entero',
            'rooms_number.min' => 'El número de habitaciones debe ser mayor o igual a 1',
        ];
    }
}
