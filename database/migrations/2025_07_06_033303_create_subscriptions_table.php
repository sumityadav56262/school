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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            $table->string('plan_name')->default('Basic');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['active', 'pending', 'expired', 'cancelled'])->default('pending');
            $table->decimal('price', 8, 2)->nullable();
            $table->string('paid_via')->nullable();
            $table->string('transaction_id')->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
