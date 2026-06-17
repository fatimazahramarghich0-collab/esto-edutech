<?php

use App\Models\Module;
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
        Schema::create('module_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Module::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(Student::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->float('noteModule');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_grades');
    }
};
