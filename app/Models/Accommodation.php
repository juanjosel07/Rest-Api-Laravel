<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accommodation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'accommodations';

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',

    ];

    public function roomTypes()
    {
        return $this->belongsToMany(RoomType::class, 'room_type_accommodation')
            ->withTimestamps();
    }

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_room_type_accommodation')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function hotelRoomTypes()
    {
        return $this->hasMany(HotelAccommodationRoomType::class);
    }
}
