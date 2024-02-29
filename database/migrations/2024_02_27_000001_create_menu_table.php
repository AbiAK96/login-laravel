<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('api_id')->nullable()->default(null);
            $table->string('name');
            $table->string('category');
            $table->decimal('price', 5,2);
            $table->string('description')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->integer('qty')->nullable()->default(0);
            $table->boolean('is_veg')->nullable()->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
