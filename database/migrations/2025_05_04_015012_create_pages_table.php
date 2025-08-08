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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // عنوان الصفحة
            $table->string('slug')->unique(); // مسار الصفحة (URL)
            $table->longText('content'); // محتوى الصفحة
            $table->boolean('is_active')->default(true); // حالة الصفحة (نشطة/غير نشطة)
            $table->integer('sort_order')->default(0); // ترتيب الصفحة
            $table->string('meta_title')->nullable(); // عنوان الميتا لتحسين محركات البحث
            $table->text('meta_description')->nullable(); // وصف الميتا لتحسين محركات البحث
            $table->string('featured_image')->nullable(); // صورة الصفحة الرئيسية
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
