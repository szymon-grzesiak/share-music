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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->integer('duration');
            $table->unsignedBigInteger('album_id');
            $table->unsignedBigInteger('artist_id');
            $table->foreign('album_id')
                ->references('id')
                ->on('albums')
                ->onDelete('no action');
            $table->foreign('artist_id')
                ->references('id')
                ->on('users')
                ->onDelete('no action');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
