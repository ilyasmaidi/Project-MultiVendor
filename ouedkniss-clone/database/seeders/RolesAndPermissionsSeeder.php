<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User permissions
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Store permissions
            'view stores',
            'create stores',
            'edit stores',
            'delete stores',

            // Ad permissions
            'view ads',
            'create ads',
            'edit ads',
            'delete ads',
            'approve ads',

            // Category permissions
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            // Settings permissions
            'view settings',
            'edit settings',

            // Staff permissions
            'manage staff',
            'view staff',

            // Statistics permissions
            'view statistics',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $vendorRole = Role::create(['name' => 'vendor']);
        $vendorRole->givePermissionTo([
            'view stores',
            'create stores',
            'edit stores',
            'view ads',
            'create ads',
            'edit ads',
            'delete ads',
            'view categories',
            'manage staff',
            'view staff',
            'view statistics',
        ]);

        $staffRole = Role::create(['name' => 'staff']);
        $staffRole->givePermissionTo([
            'view ads',
            'create ads',
            'edit ads',
            'view stores',
        ]);

        $buyerRole = Role::create(['name' => 'buyer']);
        $buyerRole->givePermissionTo([
            'view ads',
        ]);

        // Create default admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@ouedkniss.clone',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);
        $admin->assignRole('admin');

        // Create default vendor user
        $vendor = User::create([
            'name' => 'Vendor',
            'email' => 'vendor@ouedkniss.clone',
            'password' => bcrypt('password'),
            'role' => 'vendor',
            'is_active' => true,
        ]);
        $vendor->assignRole('vendor');

        $this->command->info('Roles and permissions created successfully!');
        $this->command->info('Admin: admin@ouedkniss.clone / password');
        $this->command->info('Vendor: vendor@ouedkniss.clone / password');
    }
}
