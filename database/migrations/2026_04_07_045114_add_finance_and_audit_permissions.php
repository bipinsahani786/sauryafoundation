<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Permission;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $permissions = [
            [
                'name' => 'view_finance',
                'label' => 'View Financial Ledger',
                'group' => 'Financial Management',
            ],
            [
                'name' => 'view_audit_logs',
                'label' => 'View System Audit Vault',
                'group' => 'System Audit',
            ],
        ];

        foreach ($permissions as $perm) {
            Permission::updateOrCreate(['name' => $perm['name']], $perm);
        }

        // Assign to Superadmin (ID 1)
        $superadmin = User::find(1);
        if ($superadmin) {
            $permissionIds = Permission::whereIn('name', ['view_finance', 'view_audit_logs'])->pluck('id');
            $superadmin->permissions()->syncWithoutDetaching($permissionIds);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Permission::whereIn('name', ['view_finance', 'view_audit_logs'])->delete();
    }
};
