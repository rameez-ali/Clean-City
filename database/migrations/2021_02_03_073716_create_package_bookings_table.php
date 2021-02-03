<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->integer('user_id');
            $table->string('status')->default('pending');
            $table->string('selected_date');
            $table->string('time_required');
            $table->string('time_slot');
            $table->string('area');
            $table->string('recurrency');
            $table->string('quote')->nullable();
            $table->string('reason')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
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
        Schema::dropIfExists('package_bookings');
    }
}
