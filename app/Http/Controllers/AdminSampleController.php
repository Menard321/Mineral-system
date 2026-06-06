<?php

namespace App\Http\Controllers;

use App\Models\MineralSample;
use App\Models\SampleTracking;
use App\Models\LabTest;
use App\Models\LabResultsApproval;
use App\Models\Certificate;
use App\Models\AdminUser;
use Illuminate\Http\Request;

class AdminSampleController extends Controller
{
    // 🟡 LAYER 2: PHYSICAL RECEIVING
    public function receiving()
    {
        $samples = MineralSample::where('status', MineralSample::STATUS_REGISTERED)->latest()->get();
        return view('admin.samples.receiving', compact('samples'));
    }

    public function receive(Request $request, $id)
    {
        $sample = MineralSample::findOrFail($id);
        $admin_id = 1; // Placeholder for authenticated admin

        $sample->update([
            'status' => MineralSample::STATUS_RECEIVED,
            'received_at' => now(),
            'verified_by_admin_id' => $admin_id,
            'physical_condition' => $request->physical_condition ?? 'GOOD',
            'storage_location' => $request->storage_location ?? 'GENERAL_VAULT',
            'quantity_kg' => $request->actual_weight ?? $sample->estimated_weight,
        ]);

        SampleTracking::create([
            'sample_id' => $sample->id,
            'stage' => 'PHYSICAL_RECEIPT_VERIFIED',
            'admin_id' => $admin_id,
            'handler_role' => 'RECEIVING_OFFICER',
            'notes' => 'Sample received physically. Condition: ' . $sample->physical_condition,
        ]);

        return redirect()->back()->with('success', 'Sample Verified and Received in Custody.');
    }

    // 🔬 LAYER 3: LAB & CERTIFICATION
    public function certification()
    {
        $samples = MineralSample::whereIn('status', [MineralSample::STATUS_RECEIVED, MineralSample::STATUS_TESTING, MineralSample::STATUS_REVIEWED])->get();
        return view('admin.samples.certification', compact('samples'));
    }

    public function approve(Request $request, $id)
    {
        $sample = MineralSample::findOrFail($id);
        $admin_id = 1; // Placeholder

        // Simplified logic: Assuming lab test exists
        $test = $sample->labTests()->first();
        
        if (!$test) {
            return redirect()->back()->with('error', 'No Laboratory results found for this sample.');
        }

        $approval = LabResultsApproval::create([
            'lab_test_id' => $test->id,
            'admin_id' => $admin_id,
            'status' => 'APPROVED',
            'comments' => $request->comments ?? 'System Approval: Standards Met.',
            'approved_at' => now(),
        ]);

        $sample->update(['status' => MineralSample::STATUS_CERTIFIED]);

        Certificate::create([
            'cert_id' => Certificate::generateId(),
            'document_id' => 'GMITE-CERT-' . strtoupper($sample->mineral_type) . '-' . date('Ymd'),
            'user_id' => $sample->user_id,
            'sample_id' => $sample->id,
            'lab_result_approval_id' => $approval->id,
            'mineral_type' => $sample->mineral_type,
            'grade' => $sample->grade ?? 'Verified Grade',
            'quantity_kg' => $sample->quantity_kg,
            'issued_by' => 'Government Mineral Authority',
            'status' => 'ACTIVE',
            'expires_at' => now()->addYear(),
        ]);

        SampleTracking::create([
            'sample_id' => $sample->id,
            'stage' => 'CERTIFICATE_ISSUED',
            'admin_id' => $admin_id,
            'handler_role' => 'CERTIFICATION_OFFICER',
            'notes' => 'Mineral Certification finalized and active.',
        ]);

        return redirect()->back()->with('success', 'Certification Issued Successfully.');
    }
}
