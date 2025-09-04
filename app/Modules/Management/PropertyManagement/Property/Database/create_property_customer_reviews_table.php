<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='\App\Modules\Management\PropertyManagement\Property\Database\create_property_customer_reviews_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('property_customer_reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('property_id')->nullable();
            $table->string('comment', 100)->nullable();
            $table->string('name', 100)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('website', 100)->nullable();
            $table->integer('rating')->nullable();

            $table->bigInteger('creator')->unsigned()->nullable();
            $table->string('slug', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_customer_reviews');
    }
};
