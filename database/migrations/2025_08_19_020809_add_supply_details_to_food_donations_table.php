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
        Schema::table('food_donations', function (Blueprint $table) {
            $table->string('supply_category')->nullable()->after('donation_type'); // نوع اللوازم الرئيسي (طعام، دواء، ملابس، إلخ)
            $table->string('supply_type')->nullable()->after('supply_category'); // تفاصيل النوع (أرز، باراسيتامول، قمصان، إلخ)
            $table->string('quantity')->nullable()->after('supply_type'); // الكمية
            $table->string('unit')->nullable()->after('quantity'); // وحدة القياس (كيلو، حبة، قطعة، إلخ)
            $table->text('description')->nullable()->after('unit'); // وصف إضافي
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food_donations', function (Blueprint $table) {
            $table->dropColumn(['supply_category', 'supply_type', 'quantity', 'unit', 'description']);
        });
    }
};
