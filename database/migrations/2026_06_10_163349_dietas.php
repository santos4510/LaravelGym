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
        Schema::create('dietas', function (Blueprint $table) {
            $table->id();
            $table->string('json')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('dieta_id')->nullable();
            $table->foreign('dieta_id')->references('id')->on('dietas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
