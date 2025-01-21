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
        Schema::create('cricket_matches', function (Blueprint $table) {
            $table->id();

            // First team
            $table->unsignedBigInteger('team1_id');
            $table->foreign('team1_id')->references('id')->on('teams')->onDelete('cascade');
            $table->json('team1_players');

            // Second team
            $table->unsignedBigInteger('team2_id');
            $table->foreign('team2_id')->references('id')->on('teams')->onDelete('cascade');
            $table->json('team2_players');

            // Match result and status
            $table->enum('result', ['team1_won', 'team2_won', 'draw'])->nullable();
            $table->string('status')->default('pending');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cricket_matches');
    }
};
