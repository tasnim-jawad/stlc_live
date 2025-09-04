<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/PropertyManagement/Property/Database/create_properties_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('price')->nullable();
            $table->json('banner_image')->nullable();
            $table->bigInteger('property_group_id')->nullable();
            $table->bigInteger('property_category_id')->nullable();
            $table->enum('property_status', ['rent', 'sale'])->nullable();
            $table->datetime('date')->nullable();
            $table->string('property_name', 100)->nullable();
            $table->string('property_address', 100)->nullable();
            $table->text('property_description')->nullable();
            $table->text('property_detail')->nullable();
            $table->json('facts_and_features')->nullable();
            $table->json('gallery')->nullable();
            $table->json('amenities')->nullable();
            $table->json('floor_plan')->nullable();
            $table->json('floor_plan_details')->nullable();
            $table->string('property_video_url', 100)->nullable();
            $table->string('property_video_thmbnail', 100)->nullable();
            $table->text('map_location_url')->nullable();

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
        Schema::dropIfExists('properties');
    }
};
