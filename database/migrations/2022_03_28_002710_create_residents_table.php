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
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();

            $table->integer('zone_id');

            $table->string('gender');
            $table->date('birthday');
            $table->string('email_address')->nullable();
            $table->string('address')->nullable();
            $table->string('occupation')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('precinct')->nullable();
            
            $table->softDeletes();
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
        Schema::dropIfExists('residents');
    }
};
