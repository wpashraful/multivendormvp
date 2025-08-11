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
        Schema::create('lotteries', function (Blueprint $table) {
            // $table->id();
            // $table->string('title');
            // $table->text('description')->nullable();
            // $table->decimal('ticket_price', 10, 2)->default(0);
            // $table->unsignedInteger('total_tickets')->default(0);
            // $table->unsignedInteger('sold_tickets')->default(0);
            // $table->dateTime('start_date');
            // $table->dateTime('end_date');
            // $table->boolean('is_active')->default(true);

            // // Foreign keys
            // $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('cascade');
            // $table->foreignId('vendor_id')->nullable()->constrained('vendors')->onDelete('cascade');
            // $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');

            // $table->timestamps();

            // $table->index(['is_active', 'start_date']);

            //do not uncomment this 
            $table->id();
            $table->string('title');
            
            $table->text('description')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();

            // Foreign key constraint
            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->timestamps();

            // Optional: Add index for better performance on frequently queried columns
            $table->index(['is_active', 'start_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotteries');
    }
};
