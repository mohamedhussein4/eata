<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrencyTypeAndWalletLinkToEWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('e_wallets', function (Blueprint $table) {
            $table->string('currency_type', 50)->nullable();
            $table->string('wallet_link')->nullable()->after('currency_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('e_wallets', function (Blueprint $table) {
            $table->dropColumn('currency_type');
            $table->dropColumn('wallet_link');
        });
    }
}
