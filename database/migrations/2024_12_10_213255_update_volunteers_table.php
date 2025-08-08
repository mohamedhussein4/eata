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
        Schema::table('volunteers', function (Blueprint $table) {
            $table->text('charity_experience')->nullable();
            $table->string('academic_degree')->nullable();
            $table->string('id_document')->nullable();
            $table->string('cv')->nullable(); 
        });
    }

    public function down()
    {
        Schema::table('volunteers', function (Blueprint $table) {
            $table->dropColumn(['charity_experience', 'academic_degree', 'id_document', 'cv']);
        });
    }
    };
