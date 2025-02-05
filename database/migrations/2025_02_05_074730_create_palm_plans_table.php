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
        Schema::create('palm_plans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('list_plan');
            $table->integer('palm_plan');
            $table->integer('actual_plan');
            $table->float('per_plan');
            $table->string('remark_plan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('palm_plans');
    }
};
