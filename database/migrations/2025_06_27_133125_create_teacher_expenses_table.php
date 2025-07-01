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
        Schema::create('teacher_expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('id_card_no');
            $table->integer('salary_amout');
            $table->integer('paid_amt');
            $table->integer('due_amt');
            $table->string('paid_by');
            $table->date('paid_date');
            $table->string('remark')->nullable();
            $table->timestamps();

            $table->foreign('id_card_no')->references('id_card_no')->on('teachers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_expenses');
    }
};
