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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Ex: "Formatura 9º Ano - Escola X"
        
        // Relacionamento com a escola (Chave Estrangeira)
        $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
        
        // Destinos fixos do sistema
        $table->enum('destination', ['PETAR', 'City Tour em Santos', 'Paranapiacaba']);
        
        // Status do projeto
        $table->enum('status', ['em_andamento', 'concluido'])->default('em_andamento');
        
        $table->date('event_date')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
