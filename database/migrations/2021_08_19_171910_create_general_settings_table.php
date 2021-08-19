<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->default(1);
            $table->string('whatsapp', 255);
            $table->string('name', 255);
            $table->string('instagram', 255);
            $table->string('facebook', 255);
            $table->string('phone_number', 255);
            $table->string('image', 255)->nullable();
            $table->timestamps();
        });
       DB::statement('ALTER TABLE general_settings ADD CONSTRAINT CHECK (id = 1)');
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
