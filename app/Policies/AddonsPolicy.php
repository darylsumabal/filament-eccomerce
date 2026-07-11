<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Addons;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class AddonsPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Addons');
    }

    public function view(AuthUser $authUser, Addons $addons): bool
    {
        return $authUser->can('View:Addons');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Addons');
    }

    public function update(AuthUser $authUser, Addons $addons): bool
    {
        return $authUser->can('Update:Addons');
    }

    public function delete(AuthUser $authUser, Addons $addons): bool
    {
        return $authUser->can('Delete:Addons');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Addons');
    }

    public function restore(AuthUser $authUser, Addons $addons): bool
    {
        return $authUser->can('Restore:Addons');
    }

    public function forceDelete(AuthUser $authUser, Addons $addons): bool
    {
        return $authUser->can('ForceDelete:Addons');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Addons');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Addons');
    }

    public function replicate(AuthUser $authUser, Addons $addons): bool
    {
        return $authUser->can('Replicate:Addons');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Addons');
    }
}
