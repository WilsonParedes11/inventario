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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->string('reference');

            $table->foreignIdFor(\App\Models\Customer::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('customer_name');
            $table->integer('tax_percentage')->default(0);
            $table->double('tax_amount')->default(0);
            $table->integer('discount_percentage')->default(0);
            $table->double('discount_amount')->default(0);
            $table->double('shipping_amount')->default(0);
            $table->double('total_amount');
            $table->tinyInteger('status')->comment('0 - Pendiente / 1 - Completado / 2 - Cancelado');;
            $table->text('note')->nullable();
            $table->uuid();
            $table->foreignId("user_id")->constrained()->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
