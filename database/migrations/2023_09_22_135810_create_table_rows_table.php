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
        Schema::create('table_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_id');
            $table->foreignId('user_id');
            $table->timestamps();
            $table->date('date');
            $table->string('name');
            $table->enum('state', ['Neuf', 'Occasion', 'A réparer']);
            $table->integer('quantity');
            $table->float('price', 9, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_rows');
    }
};
