<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use App\Models\CompanyDirector;
use App\Models\License;
use App\Models\MineralSample;
use App\Models\SampleTracking;
use App\Models\LabTest;
use App\Models\LabResult;
use App\Models\Certificate;
use App\Models\TradeRequest;
use App\Models\Investor;
use App\Models\InvestmentOpportunity;
use App\Models\InvestorApplication;
use App\Models\ComplianceRecord;
use App\Models\Violation;
use App\Models\SystemAlert;
use App\Models\Notification;
use App\Models\AuditLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles
        $roles = [
            ['role_name' => 'ADMIN', 'description' => 'System administrator with full legal authority.'],
            ['role_name' => 'COMPANY', 'description' => 'Mining or trading entity operator.'],
            ['role_name' => 'INVESTOR', 'description' => 'Capital partner seeking mineral ventures.'],
            ['role_name' => 'TRADER', 'description' => 'Authorized mineral export/import agent.'],
            ['role_name' => 'LAB_TECH', 'description' => 'Scientific analyst for mineral validation.'],
        ];
        foreach ($roles as $r) {
            Role::updateOrCreate(['role_name' => $r['role_name']], $r);
        }

        $adminRole = Role::where('role_name', 'ADMIN')->first()->id;
        $companyRole = Role::where('role_name', 'COMPANY')->first()->id;
        $investorRole = Role::where('role_name', 'INVESTOR')->first()->id;
        $labRole = Role::where('role_name', 'LAB_TECH')->first()->id;

        // 2. Users
        $admin = User::updateOrCreate(['email' => 'gmiteadmin@gmail.com'], [
            'name' => 'GMITE Master Admin',
            'password' => Hash::make('@menard123'),
            'role_id' => $adminRole,
            'is_admin' => true,
            'status' => 'ACTIVE',
            'country' => 'Tanzania'
        ]);

        $companyUser = User::updateOrCreate(['email' => 'mining@anglogold.com'], [
            'name' => 'AngloGold Operations',
            'password' => Hash::make('password123'),
            'role_id' => $companyRole,
            'status' => 'ACTIVE',
            'country' => 'Tanzania'
        ]);

        $investorUser = User::updateOrCreate(['email' => 'investor@vance.com'], [
            'name' => 'Vance Capital Partners',
            'password' => Hash::make('password123'),
            'role_id' => $investorRole,
            'status' => 'ACTIVE',
            'country' => 'Dubai'
        ]);

        $labUser = User::updateOrCreate(['email' => 'lab@gmite.gov.tz'], [
            'name' => 'Senior Analyst Sarah',
            'password' => Hash::make('password123'),
            'role_id' => $labRole,
            'status' => 'ACTIVE',
            'country' => 'Tanzania'
        ]);

        // 3. Company
        $company = Company::create([
            'user_id' => $companyUser->id,
            'name' => 'AngloGold Mining Tanzania Ltd',
            'category' => 'Large Scale Mining',
            'reg_number' => 'TZ-MIN-29910',
            'tin' => '102-445-992',
            'address' => 'Geita Gold Zone',
            'status' => 'verified'
        ]);

        // 4. Company Directors
        CompanyDirector::create([
            'company_id' => $company->id,
            'full_name' => 'Director Menard Joseph',
            'nationality' => 'Tanzanian',
            'id_number' => '99201-TZN-11',
            'role' => 'Managing Director'
        ]);

        // 5. Investor Profile
        Investor::create([
            'user_id' => $investorUser->id,
            'investor_type' => 'CORPORATE',
            'capital_range' => '$5M - $50M',
            'investment_focus' => 'Gold & Lithium Extraction',
            'region_interest' => 'Western Zone, Tanzania'
        ]);

        // 6. Investment Opportunities
        $opp = InvestmentOpportunity::create([
            'title' => 'Chunya Gold Expansion 2026',
            'mineral_type' => 'Gold',
            'location' => 'Mbeya Region',
            'estimated_value' => 15000000.00,
            'status' => 'OPEN',
            'created_by' => $admin->id
        ]);

        // 7. Investor Application
        InvestorApplication::create([
            'investor_id' => $investorUser->investorProfile->id,
            'opportunity_id' => $opp->id,
            'status' => 'PENDING'
        ]);

        // 8. Mineral Samples & Tracking
        $sample = MineralSample::create([
            'sample_id' => MineralSample::generateId(),
            'user_id' => $companyUser->id,
            'mineral_type' => 'Gold Ore',
            'quantity_kg' => 125.5,
            'collection_site' => 'Shaft 04 - Geita',
            'status' => 'testing',
            'priority' => 'high'
        ]);

        SampleTracking::create([
            'sample_id' => $sample->id,
            'stage' => 'Laboratory Received',
            'updated_by' => $labUser->id,
            'notes' => 'Sample sealed and verified. Chain of custody intact.'
        ]);

        // 9. Lab Tests & Results
        $test = LabTest::create([
            'sample_id' => $sample->id,
            'test_type' => 'Purity Assay',
            'method' => 'FIRE_ASSAY',
            'status' => 'COMPLETED',
            'technician_id' => $labUser->id,
            'completed_at' => now()
        ]);

        LabResult::create([
            'test_id' => $test->id,
            'element_name' => 'Au (Gold)',
            'value' => 98.42,
            'unit' => '%'
        ]);

        // 10. Compliance & Violations
        ComplianceRecord::create([
            'company_id' => $company->id,
            'compliance_score' => 94.5,
            'status' => 'COMPLIANT',
            'last_audit_date' => now()->subDays(10)
        ]);

        Violation::create([
            'company_id' => $company->id,
            'violation_type' => 'Environmental Delay',
            'severity' => 'LOW',
            'description' => 'Delayed reporting for node water consumption analysis Q1.',
            'resolved' => true
        ]);

        // 11. System Intelligence
        SystemAlert::create([
            'user_id' => $admin->id,
            'alert_id' => 'SEC-9920',
            'severity' => 'high',
            'source_module' => 'compliance',
            'title' => 'Entity Risk Score Shift',
            'message' => 'AngloGold T. Ltd risk score dropped below 95% due to environmental reporting delay.'
        ]);

        Notification::create([
            'user_id' => $companyUser->id,
            'title' => 'Lab Analysis Results Live',
            'message' => 'Laboratory Assay for Sample GMITE-SMP-00001 has been completed. View results in terminal.',
            'type' => 'INFO'
        ]);

        AuditLog::create([
            'user_id' => $labUser->id,
            'action' => 'Finalized Lab Assay',
            'module' => 'LABORATORY',
            'entity_type' => 'LabTest',
            'entity_id' => $test->id,
            'ip_address' => '192.168.4.12',
            'logged_at' => now()
        ]);
    }
}
