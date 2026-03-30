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
        'role',
        'telephone',
        'tenant_id',
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

    // --- Helpers de rôles ---
    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    public function isAdminEcole(): bool
    {
        return $this->role === 'admin_ecole';
    }

    public function isCenseur(): bool
    {
        return $this->role === 'censeur';
    }

    public function isEnseignant(): bool
    {
        return $this->role === 'enseignant';
    }

    public function isParent(): bool
    {
        return $this->role === 'parent';
    }

    public function hasRole(string|array $roles): bool
    {
        return in_array($this->role, (array) $roles);
    }
}