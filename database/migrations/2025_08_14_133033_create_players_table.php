<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();

            // Personal Info
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('display_name', 100)->nullable();
            $table->date('birth_date')->nullable();
            //deleted
            $table->char('player_nationality', 2);
            $table->foreign('player_nationality')->references('id')->on('countries')->onUpdate('cascade')->onDelete('restrict');
            // Physical Attributes
            $table->unsignedSmallInteger('height_cm')->nullable();
            $table->unsignedSmallInteger('weight_kg')->nullable();

            // Position
            $table->string('primary_position', 5)->constrained('positions');
            $table->text('player_image')->nullable();
            $table->boolean('is_profile_complete')->default(false);

            // Metadata
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['first_name', 'last_name']);
            $table->index('birth_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('players');
    }
};
