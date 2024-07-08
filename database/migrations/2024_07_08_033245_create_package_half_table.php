<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageHalfTable extends Migration
{
    public function up()
    {
        Schema::create('package_half', function (Blueprint $table) {
            $table->id();
            $table->string('name_uz_one');
            $table->string('name_uz_two');
            $table->foreignId('left_product_id')->constrained('products');
            $table->foreignId('right_product_id')->constrained('products');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('package_half');
    }
}

