<?php

namespace App\Services\Compliance;

use App\Models\ComplianceCase;
use App\Models\Violation;
use App\Models\Company;
use App\Models\TradeRequest;
use App\Models\License;
use Illuminate\Support\Facades\DB;

class ComplianceEngineService
{
    /**
     * Enforce a specific regulatory action based on button trigger
     */
    public function executeAction(ComplianceCase $case, string $actionType, array $payload = [])
    {
        return DB::transaction(function () use ($case, $actionType, $payload) {
            switch ($actionType) {
                case 'ISSUE_WARNING':
                    return $this->issueWarning($case, $payload);
                case 'RESTRICT_ACTIVITY':
                    return $this->restrictActivity($case, $payload);
                case 'SUSPEND_LICENSE':
                    return $this->suspendLicense($case, $payload);
                case 'BLOCK_EXPORT':
                    return $this->blockExport($case, $payload);
                case 'ESCALATE_TO_MOCC':
                    return $this->escalateToMOCC($case, $payload);
                case 'CLOSE_CASE':
                    return $this->closeCase($case, $payload);
                default:
                    throw new \Exception("Invalid enforcement action protocol.");
            }
        });
    }

    private function issueWarning(ComplianceCase $case, $payload)
    {
        $case->update(['risk_score' => min(100, $case->risk_score + 5)]);
        return Violation::create([
            'compliance_case_id' => $case->id,
            'company_id' => $case->company_id,
            'violation_type' => 'OFFICIAL_WARNING',
            'severity' => 'LOW',
            'description' => $payload['notes'] ?? 'Formal regulatory warning issued.',
            'admin_id' => \Illuminate\Support\Facades\Auth::guard('admin')->id() ?? 1
        ]);
    }

    private function restrictActivity(ComplianceCase $case, $payload)
    {
        $case->company->update(['status' => 'restricted']);
        $case->update(['status' => 'DECISION', 'risk_score' => min(100, $case->risk_score + 15)]);
        return true;
    }

    private function suspendLicense(ComplianceCase $case, $payload)
    {
        License::where('company_id', $case->company_id)->update(['status' => 'SUSPENDED']);
        $case->company->update(['status' => 'suspended']);
        $case->update(['status' => 'DECISION', 'risk_level' => 'HIGH', 'risk_score' => 85]);
        return true;
    }

    private function blockExport(ComplianceCase $case, $payload)
    {
        TradeRequest::where('company_id', $case->company_id)
            ->where('status', 'PENDING')
            ->update(['status' => 'REJECTED', 'rejection_reason' => 'Compliance Enforcement Block']);
            
        $case->update(['risk_level' => 'CRITICAL', 'risk_score' => 95]);
        return true;
    }

    private function escalateToMOCC(ComplianceCase $case, $payload)
    {
        $case->update(['status' => 'REVIEW', 'risk_level' => 'HIGH']);
        // Here we would typically trigger an alert specifically for the MOCC users
        return true;
    }

    private function closeCase(ComplianceCase $case, $payload)
    {
        $case->update([
            'status' => 'CLOSED',
            'closed_at' => now(),
            'summary' => $payload['summary'] ?? 'Case resolved and archived.'
        ]);
        return true;
    }

    /**
     * Automatic Risk Scoring Engine
     */
    public function calculateRiskScore(ComplianceCase $case): float
    {
        $violationCount = $case->violations()->count();
        $severityWeight = $case->violations()->whereIn('severity', ['HIGH', 'CRITICAL'])->count() * 20;
        
        $score = min(100, ($violationCount * 5) + $severityWeight);
        
        $level = 'LOW';
        if ($score > 80) $level = 'CRITICAL';
        elseif ($score > 60) $level = 'HIGH';
        elseif ($score > 30) $level = 'MEDIUM';
        
        $case->update(['risk_score' => $score, 'risk_level' => $level]);
        return $score;
    }
}
