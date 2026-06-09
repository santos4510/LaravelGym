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
        //update profiles table to add height, weight, bmi, date of_birth and gender
        Schema::table('profiles', function (Blueprint $table) {
            $table->double('weight')->nullable();
            $table->double('height')->nullable();
            $table->double('bmi')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['weight', 'height', 'bmi', 'date_of_birth', 'gender']);
        });
    }
};
