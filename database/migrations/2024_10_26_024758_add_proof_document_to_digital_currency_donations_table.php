<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('digital_currency_donations', function (Blueprint $table) {
            $table->string('proof_document')->nullable(); // عمود جديد لتخزين مسار المستند
        });
    }

    public function down()
    {
        Schema::table('digital_currency_donations', function (Blueprint $table) {
            $table->dropColumn('proof_document');
        });
    }
};
