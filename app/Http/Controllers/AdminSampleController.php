<?php

namespace App\Http\Controllers;

use App\Models\MineralSample;
use App\Models\SampleTracking;
use App\Models\LabResultsApproval;
use App\Models\Certificate;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminSampleController extends Controller
{
    // 🟡 LAYER 2: PHYSICAL RECEIVING
    public function receiving()
    {
        $samples = MineralSample::where(
            'status',
            MineralSample::STATUS_REGISTERED
        )->latest()->get();

        return view('admin.samples.receiving', compact('samples'));
    }

    // 🟢 CREATE / STORE SAMPLE + QR LOGIC
    public function store(Request $request)
    {
        $sample = MineralSample::create([
            'sample_id' => 'GMITE-SMP-' . date('Y') . '-' . rand(100000, 999999),
            'mineral_type' => $request->mineral_type,
            'estimated_weight' => $request->estimated_weight,
            'status' => MineralSample::STATUS_REGISTERED,
        ]);

        // QR LINK (IMPORTANT)
        $qrLink = url('/samples/verify/' . $sample->sample_id);

        // SAVE QR LINK (optional)
        $sample->update([
            'qr_code' => $qrLink
        ]);

        // REDIRECT TO DIGITAL ID PAGE
        return redirect()->route('samples.archive', $sample->id);
    }

    // 🟢 ARCHIVE PAGE (THIS WAS MISSING - VERY IMPORTANT)
   public function archive($id)
{
    $sample = MineralSample::findOrFail($id);

    $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(180)->generate(
        url('/samples/verify/' . $sample->sample_id)
    );

    return view('samples.archive.digital-id', compact('sample', 'qrCode'));
}
    // 🟡 RECEIVE SAMPLE
    public function receive(Request $request, $id)
    {
        $sample = MineralSample::findOrFail($id);
        $admin_id = 1;

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
            'notes' => 'Sample received physically.',
        ]);

        \App\Models\Notification::create([
            'user_id' => $sample->user_id,
            'title' => 'Sample Received',
            'message' => 'Your sample ' . $sample->sample_id . ' has been received.',
            'type' => 'INFO',
        ]);

        return redirect()->back()->with('success', 'Sample Received Successfully.');
    }

    // 📡 QR PAGE VIEW
    public function showQr($id)
    {
        $sample = MineralSample::findOrFail($id);

        return view('samples.qr', compact('sample'));
    }

    // 🔬 CERTIFICATION LIST
    public function certification()
    {
        $samples = MineralSample::whereIn('status', [
            MineralSample::STATUS_RECEIVED,
            MineralSample::STATUS_TESTING,
            MineralSample::STATUS_REVIEWED
        ])->get();

        return view('admin.samples.certification', compact('samples'));
    }

    // 🏅 APPROVE + ISSUE CERTIFICATE
    public function approve(Request $request, $id)
    {
        $sample = MineralSample::findOrFail($id);
        $admin_id = 1;

        $test = $sample->labTests()->first();

        if (!$test) {
            return redirect()->back()->with('error', 'No Laboratory results found.');
        }

        $approval = LabResultsApproval::create([
            'lab_test_id' => $test->id,
            'admin_id' => $admin_id,
            'status' => 'APPROVED',
            'comments' => $request->comments ?? 'System Approval',
            'approved_at' => now(),
        ]);

        $sample->update([
            'status' => MineralSample::STATUS_CERTIFIED
        ]);

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
            'signing_authority' => 'Dr. Jane Doe',
            'digital_signature' => hash('sha256', $sample->sample_id . now() . 'GOV_SECRET_KEY'),
            'signed_at' => now(),
            'status' => 'ACTIVE',
            'expires_at' => now()->addYear(),
        ]);

        SampleTracking::create([
            'sample_id' => $sample->id,
            'stage' => 'CERTIFICATE_ISSUED',
            'admin_id' => $admin_id,
            'handler_role' => 'CERTIFICATION_OFFICER',
            'notes' => 'Certificate issued successfully.',
        ]);

        \App\Models\Notification::create([
            'user_id' => $sample->user_id,
            'title' => 'Certificate Issued',
            'message' => 'Certificate issued for sample ' . $sample->sample_id,
            'type' => 'SUCCESS',
        ]);

        return redirect()->back()->with('success', 'Certification Issued Successfully.');
    }
}