<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
