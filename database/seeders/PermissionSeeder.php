<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            'User Management' => [
                ['name' => 'view_users', 'label' => 'View Users'],
                ['name' => 'create_users', 'label' => 'Create Users'],
                ['name' => 'edit_users', 'label' => 'Edit Users'],
                ['name' => 'delete_users', 'label' => 'Delete Users'],
                ['name' => 'impersonate_users', 'label' => 'Impersonate Users'],
            ],
            'Plan Management' => [
                ['name' => 'view_plans', 'label' => 'View Plans'],
                ['name' => 'create_plans', 'label' => 'Create Plans'],
                ['name' => 'edit_plans', 'label' => 'Edit Plans'],
                ['name' => 'delete_plans', 'label' => 'Delete Plans'],
                ['name' => 'approve_payments', 'label' => 'Approve Payments'],
            ],
            'Banner & Sector' => [
                ['name' => 'view_banners', 'label' => 'View Banners'],
                ['name' => 'create_banners', 'label' => 'Create Banners'],
                ['name' => 'edit_banners', 'label' => 'Edit Banners'],
                ['name' => 'delete_banners', 'label' => 'Delete Banners'],
                ['name' => 'view_sectors', 'label' => 'View Sectors'],
                ['name' => 'create_sectors', 'label' => 'Create Sectors'],
                ['name' => 'edit_sectors', 'label' => 'Edit Sectors'],
                ['name' => 'delete_sectors', 'label' => 'Delete Sectors'],
            ],
            'Applications & Leads' => [
                ['name' => 'view_applications', 'label' => 'View Applications'],
                ['name' => 'delete_applications', 'label' => 'Delete Applications'],
            ],
            'Payouts & KYC' => [
                ['name' => 'view_payouts', 'label' => 'View Payouts'],
                ['name' => 'verify_kyc', 'label' => 'Verify KYC'],
                ['name' => 'approve_payouts', 'label' => 'Approve Payouts'],
            ],
            'Exam Center' => [
                ['name' => 'view_exams', 'label' => 'View Exams'],
                ['name' => 'create_exams', 'label' => 'Create Exams'],
                ['name' => 'edit_exams', 'label' => 'Edit Exams'],
                ['name' => 'delete_exams', 'label' => 'Delete Exams'],
                ['name' => 'approve_exams', 'label' => 'Approve Teacher Exams'],
                ['name' => 'publish_exams', 'label' => 'Publish/Promote Exams'],
            ],
            'Academic Classes' => [
                ['name' => 'view_classes', 'label' => 'View Classes'],
                ['name' => 'create_classes', 'label' => 'Create Classes'],
                ['name' => 'edit_classes', 'label' => 'Edit Classes'],
                ['name' => 'delete_classes', 'label' => 'Delete Classes'],
            ],
            'Site Settings' => [
                ['name' => 'view_settings', 'label' => 'View Settings'],
                ['name' => 'update_settings', 'label' => 'Update Settings'],
            ],
            'Wallet Adjustments' => [
                ['name' => 'view_wallet', 'label' => 'View Wallet Dashboard'],
                ['name' => 'credit_wallet', 'label' => 'Manual Credit (+)'],
                ['name' => 'debit_wallet', 'label' => 'Manual Debit (-)'],
                ['name' => 'view_topup_requests', 'label' => 'View Top-up Requests'],
                ['name' => 'approve_topup_requests', 'label' => 'Approve Top-up Requests'],
            ],
            'Dynamic Content' => [
                ['name' => 'view_testimonials', 'label' => 'View Testimonials'],
                ['name' => 'create_testimonials', 'label' => 'Create Testimonials'],
                ['name' => 'edit_testimonials', 'label' => 'Edit Testimonials'],
                ['name' => 'delete_testimonials', 'label' => 'Delete Testimonials'],
                ['name' => 'view_industry_experts', 'label' => 'View Industry Experts'],
                ['name' => 'create_industry_experts', 'label' => 'Create Industry Experts'],
                ['name' => 'edit_industry_experts', 'label' => 'Edit Industry Experts'],
                ['name' => 'delete_industry_experts', 'label' => 'Delete Industry Experts'],
            ],
            'Payments & Subscriptions' => [
                ['name' => 'view_subscriptions', 'label' => 'View Subscriptions/Payments'],
                ['name' => 'approve_payments', 'label' => 'Approve/Reject Payments'],
            ],
        ];

        foreach ($groups as $groupName => $permissions) {
            foreach ($permissions as $permission) {
                Permission::updateOrCreate(
                    ['name' => $permission['name']],
                    [
                        'label' => $permission['label'],
                        'group' => $groupName, // I'll add this column via migration to help grouping in UI
                    ]
                );
            }
        }
    }
}
