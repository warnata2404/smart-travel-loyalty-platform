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
        Schema::create('loyalty_rules', function (Blueprint $table): void {
            $table->id();

            $table->decimal('milestone_km', 8, 2);

            $table->decimal('discount_percentage', 5, 2);

            $table->enum('loyalty_rule_status', [
                'Active',
                'Inactive',
            ])->default('Active');

            $table->timestamps();

            $table->unique('milestone_km');

            $table->index('loyalty_rule_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loyalty_rules');
    }
};
