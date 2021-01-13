<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dinners', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start');
            $table->timestamp('end'); 
            $table->string('title');
            $table->string('description')->nullable();
            $table->tinyInteger('max_members');
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
        Schema::dropIfExists('dinners');
    }
}
