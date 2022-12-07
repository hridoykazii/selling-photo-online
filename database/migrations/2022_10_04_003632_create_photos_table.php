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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('details');
            $table->string('image');
            $table->unsignedBigInteger('approve_by')->nullable();
            $table->dateTime('approve_date')->nullable();
            $table->unsignedBigInteger('buyout_by')->nullable();
            $table->dateTime('buyout_date')->nullable();
            $table->float('rate')->nullable();
            $table->enum('status',['pending','approved','rejected','selling','buy-out'])->default('pending');
            $table->timestamps();

           $table->foreign('approve_by')->references('id')->on('admins')->onDelete('cascade');
           $table->foreign('buyout_by')->references('id')->on('admins')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
};
