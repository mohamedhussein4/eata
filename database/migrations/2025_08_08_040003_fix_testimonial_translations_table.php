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
        Schema::table('testimonial_translations', function (Blueprint $table) {
            if (!Schema::hasColumn('testimonial_translations', 'testimonial_id')) {
                $table->foreignId('testimonial_id')->after('id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('testimonial_translations', 'locale')) {
                $table->string('locale', 2)->after('testimonial_id');
            }
            if (!Schema::hasColumn('testimonial_translations', 'name')) {
                $table->string('name')->after('locale');
            }
            if (!Schema::hasColumn('testimonial_translations', 'content')) {
                $table->text('content')->nullable()->after('name');
            }

            // إضافة فهرس مركب فريد
            if (!Schema::hasIndex('testimonial_translations', 'testimonial_translations_testimonial_id_locale_unique')) {
                $table->unique(['testimonial_id', 'locale'], 'testimonial_translations_testimonial_id_locale_unique');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonial_translations', function (Blueprint $table) {
            $table->dropUnique('testimonial_translations_testimonial_id_locale_unique');
            $table->dropForeign(['testimonial_id']);
            $table->dropColumn(['testimonial_id', 'locale', 'name', 'content']);
        });
    }
};
