<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('farm_id')->index();
            $table->foreign('farm_id')->references('id')->on('farms')->onDelete('restrict')->onUpdate('cascade');
            $table->string('serial_number')->unique();
            $table->string('model')->nullable();
            $table->string('manufacturer')->nullable();
            $table->date('installation_date');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared('
            CREATE TRIGGER turbines_before_insert
            BEFORE INSERT ON turbines
            FOR EACH ROW
            BEGIN
                SET NEW.uuid = UUID();
            END;
        ');
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
