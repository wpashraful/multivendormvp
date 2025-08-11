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
        // Schema::create('coupons', function (Blueprint $table) {
        //     $table->id();
            
        //     $table->timestamps();
        // });

        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();

            // Discount details
            $table->decimal('discount_amount', 10, 2)->nullable();
            $table->enum('discount_type', ['fixed', 'percent'])->default('fixed');

            // Validity period
            $table->dateTime('valid_from')->nullable();
            $table->dateTime('expires_at')->nullable();

            // Usage limits
            $table->integer('max_usage')->default(1);
            $table->integer('used_count')->default(0);

            // Status
            $table->boolean('is_active')->default(true);

            // Tracking
            $table->dateTime('last_used_at')->nullable();

            // Relationships
            $table->foreignId('lottery_id')->nullable()->constrained('lotteries')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();

            // Index for performance
            $table->index(['code', 'lottery_id', 'is_active']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
