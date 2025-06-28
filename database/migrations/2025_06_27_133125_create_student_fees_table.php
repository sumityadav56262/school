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
            $table->string('emis_no');
            $table->string('class_name');
            $table->date('payment_date');
            $table->date('admission_date');
            $table->string('month_name');
            $table->integer('yearly_fee')->default(0);
            $table->integer('eca_fee')->default(0);
            $table->integer('game_fee')->default(0);
            $table->integer('misc_fee')->default(0);
            $table->integer('exam_fee')->default(0);
            $table->integer('tie_belt_fee')->default(0);
            $table->integer('vest_fee')->default(0);
            $table->integer('computer_fee')->default(0);
            $table->integer('traouser_fee')->default(0);
            $table->integer('total_amt')->default(0);
            $table->integer('disc_amt')->default(0);
            $table->integer('payment')->default(0);
            $table->integer('dues')->default(0);
            $table->string('payment_by');
            $table->string('received_by');
            $table->string('recurring_dues')->nullable();
            $table->timestamps();

            $table->foreign('emis_no')->references('emis_no')->on('students')->onDelete('cascade');
            $table->foreign('class_name')->references('class_name')->on('stud_classes')->onDelete('cascade');
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
