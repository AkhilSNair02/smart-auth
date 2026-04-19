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
        Schema::create('otps', function (Blueprint $table) {
            $table->id();

            // Link to users table
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // 6-digit OTP
            $table->string('otp_code');

            // Type of OTP (registration or password reset)
            $table->enum('type', ['register', 'reset']);

            // Expiry time (important for security)
            $table->timestamp('expires_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otps');
    }
};