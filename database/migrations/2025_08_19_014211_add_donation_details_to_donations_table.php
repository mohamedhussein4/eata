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
        Schema::table('donations', function (Blueprint $table) {
            $table->string('donor_name')->nullable()->after('user_id');
            $table->string('donor_email')->nullable()->after('donor_name');
            $table->string('donor_phone')->nullable()->after('donor_email');
            $table->enum('payment_method', ['bank_account', 'e_wallet', 'cash'])->default('cash')->after('donor_phone');
            $table->unsignedBigInteger('bank_account_id')->nullable()->after('payment_method');
            $table->unsignedBigInteger('e_wallet_id')->nullable()->after('bank_account_id');
            $table->string('payment_proof')->nullable()->after('e_wallet_id');
            $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending')->after('payment_proof');
            $table->text('notes')->nullable()->after('status');

            // Foreign keys
            $table->foreign('bank_account_id')->references('id')->on('bank_accounts')->onDelete('set null');
            $table->foreign('e_wallet_id')->references('id')->on('e_wallets')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign(['bank_account_id']);
            $table->dropForeign(['e_wallet_id']);
            $table->dropColumn([
                'donor_name', 'donor_email', 'donor_phone', 'payment_method',
                'bank_account_id', 'e_wallet_id', 'payment_proof', 'status', 'notes'
            ]);
        });
    }
};
