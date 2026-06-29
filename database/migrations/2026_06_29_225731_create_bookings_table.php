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
        Schema::create('bookings', function (Blueprint $table): void {
            /*
            |--------------------------------------------------------------------------
            | Identity
            |--------------------------------------------------------------------------
            */
            $table->id();

            $table->string('booking_code', 30)->unique();

            /*
            |--------------------------------------------------------------------------
            | Foreign Keys
            |--------------------------------------------------------------------------
            */
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('route_id')
                ->constrained('routes')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Travel Snapshot
            |--------------------------------------------------------------------------
            */
            $table->enum('travel_category', [
                'Indoor',
                'Outdoor',
            ]);

            $table->string('origin_name', 100);

            $table->string('destination_name', 100);

            $table->timestamp('departure_datetime');

            $table->decimal('estimated_distance_km', 8, 2)->default(0);

            $table->unsignedInteger('estimated_duration_minutes')->default(0);

            $table->timestamp('estimated_arrival_datetime');

            $table->decimal('base_price', 12, 2)->default(0);

            $table->decimal('discount_percentage', 5, 2)->default(0);

            $table->decimal('discount_amount', 12, 2)->default(0);

            $table->decimal('final_price', 12, 2)->default(0);

            /*
            |--------------------------------------------------------------------------
            | Payment
            |--------------------------------------------------------------------------
            */
            $table->string('payment_proof_path', 255)->nullable();

            $table->timestamp('payment_uploaded_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */
            $table->enum('booking_status', [
                'Pending',
                'Paid',
                'Completed',
                'Cancelled',
            ])->default('Pending');

            /*
            |--------------------------------------------------------------------------
            | Audit
            |--------------------------------------------------------------------------
            */
            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */

            $table->index('user_id');

            $table->index('route_id');

            $table->index('booking_status');

            $table->index('departure_datetime');

            $table->index('estimated_arrival_datetime');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
