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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->char('no_reg',30);
            $table->char('no_identity',30);
            $table->char('name',100);
            $table->char('gender',10)->nullable();
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->char('email',255)->nullable();
            $table->char('education',255)->nullable();
            $table->char('date_of_birth',30)->nullable();
            $table->char('phone',20)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
};
