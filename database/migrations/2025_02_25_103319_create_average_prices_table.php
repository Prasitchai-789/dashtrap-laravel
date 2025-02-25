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
        Schema::create('average_prices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('price_font');
            $table->float('price_isp');
            $table->float('price_ssg_sakon');
            $table->float('price_app');
            $table->float('price_ssg_chon');
            $table->float('price_sang');
            $table->float('price_see');
            $table->float('price_wijit');
            $table->float('price_uni');
            $table->float('price_chaw');
            $table->string('remark');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('average_prices');
    }
};
