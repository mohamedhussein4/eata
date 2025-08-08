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
        // إضافة عمود status إلى جدول projects
        if (!Schema::hasColumn('projects', 'status')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->enum('status', ['active', 'inactive', 'completed'])->default('active');
            });
        }

        // إضافة عمود status إلى جدول tickets
        if (!Schema::hasColumn('tickets', 'status')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->enum('status', ['open', 'closed', 'pending'])->default('open');
            });
        }

        // إضافة عمود status إلى جدول orders
        if (!Schema::hasColumn('orders', 'status')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            });
        }

        // إضافة عمود status إلى جدول payments
        if (!Schema::hasColumn('payments', 'status')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            });
        }

        // إضافة عمود status إلى جدول food_donations
        if (!Schema::hasColumn('food_donations', 'status')) {
            Schema::table('food_donations', function (Blueprint $table) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            });
        }

        // إضافة عمود status إلى جدول digital_currency_donations
        if (!Schema::hasColumn('digital_currency_donations', 'status')) {
            Schema::table('digital_currency_donations', function (Blueprint $table) {
                $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            });
        }

        // إضافة عمود status إلى جدول sms_donations
        if (!Schema::hasColumn('sms_donations', 'status')) {
            Schema::table('sms_donations', function (Blueprint $table) {
                $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            });
        }

        // إضافة عمود status إلى جدول sms_donation_records
        if (!Schema::hasColumn('sms_donation_records', 'status')) {
            Schema::table('sms_donation_records', function (Blueprint $table) {
                $table->enum('status', ['pending', 'verified', 'invalid'])->default('pending');
            });
        }

        // إضافة عمود status إلى جدول pages
        if (!Schema::hasColumn('pages', 'status')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'projects',
            'tickets',
            'orders',
            'payments',
            'food_donations',
            'digital_currency_donations',
            'sms_donations',
            'sms_donation_records',
            'pages'
        ];

        foreach ($tables as $table) {
            if (Schema::hasColumn($table, 'status')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropColumn('status');
                });
            }
        }
    }
};
