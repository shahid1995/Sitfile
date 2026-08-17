<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrudBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crud_banner', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banner_name', 100)->nullable();;
            $table->text('description')->nullable();;
            $table->string('image_name', 130)->nullable();;
            $table->enum('status', ['ACTIVE', 'INACTIVE']);
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
        Schema::dropIfExists('crud_banner');
    }
}
