<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\services_table;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rendez_vous_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('medecin_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->dateTime('date_heure');
            $table->string('motif');
            $table->enum('type', ['normal', 'urgent'])->default('normal');
            $table->enum('statut', ['en_attente','confirme','annule','termine'])
                ->default('en_attente');
            $table->text('note_secretaire')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    protected $table = 'rendez_vous_tables'; // Important car ton nom de table finit par _tables

    
};
