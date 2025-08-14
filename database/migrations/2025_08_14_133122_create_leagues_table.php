<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->char('country_code', 2)->constrained('countries');
            $table->text('logo_url')->nullable();
            $table->unsignedTinyInteger('tier')->nullable(); // 1 for top division, 2 for second, etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leagues');
    }
};
