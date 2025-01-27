<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'room_types';


    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',

    ];

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_room_type_accommodation')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function accommodations()
    {
        return $this->belongsToMany(Accommodation::class, 'room_type_accommodation')
            ->withTimestamps();
    }

    public function hotelRoomTypes()
    {
        return $this->hasMany(HotelAccommodationRoomType::class);
    }
}
