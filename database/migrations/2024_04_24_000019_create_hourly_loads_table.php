<?php

use App\Models\Teacher;
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
        Schema::create('hourly_loads', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Teacher::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->float('charge');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hourly_loads');
    }
};
