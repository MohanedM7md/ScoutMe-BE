<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable(false);
            $table->string('short_name', 50)->nullable();
            $table->enum('type', ['league', 'friendly', 'tournament'])->nullable(false);
            $table->char('country_code', 2)->nullable();
            $table->foreign('country_code')
                ->references('id')
                ->on('countries')
                ->onDelete('set null');
            $table->enum('gender', ['men', 'women'])->nullable();
            $table->string('age_group', 20)->nullable()->comment("senior, U23, U20, etc.");
            $table->text('logo_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('competitions');
    }
};
