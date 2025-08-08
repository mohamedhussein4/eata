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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     // اسم الشخص
            $table->string('title')->nullable();        // المسمى الوظيفي أو اللقب
            $table->text('content');                    // محتوى الرأي
            $table->string('image')->nullable();        // صورة الشخص (اختياري)
            $table->integer('rating')->default(5);      // التقييم من 1 إلى 5
            $table->boolean('is_approved')->default(false); // حالة الموافقة
            $table->timestamp('approved_at')->nullable(); // تاريخ الموافقة
            $table->boolean('is_featured')->default(false); // مميز أم لا
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // ربط بالمستخدم (اختياري)
            $table->integer('order')->default(0);       // ترتيب العرض
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
