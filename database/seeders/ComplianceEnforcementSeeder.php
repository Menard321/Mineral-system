<?php

namespace Database\Seeders;

use App\Models\ComplianceCase;
use App\Models\Violation;
use App\Models\Company;
use App\Models\AdminUser;
use Illuminate\Database\Seeder;

class ComplianceEnforcementSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all();
        $admin = AdminUser::first();

        if ($companies->isEmpty() || !$admin) return;

        // 1. Critical Case: Revenue Fraud investigation
        $case1 = ComplianceCase::updateOrCreate(
            ['case_id' => 'GMITE-CASE-RV4492'],
            [
                'company_id' => $companies[0]->id,
                'assigned_officer_id' => $admin->id,
                'status' => 'INVESTIGATION',
                'risk_level' => 'CRITICAL',
                'risk_score' => 92.5,
                'summary' => 'System detected 85% valuation gap in recent gold export applications.',
            ]
        );

        Violation::updateOrCreate(
            ['compliance_case_id' => $case1->id, 'violation_type' => 'REVENUE_FRAUD'],
            [
                'company_id' => $companies[0]->id,
                'severity' => 'CRITICAL',
                'description' => 'Willful undervaluation of mineral assets for tax evasion.',
                'admin_id' => $admin->id
            ]
        );

        if ($companies->count() > 1) {
            // 2. High Risk Case: Lab Mismatch
            $case2 = ComplianceCase::updateOrCreate(
                ['case_id' => 'GMITE-CASE-LB1103'],
                [
                    'company_id' => $companies[1]->id,
                    'assigned_officer_id' => $admin->id,
                    'status' => 'REVIEW',
                    'risk_level' => 'HIGH',
                    'risk_score' => 74.0,
                    'summary' => 'Lab results indicate purity levels inconsistent with declared grade.',
                ]
            );

            Violation::updateOrCreate(
                ['compliance_case_id' => $case2->id, 'violation_type' => 'GRADE_MISMATCH'],
                [
                    'company_id' => $companies[1]->id,
                    'severity' => 'HIGH',
                    'description' => 'Declaration of high-grade copper while lab test results show low-grade ore.',
                    'admin_id' => $admin->id
                ]
            );
        }
    }
}
