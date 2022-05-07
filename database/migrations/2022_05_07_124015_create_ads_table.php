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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description', 1200);
            $table->bigInteger('price')->default(0);
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->foreignId('city_id');
            $table->json('ad_attributes');
            $table->boolean("is_enable")->default(false);
            $table->boolean("is_confirmed")->default(false);
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
        Schema::dropIfExists('ads');
    }
};
