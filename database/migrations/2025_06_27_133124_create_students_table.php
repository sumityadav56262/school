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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('emis_no')->unique();
            $table->unsignedBigInteger('class_id');
            $table->string('stud_name');
            $table->integer('roll_no');
            $table->string('father_name');
            $table->string('mobile_no');
            $table->string('address');
            $table->unique(['class_id', 'roll_no'], 'unique_student_class_roll'); // Ensure unique combination of emis_no, class_id, and roll_no
            $table->softDeletes(); // Add soft delete functionality
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('stud_classes');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
