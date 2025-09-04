<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     php artisan migrate --path='/app/Modules/Management/TodaySellsManagement/TodaySells/Database/create_today_sells_table.php'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('today_sells', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->nullable();
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->json('key_features')->nullable();
            $table->string('video_url', 100)->nullable();
            $table->json('image_gallery_left')->nullable();
            $table->json('image_gallery_right')->nullable();

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
        Schema::dropIfExists('today_sells');
    }
};