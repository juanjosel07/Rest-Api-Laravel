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
        Schema::create('room_type_accommodation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('room_type_id')->unsigned();
            $table->bigInteger('accommodation_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('cascade');

            $table->foreign('accommodation_id')->references('id')->on('accommodations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table('room_type_accommodation', function (Blueprint $table) {
            $table->dropForeign(['room_type_id']);
            $table->dropForeign(['accommodation_id']);
        });
        Schema::dropIfExists('room_type_accommodation');
    }
};
