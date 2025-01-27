<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('address')->unique();
            $table->string('city');
            $table->string('nit');
            $table->integer('rooms_number')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // schema::table('hotel_room_accommodation', function (Blueprint $table) {
        //     $table->dropForeign(['hotel_id']);
        // });
        Schema::dropIfExists('hotels');
    }
};
