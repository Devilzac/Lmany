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
        Schema::create('pending_characters', function (Blueprint $table) {
            $table->id();
            // Add any additional columns you may need for your pending character model
            $table->string('character1');
            $table->string('character2');
            $table->unsignedBigInteger('server_id')->default(12);
            $table->foreign('server_id')
                  ->references('id')
                  ->on('servers')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_characters');
    }
};
