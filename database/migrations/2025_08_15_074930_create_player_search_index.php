<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('player_search', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained();
            $table->text('first_name');
            $table->text('last_name');
            $table->text('display_name');
            $table->text('primary_position');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE player_search ADD FULLTEXT fulltext_index (first_name, last_name, display_name, primary_position)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_search_index');
    }
};
