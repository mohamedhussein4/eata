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
        // جدول النقاط
        Schema::create('reward_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('points');
            $table->enum('donation_type', [
                'food_donation',
                'regular_donation',
                'sms_donation',
                'digital_currency_donation',
                'sms_record'
            ]);
            $table->decimal('donation_amount', 10, 2)->nullable();
            $table->string('description')->nullable();
            $table->morphs('donatable'); // للربط مع جداول التبرع المختلفة
            $table->timestamps();
        });

        // جدول إعدادات النقاط
        Schema::create('point_settings', function (Blueprint $table) {
            $table->id();
            $table->string('donation_type');
            $table->integer('points_per_amount');
            $table->decimal('amount_threshold', 10, 2);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_points');
        Schema::dropIfExists('point_settings');
    }
};
