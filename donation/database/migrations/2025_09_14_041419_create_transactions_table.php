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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_user_id')->constrained('plan_users')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        
            $table->decimal('amount', 12, 2); // allows overpayment
            $table->enum('payment_method', ['online','offline'])->default('offline');
            $table->enum('status', ['pending', 'success', 'failed', 'refunded'])->default('pending');
        
            $table->dateTime('transaction_date')->useCurrent();
            $table->string('reference_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
