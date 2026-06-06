<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use App\Models\AdminRole;
use App\Models\AdminPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminPortalSeeder extends Seeder
{
    public function run(): void
    {
        // 🏛️ 1. Admin Roles
        $roles = [
            ['role_name' => 'SUPER_ADMIN', 'description' => 'Full administrative control over the entire system.', 'permission_level' => 10],
            ['role_name' => 'LICENSE_OFFICER', 'description' => 'Responsible for mineral license review and issuance.', 'permission_level' => 7],
            ['role_name' => 'LAB_MANAGER', 'description' => 'Oversight of laboratory assignments and result verification.', 'permission_level' => 7],
            ['role_name' => 'TRADE_OFFICER', 'description' => 'Monitoring of mineral trades and export clearances.', 'permission_level' => 6],
            ['role_name' => 'COMPLIANCE_OFFICER', 'description' => 'Enforcement of legal standards and violation tracking.', 'permission_level' => 6],
            ['role_name' => 'ANALYST', 'description' => 'Access to national analytics and statistical reports.', 'permission_level' => 4],
        ];

        foreach ($roles as $r) {
            AdminRole::updateOrCreate(['role_name' => $r['role_name']], $r);
        }

        // 🧠 2. Admin Permissions
        $permissions = [
            ['permission_name' => 'APPROVE_LICENSE', 'module' => 'LICENSE'],
            ['permission_name' => 'REJECT_LICENSE', 'module' => 'LICENSE'],
            ['permission_name' => 'VIEW_USERS', 'module' => 'USERS'],
            ['permission_name' => 'MANAGE_LAB', 'module' => 'LAB'],
            ['permission_name' => 'APPROVE_LAB_RESULTS', 'module' => 'LAB'],
            ['permission_name' => 'VIEW_ANALYTICS', 'module' => 'SYSTEM'],
            ['permission_name' => 'MANAGE_SYSTEM', 'module' => 'SYSTEM'],
            ['permission_name' => 'TRADE_OVERSIGHT', 'module' => 'TRADE'],
            ['permission_name' => 'COMPLIANCE_ENFORCEMENT', 'module' => 'COMPLIANCE'],
        ];

        foreach ($permissions as $p) {
            AdminPermission::updateOrCreate(['permission_name' => $p['permission_name']], $p);
        }

        // 🔗 3. Mapping Permissions to Super Admin
        $superAdmin = AdminRole::where('role_name', 'SUPER_ADMIN')->first();
        $allPermissions = AdminPermission::pluck('id')->toArray();
        $superAdmin->permissions()->sync($allPermissions);

        // 👥 4. Create Master Admin
        AdminUser::updateOrCreate(['email' => 'master@gmite.gov.tz'], [
            'full_name' => 'Hon. Ibrahim Menard',
            'password_hash' => Hash::make('@governance2026'),
            'phone' => '+255 700 000 000',
            'role_id' => $superAdmin->id,
            'status' => 'ACTIVE',
            'last_login_at' => now(),
        ]);

        // 📊 5. Initial System Settings
        DB::table('system_settings')->updateOrInsert(['setting_key' => 'system_maintenance'], [
            'setting_value' => 'false',
            'updated_at' => now()
        ]);
        DB::table('system_settings')->updateOrInsert(['setting_key' => 'api_sync_frequency'], [
            'setting_value' => 'realtime',
            'updated_at' => now()
        ]);

        $this->seedSampleLifecycle();
    }

    private function seedSampleLifecycle(): void
    {
        $user = \App\Models\User::where('email', 'mining@anglogold.com')->first();
        $admin = AdminUser::where('email', 'master@gmite.gov.tz')->first();
        $analyst = AdminUser::where('full_name', 'Senior Analyst Sarah')->first(); // Wait, analyst is in users table in DatabaseSeeder.

        // 🟢 LAYER 1: USER REGISTRATION
        $sample = \App\Models\MineralSample::create([
            'sample_id' => \App\Models\MineralSample::generateId(),
            'user_id' => $user->id,
            'mineral_type' => 'Lithium',
            'mineral_category' => 'Concentrate',
            'mining_license_number' => 'ML-2026-CHUNYA',
            'sample_purpose' => 'Export Certification',
            'estimated_weight' => 500.5,
            'collection_site' => 'Western Pit 02',
            'gps_coordinates' => '-6.3690, 34.8888',
            'status' => \App\Models\MineralSample::STATUS_REGISTERED,
            'qr_code' => 'QR-SMP-LIT-001',
        ]);

        \App\Models\SampleTracking::create([
            'sample_id' => $sample->id,
            'stage' => 'DIGITAL_REGISTRATION',
            'updated_by' => $user->id,
            'notes' => 'Sample digitally registered for export evaluation.',
        ]);

        // 🟡 LAYER 2: PHYSICAL RECEIVING
        $sample->update([
            'status' => \App\Models\MineralSample::STATUS_RECEIVED,
            'received_at' => now(),
            'verified_by_admin_id' => $admin->id,
            'physical_condition' => 'SEALED_INTACT',
            'storage_location' => 'VAULT-A1',
            'quantity_kg' => 500.2, // Actual weight verified
        ]);

        \App\Models\SampleTracking::create([
            'sample_id' => $sample->id,
            'stage' => 'PHYSICAL_RECEIPT_VERIFIED',
            'admin_id' => $admin->id,
            'handler_role' => 'RECEIVING_OFFICER',
            'notes' => 'Physical sample received and verified against digital record. Weight confirmed.',
        ]);

        // 🔬 LAYER 3: LAB TESTING & CERTIFICATION
        $sample->update(['status' => \App\Models\MineralSample::STATUS_TESTING]);

        $test = \App\Models\LabTest::create([
            'sample_id' => $sample->id,
            'test_type' => 'Purity & Grade Analysis',
            'method' => 'XRF_SPECTROMETRY',
            'status' => 'COMPLETED',
            'technician_id' => $user->id, // Placeholder
        ]);

        \App\Models\LabResult::create([
            'test_id' => $test->id,
            'element_name' => 'Li2O',
            'value' => 6.2,
            'unit' => '%',
        ]);

        // Admin Approval of Lab Results
        $approval = \App\Models\LabResultsApproval::create([
            'lab_test_id' => $test->id,
            'admin_id' => $admin->id,
            'status' => 'APPROVED',
            'comments' => 'Scientific validation complete. Grade meets export standards.',
            'approved_at' => now(),
        ]);

        $sample->update(['status' => \App\Models\MineralSample::STATUS_CERTIFIED]);

        // Issue Certificate
        \App\Models\Certificate::create([
            'cert_id' => \App\Models\Certificate::generateId(),
            'document_id' => 'GMITE-CERT-LITH-2026-0001',
            'user_id' => $user->id,
            'sample_id' => $sample->id,
            'lab_result_approval_id' => $approval->id,
            'mineral_type' => 'Lithium',
            'grade' => 'Grade A (High Purity)',
            'quantity_kg' => 500.2,
            'issued_by' => 'Bureau of Mineral Standards',
            'status' => 'ACTIVE',
            'expires_at' => now()->addYear(),
        ]);

        \App\Models\SampleTracking::create([
            'sample_id' => $sample->id,
            'stage' => 'CERTIFICATE_ISSUED',
            'admin_id' => $admin->id,
            'handler_role' => 'CERTIFICATION_OFFICER',
            'notes' => 'Mineral certification issued. Assets ready for trade oversight.',
        ]);
    }
}
