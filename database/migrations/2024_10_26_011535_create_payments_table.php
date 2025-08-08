<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('cart_total', 10, 2);
            $table->enum('payment_method', ['bank_account', 'e_wallet']);
            $table->foreignId('account_bank_id')->nullable()->constrained('bank_accounts')->onDelete('set null');
            $table->foreignId('e_wallet_id')->nullable()->constrained('e_wallets')->onDelete('set null');
            $table->string('confirmation_document')->nullable();
            $table->enum('status', ['pending', 'completed', 'rejected', 'processing'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
