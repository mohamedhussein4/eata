<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create beneficiary_story_translations table if it doesn't exist
        if (!Schema::hasTable('beneficiary_story_translations')) {
            Schema::create('beneficiary_story_translations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('beneficiary_story_id')->constrained()->onDelete('cascade');
                $table->string('locale', 2); // ar, en
                $table->string('title')->nullable();
                $table->text('content')->nullable();
                $table->string('location')->nullable();
                $table->string('project_name')->nullable();
                $table->timestamps();

                $table->unique(['beneficiary_story_id', 'locale'], 'story_trans_unique');
                $table->index(['locale']);
            });
        }

        // Create setting_translations table if it doesn't exist
        if (!Schema::hasTable('setting_translations')) {
            Schema::create('setting_translations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('setting_id')->constrained()->onDelete('cascade');
                $table->string('locale', 2); // ar, en
                $table->string('site_name')->nullable();
                $table->string('address')->nullable();
                $table->text('copyright')->nullable();
                $table->text('footer_description')->nullable();
                $table->text('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->text('meta_keywords')->nullable();
                $table->timestamps();

                $table->unique(['setting_id', 'locale'], 'setting_trans_unique');
                $table->index(['locale']);
            });
        }

        // Add missing indexes to existing tables if they don't exist
        $this->addMissingIndexes();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiary_story_translations');
        Schema::dropIfExists('setting_translations');
    }

    /**
     * Add missing indexes to existing translation tables
     */
    private function addMissingIndexes(): void
    {
        // Add indexes to beneficiary_story_translations if table exists but indexes are missing
        if (Schema::hasTable('beneficiary_story_translations')) {
            try {
                Schema::table('beneficiary_story_translations', function (Blueprint $table) {
                    // Try to add foreign key if it doesn't exist
                    $table->foreign('beneficiary_story_id')->references('id')->on('beneficiary_stories')->onDelete('cascade');
                });
            } catch (\Exception $e) {
                // Foreign key might already exist, continue
            }

            try {
                Schema::table('beneficiary_story_translations', function (Blueprint $table) {
                    // Try to add unique constraint if it doesn't exist
                    $table->unique(['beneficiary_story_id', 'locale'], 'story_trans_unique');
                });
            } catch (\Exception $e) {
                // Unique constraint might already exist, continue
            }

            try {
                Schema::table('beneficiary_story_translations', function (Blueprint $table) {
                    // Try to add locale index if it doesn't exist
                    $table->index(['locale']);
                });
            } catch (\Exception $e) {
                // Index might already exist, continue
            }
        }

        // Add indexes to setting_translations if table exists but indexes are missing
        if (Schema::hasTable('setting_translations')) {
            try {
                Schema::table('setting_translations', function (Blueprint $table) {
                    $table->foreign('setting_id')->references('id')->on('settings')->onDelete('cascade');
                });
            } catch (\Exception $e) {
                // Foreign key might already exist, continue
            }

            try {
                Schema::table('setting_translations', function (Blueprint $table) {
                    $table->unique(['setting_id', 'locale'], 'setting_trans_unique');
                });
            } catch (\Exception $e) {
                // Unique constraint might already exist, continue
            }

            try {
                Schema::table('setting_translations', function (Blueprint $table) {
                    $table->index(['locale']);
                });
            } catch (\Exception $e) {
                // Index might already exist, continue
            }
        }
    }
};
