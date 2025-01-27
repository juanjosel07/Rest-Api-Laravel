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
        Schema::create('hotel_room_accommodation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hotel_id')->unsigned();
            $table->bigInteger('room_type_id')->unsigned();
            $table->bigInteger('accommodation_id')->unsigned();
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');

            $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('cascade');

            $table->foreign('accommodation_id')->references('id')->on('accommodations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table('hotel_room_accommodation', function (Blueprint $table) {
            $table->dropForeign(['hotel_id']);
            $table->dropForeign(['room_type_id']);
            $table->dropForeign(['accommodation_id']);
        });
        Schema::dropIfExists('hotel_room_accommodation');
    }
};
