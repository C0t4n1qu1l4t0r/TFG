<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alergenos_platos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alergeno_id');
            $table->unsignedBigInteger('plato_id');
            $table->foreign('alergeno_id')->references('id')->on('alergenos')->onDelete('cascade');
            $table->foreign('plato_id')->references('id')->on('platos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alergenos_platos');
    }
};
