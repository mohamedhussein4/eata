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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('المستخدم المستهدف');
            $table->string('type')->nullable()->comment('نوع الإشعار');
            $table->string('title')->comment('عنوان الإشعار');
            $table->text('message')->comment('تفاصيل الإشعار');
            $table->boolean('is_read')->default(false)->comment('حالة القراءة');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
