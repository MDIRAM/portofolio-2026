<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page');
            $table->string('section')->nullable();
            $table->string('key');
            $table->string('label');
            $table->string('type')->default('text');
            $table->longText('value')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_locked')->default(false);
            $table->timestamps();

            $table->unique(['page', 'key']);
            $table->index(['page', 'section']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_contents');
    }
};
