<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusItemsTable extends Migration
{
    public function up()
    {
        Schema::create('bonus_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bonus_id');
            $table->foreign('bonus_id')->references('id')->on('bonuses')->onDelete('cascade');
            $table->string('position_id');
            $table->string('name_ru');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bonus_items');
    }
}
