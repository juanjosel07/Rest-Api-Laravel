<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'hotels';

    protected $fillable = [
        'name',
        'address',
        'city',
        'nit',
        'rooms_number',
    ];

    protected $appends = ['total_rooms_assigned'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',

    ];
    public function roomTypes()
    {
        return $this->belongsToMany(RoomType::class, 'hotel_room_accommodation')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function accommodations()
    {
        return $this->belongsToMany(Accommodation::class, 'hotel_room_accommodation')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function accommodationRoomTypes()
    {
        return $this->hasMany(HotelAccommodationRoomType::class);
    }

    public function totalRoomsAssigned(): Attribute
    {
        return Attribute::make(
            get: fn(): int => (int) $this->roomTypes()
                ->whereNull('hotel_room_accommodation.deleted_at') // Excluir eliminados
                ->sum('hotel_room_accommodation.quantity')
        );
    }
}
