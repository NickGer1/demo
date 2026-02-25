<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['new', 'approved', 'rejected'])->default('new');
            $table->date('date');
            $table->string('place');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
