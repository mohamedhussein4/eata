<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->decimal('remaining_amount', 10, 2)->default(0);
            $table->string('status')->default('P' . mt_rand(10000, 99999)); // توليد رقم الحالة عشوائياً
            $table->string('image_or_video')->nullable(); // لرابط الصورة أو الفيديو
            $table->integer('visits')->default(0); // عدد الزيارات
            $table->integer('donation_count')->default(0); // عدد عمليات التبرع
            $table->integer('beneficiaries_count')->default(0); // عدد المستفيدين
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
