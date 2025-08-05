<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les permissions pour Admin
        $adminPermissions = [
            'manage-users',
            'approve-listings',
            'view-all-bookings',
            'manage-payments',
            'view-analytics',
            'manage-settings',
        ];

        // Créer les permissions pour Host
        $hostPermissions = [
            'create-listing',
            'edit-own-listing',
            'delete-own-listing',
            'view-own-bookings',
            'manage-calendar',
            'respond-messages',
        ];

        // Créer les permissions pour Client
        $clientPermissions = [
            'create-booking',
            'view-own-bookings',
            'cancel-booking',
            'send-messages',
            'leave-reviews',
            'update-profile',
        ];

        // Créer toutes les permissions
        foreach (array_merge($adminPermissions, $hostPermissions, $clientPermissions) as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Assigner les permissions aux rôles
        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo($adminPermissions);

        $hostRole = Role::findByName('host');
        $hostRole->givePermissionTo($hostPermissions);

        $clientRole = Role::findByName('client');
        $clientRole->givePermissionTo($clientPermissions);
    }
}
