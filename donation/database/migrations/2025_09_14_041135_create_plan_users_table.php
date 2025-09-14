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
        Schema::create('plan_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained('plans')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        
            $table->date('start_date');
            $table->date('end_date')->nullable(); 
        
            $table->decimal('total_required', 12, 2); 
            $table->decimal('amount_paid', 12, 2)->default(0); 
            $table->decimal('amount_remaining', 12, 2)
                  ->virtualAs('GREATEST(total_required - amount_paid, 0)'); // no negatives
        
            $table->enum('status', ['active', 'completed', 'cancelled', 'replaced'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_users');
    }
};
