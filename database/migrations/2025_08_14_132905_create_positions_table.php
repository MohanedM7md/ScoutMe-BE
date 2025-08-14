<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->string('id', 5)->primary(); // Short codes like 'GK', 'CB', 'ST'
            $table->string('full_name', 30)->unique();
            $table->string('category', 20); // 'Goalkeeper', 'Defender', 'Midfielder', 'Forward'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('positions');
    }
};
