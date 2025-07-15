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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('id_card_no');
            $table->string('teacher_name');
            $table->boolean('active')->default(false);
            $table->boolean('is_archived')->default(false);
            $table->string('designation');
            $table->string('mobile_no');
            $table->string('address');
            $table->timestamps();

            $table->unique(['user_id', 'id_card_no']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
