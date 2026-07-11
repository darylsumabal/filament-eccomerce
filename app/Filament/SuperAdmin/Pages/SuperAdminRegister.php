<?php

namespace App\Filament\SuperAdmin\Pages;

use Filament\Auth\Pages\Register;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class SuperAdminRegister extends Register
{
    protected function handleRegistration(array $data): Model
    {
        $user = parent::handleRegistration($data);

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);

        $user->assignRole($superAdminRole);

        return $user;
    }
}
