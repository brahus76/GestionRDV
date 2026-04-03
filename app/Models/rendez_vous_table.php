<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class rendez_vous_table extends Model
{
    
    protected $table = 'rendez_vous_tables';
    protected $fillable = [
        'patient_id',
        'medecin_id',
        'service_id',
        'date_heure',
        'motif',
        'statut',
        'type'
    ];

    use HasFactory;

    public function patient() {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function medecin() {
        return $this->belongsTo(User::class, 'medecin_id');
    }

    public function service() {
        return $this->belongsTo(services_table::class, 'service_id');
    }
    public function down(): void
    {
        Schema::dropIfExists('rendez_vous_tables');
    }
}


