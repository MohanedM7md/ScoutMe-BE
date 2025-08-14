<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scout_id')->constrained('scouts');
            $table->foreignId('plan_id')->constrained('subscription_plans');
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');
            $table->string('payment_status', 20); // 'active', 'past_due', 'canceled', 'unpaid'
            $table->string('renewal_period', 10); // 'monthly', 'annual'
            $table->boolean('auto_renew')->default(true);
            $table->string('payment_method_id')->nullable();
            $table->jsonb('billing_details')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['scout_id', 'ends_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_subscriptions');
    }
};
