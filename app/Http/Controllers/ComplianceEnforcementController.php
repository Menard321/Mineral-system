<?php

namespace App\Http\Controllers;

use App\Models\ComplianceCase;
use App\Models\Company;
use App\Models\ComplianceEvidence;
use App\Services\Compliance\ComplianceEngineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplianceEnforcementController extends Controller
{
    protected $engine;

    public function __construct(ComplianceEngineService $engine)
    {
        $this->engine = $engine;
    }

    public function index()
    {
        $cases = ComplianceCase::with(['company', 'officer', 'violations'])->latest()->get();
        
        $stats = [
            'active' => ComplianceCase::where('status', '!=', 'CLOSED')->count(),
            'critical' => ComplianceCase::where('risk_level', 'CRITICAL')->count(),
            'closed_today' => ComplianceCase::where('status', 'CLOSED')->whereDate('closed_at', now())->count(),
        ];

        return view('admin.compliance.index', compact('cases', 'stats'));
    }

    public function show(ComplianceCase $case)
    {
        $case->load(['company.user', 'officer', 'violations', 'evidence.uploader']);
        return view('admin.compliance.show', compact('case'));
    }

    public function createCase(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
        ]);

        $case = ComplianceCase::create([
            'case_id' => ComplianceCase::generateId(),
            'company_id' => $request->company_id,
            'status' => 'OPEN',
            'assigned_officer_id' => \Illuminate\Support\Facades\Auth::guard('admin')->id() ?? 1,
        ]);

        return redirect()->route('admin.compliance.show', $case->id)
            ->with('success', 'New Compliance Case Initiated: ' . $case->case_id);
    }

    public function action(Request $request, ComplianceCase $case)
    {
        $request->validate([
            'action_type' => 'required|string',
        ]);

        $this->engine->executeAction($case, $request->action_type, $request->all());
        
        return back()->with('success', 'Enforcement Protocol Executed: ' . $request->action_type);
    }

    public function uploadEvidence(Request $request, ComplianceCase $case)
    {
        $request->validate([
            'evidence_file' => 'required|file|max:10240',
            'document_type' => 'required|string',
        ]);

        $path = $request->file('evidence_file')->store('compliance/evidence');
        
        ComplianceEvidence::create([
            'compliance_case_id' => $case->id,
            'document_type' => $request->document_type,
            'file_path' => $path,
            'file_hash' => hash_file('sha256', storage_path('app/' . $path)),
            'uploaded_by' => \Illuminate\Support\Facades\Auth::guard('admin')->id() ?? 1,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Immutable Evidence Locked into Case Ledger.');
    }
}
