<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId("user_id")->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->string('code');
            //$table->string('product_barcode_symbology')->nullable();
            $table->integer('quantity');
            $table->double('buying_price')->comment('Buying Price');
            $table->double('selling_price')->comment('Selling Price');
            $table->integer('quantity_alert');
            $table->double('tax')->nullable();
            $table->tinyInteger('tax_type')->nullable();
            $table->text('notes')->nullable();

            $table->string('product_image')->nullable();

            $table->foreignIdFor(\App\Models\Category::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignIdFor(\App\Models\Unit::class)->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
