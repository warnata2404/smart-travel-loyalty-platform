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
        Schema::create('routes', function (Blueprint $table): void {
            $table->id();

            $table->foreignId('origin_destination_id')
                ->constrained('destinations')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('destination_destination_id')
                ->constrained('destinations')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->decimal('distance_km', 8, 2)->default(0);

            $table->unsignedInteger('estimated_duration_minutes')
                ->default(0);

            $table->decimal('base_price', 12, 2)
                ->default(0);

            $table->enum('route_status', [
                'Active',
                'Inactive',
            ])->default('Active');

            $table->timestamps();

            $table->unique([
                'origin_destination_id',
                'destination_destination_id',
            ], 'routes_origin_destination_unique');

            $table->index('origin_destination_id');

            $table->index('destination_destination_id');

            $table->index('route_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
