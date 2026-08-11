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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->string('phone', 30)->nullable();
            $table->string('email')->nullable();

            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code', 20)->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->decimal('minimum_order_amount', 10, 2)->default(0);

            $table->unsignedTinyInteger('delivery_time_min')->nullable();
            $table->unsignedTinyInteger('delivery_time_max')->nullable();

            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['is_active', 'is_featured']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
