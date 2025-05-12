<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('photo')->nullable();
        $table->string('nom');
        $table->string('prenom');
        $table->string('statut')->nullable();
        $table->string('email')->nullable();
        $table->string('telephone')->nullable();
        $table->string('adresse')->nullable();
        $table->string('specialite')->nullable();
        $table->text('reseaux_sociaux')->nullable();
        $table->text('biographie')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
