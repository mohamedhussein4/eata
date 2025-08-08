<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToDigitalCurrencyDonationsTable extends Migration
{
    public function up()
    {
        Schema::table('digital_currency_donations', function (Blueprint $table) {
            $table->string('status')->default('pending');
        });
    }

    public function down()
    {
        Schema::table('digital_currency_donations', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
