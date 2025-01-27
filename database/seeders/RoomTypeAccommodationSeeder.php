<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeAccommodationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = [
            ['name' => 'Estándar'],
            ['name' => 'Junior'],
            ['name' => 'Suite'],
        ];
        // DB::table('room_types')->insert($roomTypes);

        foreach ($roomTypes as $roomType) {
            RoomType::create($roomType);
        }

        // Insertar acomodaciones
        $accommodations = [
            ['name' => 'Sencilla'],
            ['name' => 'Doble'],
            ['name' => 'Triple'],
            ['name' => 'Cuádruple'],
        ];
        // DB::table('accommodations')->insert($accommodations);

        foreach ($accommodations as $accommodation) {
            Accommodation::create($accommodation);
        }

        // Insertar combinaciones válidas en room_type_accommodations
        $roomTypeAccommodations = [
            // Standard
            ['room_type_id' => 1, 'accommodation_id' => 1], // Sencilla
            ['room_type_id' => 1, 'accommodation_id' => 2], // Doble
            // Junior
            ['room_type_id' => 2, 'accommodation_id' => 3], // Triple
            ['room_type_id' => 2, 'accommodation_id' => 4], // Cuádruple
            // Suite
            ['room_type_id' => 3, 'accommodation_id' => 1], // Sencilla
            ['room_type_id' => 3, 'accommodation_id' => 2], // Doble
            ['room_type_id' => 3, 'accommodation_id' => 3], // Triple
        ];
        DB::table('room_type_accommodation')->insert($roomTypeAccommodations);
    }
}
