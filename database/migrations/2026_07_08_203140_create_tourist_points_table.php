<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('tourist_points', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('price_per_person', 10, 2);
        $table->string('image')->nullable();
        
        // Os 8 atributos de Endereço/Acesso
        $table->string('cep')->nullable();
        $table->string('logradouro')->nullable();
        $table->string('numero')->nullable();
        $table->string('complemento')->nullable();
        $table->string('bairro')->nullable();
        $table->string('cidade')->nullable();
        $table->string('estado', 2)->nullable();

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('tourist_points');
    }
};