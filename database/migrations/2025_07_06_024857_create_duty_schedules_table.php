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
    Schema::create('duty_schedules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('nurse_id')->constrained()->onDelete('cascade');
        $table->date('duty_date');
        $table->enum('shift', ['Morning', 'Afternoon', 'Night']);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duty_schedules');
    }
};
