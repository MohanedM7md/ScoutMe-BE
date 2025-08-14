<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('product_type', 20); // 'scout', 'club', 'premium'
            $table->string('tier', 20); // 'basic', 'pro', 'enterprise'
            $table->json('features');
            $table->decimal('price_monthly', 10, 2);
            $table->decimal('price_annual', 10, 2);
            $table->char('currency', 3)->default('EGP');
            $table->boolean('is_active')->default(true);
            $table->smallInteger('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscription_plans');
    }
};
