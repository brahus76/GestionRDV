<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class services_table extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * On y met 'nom' et 'description' car ce sont tes champs personnalisés.
     */
    protected $fillable = [
        'nom',
        'description',
    ];
    protected $table = 'services';

    /**
     * Relation : Un service possède plusieurs utilisateurs (médecins, secrétaires, etc.)
     * Cela te permettra de faire : $service->users
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'service_id');
    }

    /**
     * Relation spécifique : Récupérer uniquement les médecins d'un service
     * Très utile pour ton application Clinic App
     */
    public function medecins(): HasMany
    {
        return $this->hasMany(User::class, 'service_id')
                    ->where('role', 'medecin');
    }
}
