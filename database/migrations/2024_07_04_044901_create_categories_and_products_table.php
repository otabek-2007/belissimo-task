<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_uz');
            $table->string('name_ru');
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->boolean('has_subcategory')->default(0);
            $table->boolean('is_pizza')->default(0);
            $table->string('photo')->nullable();
            $table->string('link')->nullable();
            $table->integer('position')->default(0);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('name_uz');
            $table->string('name_ru');
            $table->text('description_uz')->nullable();
            $table->text('description_ru')->nullable();
            $table->float('price_small')->nullable();
            $table->float('price_medium')->nullable();
            $table->float('price_big')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('in_stock')->default(1);
            $table->boolean('is_pizza')->default(0);
            $table->string('code')->nullable();
            $table->string('package_code')->nullable();
            $table->float('vat_percent')->nullable();
            $table->integer('position')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};
