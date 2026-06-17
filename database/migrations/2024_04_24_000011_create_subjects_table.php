<?php

use App\Models\Module;
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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Module::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(Teacher::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->float('coefficient');
            $table->integer('nb_cm');
            $table->integer('nb_td');
            $table->integer('nb_tp');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
