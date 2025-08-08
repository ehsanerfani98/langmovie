<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->text('icon');
            $table->string('name');
            $table->integer('price');
            $table->integer('duration_days');
            $table->integer('daily_search_limit')->default(0);
            $table->integer('daily_segment_limit')->default(0);
            $table->unsignedTinyInteger('is_active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
