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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            $table->dateTime('application_date');

            $table->double('dose');

            $table->enum('unit', [
                'L_HA',
                'ML_HA',
                'KG_HA',
                'G_HA'
            ]);

            $table->double('area_applied');

            $table->enum('application_type', [
                'HERBICIDE',
                'FUNGICIDE',
                'INSECTICIDE',
                'FERTILIZER',
                'OTHER'
            ]);

            $table->string('responsible_technician');

            $table->text('notes')->nullable();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('field_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('crop_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
