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
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->string('marital_status')->nullable();
            $table->integer('family_members_count')->nullable();
            $table->integer('children_under_10_count')->nullable();
            $table->text('critical_surgery_diseases')->nullable();
            $table->decimal('average_monthly_income', 10, 2)->nullable();
            $table->string('id_document')->nullable();
            $table->string('family_book')->nullable();
        });
    }

    public function down()
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->dropColumn([
                'marital_status',
                'family_members_count',
                'children_under_10_count',
                'critical_surgery_diseases',
                'average_monthly_income',
                'id_document',
                'family_book',
            ]);
        });
    }
};
