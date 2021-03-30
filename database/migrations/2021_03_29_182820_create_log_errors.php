<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogErrors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_errors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->default(0);
            $table->text('exception')->nuallable();
            $table->text('message')->nuallable();
            $table->integer('line')->nuallable();
            $table->json('trace')->nuallable();
            $table->string('method')->nuallable();
            $table->json('params')->nuallable();
            $table->text('uri')->nuallable();
            $table->text('user_agent')->nuallable();
            $table->json('header')->nuallable();
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
        Schema::dropIfExists('log_errors');
    }
}
