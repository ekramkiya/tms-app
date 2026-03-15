<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\FormEntry;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormEntryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:FormEntry');
    }

    public function view(AuthUser $authUser, FormEntry $formEntry): bool
    {
        return $authUser->can('View:FormEntry');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:FormEntry');
    }

    public function update(AuthUser $authUser, FormEntry $formEntry): bool
    {
        return $authUser->can('Update:FormEntry');
    }

    public function delete(AuthUser $authUser, FormEntry $formEntry): bool
    {
        return $authUser->can('Delete:FormEntry');
    }

    public function restore(AuthUser $authUser, FormEntry $formEntry): bool
    {
        return $authUser->can('Restore:FormEntry');
    }

    public function forceDelete(AuthUser $authUser, FormEntry $formEntry): bool
    {
        return $authUser->can('ForceDelete:FormEntry');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:FormEntry');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:FormEntry');
    }

    public function replicate(AuthUser $authUser, FormEntry $formEntry): bool
    {
        return $authUser->can('Replicate:FormEntry');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:FormEntry');
    }

}