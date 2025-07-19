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
        Schema::create('student_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('emis_no');
            $table->string('payment_date');
            $table->string('admission_date')->nullable();
            $table->string('month_name');
            $table->integer('yearly_fee')->default(0);
            $table->integer('monthly_fee')->default(0);
            $table->integer('eca_fee')->default(0);
            $table->integer('game_fee')->default(0);
            $table->integer('misc_fee')->default(0);
            $table->integer('exam_fee')->default(0);
            $table->integer('tie_belt_fee')->default(0);
            $table->integer('vest_fee')->default(0);
            $table->integer('computer_fee')->default(0);
            $table->integer('trouser_fee')->default(0);
            $table->integer('total_amt')->default(0);
            $table->integer('discount_amt')->default(0);
            $table->integer('payment_amt')->default(0);
            $table->integer('dues_amt')->default(0);
            $table->string('payment_by');
            $table->string('received_by');
            $table->string('recurring_dues')->nullable();
            $table->string('recurring_dues_included_amt')->nullable();
            $table->unsignedBigInteger('invoice_no');
            $table->softDeletes(); // Add soft delete column
            $table->timestamps();

            $table->foreign('emis_no')->references('emis_no')->on('students')->onDelete('cascade');
            $table->unique(['user_id', 'invoice_no']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_fees');
    }
};
