<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('turbines', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->unsignedBigInteger('farm_id')->index();
            $table->foreign('farm_id')->references('id')->on('farms')->onDelete('restrict')->onUpdate('cascade');
            $table->string('serial_number')->unique();
            $table->string('model');
            $table->string('manufacturer')->nullable();
            $table->date('instalation_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('turbines');
    }
};
