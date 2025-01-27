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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
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
        //     $table->dropForeign(['room_type_id']);
        // });

        // schema::table('room_type_accommodation', function (Blueprint $table) {
        //     $table->dropForeign(['room_type_id']);
        // });
        Schema::dropIfExists('room_types');
    }
};
