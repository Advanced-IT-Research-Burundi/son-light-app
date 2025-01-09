<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'company_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Vérifie si l'utilisateur a un rôle d'administrateur.
     */
    public function isAdmin()
    {
        return $this->role()->where('name', 'Administrateur')->exists();
    }

    /**
     * Vérifie si l'utilisateur a un rôle d'employé.
     */
    public function isEmployee()
    {
        return $this->role()->where('name', 'Employé')->exists();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Récupère les reçus créés par l'utilisateur.
     */
    public function createdReceipts()
    {
        return $this->hasMany(CashRegisterReceipt::class, 'user_id');
    }

    /**
     * Récupère les reçus approuvés par l'utilisateur.
     */
    public function approvedReceipts()
    {
        return $this->hasMany(CashRegisterReceipt::class, 'approbation_id');
    }

    /**
     * Récupère les reçus demandés par l'utilisateur.
     */
    public function requestedReceipts()
    {
        return $this->hasMany(CashRegisterReceipt::class, 'requerant_id');
    }

    /**
     * Récupère les caisses créées par cet utilisateur.
     */
    public function createdCashRegisters()
    {
        return $this->hasMany(CashRegister::class, 'created_by');
    }

    /**
     * Récupère les caisses mises à jour par cet utilisateur.
     */
    public function updatedCashRegisters()
    {
        return $this->hasMany(CashRegister::class, 'updated_by');
    }
}
