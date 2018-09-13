<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('config_key');
            $table->string('config_val');
            $table->string('data_type');
            $table->string('resource_class')->nullable();
            $table->string('label');
            $table->boolean('allow_null')->default(1);
            $table->string('roles');
            $table->text('description')->nullable();

            $table->timestamps();

            $table->engine = 'InnoDB';

            $table->index('config_key');
            $table->unique(['config_key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
