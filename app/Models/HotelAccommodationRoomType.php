<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelAccommodationRoomType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'hotel_room_accommodation';

    protected $fillable = [
        'hotel_id',
        'room_type_id',
        'accommodation_id',
        'quantity'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
