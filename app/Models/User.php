<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\rendez_vous_table;
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    /*protected $fillable = [
        'name',
        'email',
        'password',
    ];*/
    // Dans app/Models/User.php
    protected $fillable = [
        'name', 'prenom', 'email', 'password', 'role', 'matricule', 'specialite'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function service()
    {
        return $this->belongsTo(services_table::class, 'service_id');
    }

    public function rendezvousAsMedecin()
    {
    // On lie l'ID du médecin à la colonne 'medecin_id' de la table rendez-vous
        return $this->hasMany(rendez_vous_table::class, 'medecin_id');
    }
}
