<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'nom_ecole',
            'logo',
            'adresse',
            'telephone',
            'email_ecole',
            'ville',
            'region',
            'type_ecole',    // lycee, college, ...
            'abonnement',    // basic, premium
            'actif',
        ];
    }
}