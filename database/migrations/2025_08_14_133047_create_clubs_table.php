<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('short_name', 50)->nullable();
            $table->char('country_code', 2)->constrained('countries');
            $table->string('club_type', 20)->nullable(); // 'professional', 'amateur', 'academy'
            $table->text('logo_url')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clubs');
    }
};
