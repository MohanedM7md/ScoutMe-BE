<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->char('id', 2)->primary(); // Using ISO 2-letter codes as primary key
            $table->string('name', 100)->unique();
            $table->char('iso_code_3', 3)->nullable();
            $table->string('continent', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('countries');
    }
};
