<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('misc_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('particular');
            $table->integer('amount');
            $table->string('payment_by');
            $table->date('payment_date');
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('misc_expenses');
    }
};
