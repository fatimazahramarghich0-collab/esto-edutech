<?php

use App\Models\Semester;
use App\Models\Student;
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
        Schema::create('semester_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Semester::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(Student::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->float('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semester_grades');
    }
};
