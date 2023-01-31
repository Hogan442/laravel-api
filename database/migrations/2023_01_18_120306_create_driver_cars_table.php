<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->unique()
                ->constrained('drivers')
                ->cascadeOnDelete();
            $table->foreignId('car_id')->unique()
                ->nullable()
                ->constrained('cars');
            $table->string('license_plate', 7)->unique();
            $table->boolean('insured');
            $table->year('last_service');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_cars');
    }
}
