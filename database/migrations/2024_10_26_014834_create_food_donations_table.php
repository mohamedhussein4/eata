<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodDonationsTable extends Migration
{
    public function up()
    {
        Schema::create('food_donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('donation_type')->nullable();
            $table->boolean('is_available')->default(true);
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('status')->default('pending'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('food_donations');
    }
}
