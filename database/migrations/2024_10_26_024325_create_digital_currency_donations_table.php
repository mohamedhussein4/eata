<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDigitalCurrencyDonationsTable extends Migration
{
    /**
     * قم بتنفيذ الهجرة.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('digital_currency_donations', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_method', ['bank_account', 'e_wallet']);
            $table->unsignedBigInteger('bank_account_id')->nullable();
            $table->unsignedBigInteger('e_wallet_id')->nullable();
            $table->string('currency_type'); // نوع العملة
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('user_id');
            $table->timestamps(); 

            $table->foreign('bank_account_id')->references('id')->on('bank_accounts')->onDelete('set null');
            $table->foreign('e_wallet_id')->references('id')->on('e_wallets')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // ربط المستخدم بجدول المستخدمين
        });
    }

    /**
     * تراجع عن الهجرة.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('digital_currency_donations');
    }
}
