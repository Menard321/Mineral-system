<?php

namespace App\Http\Controllers;

use App\Models\MineralSample;
use App\Models\Certificate;
use App\Models\SampleTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificatesController extends Controller
{
    /**
     * LAYER 1 VIEW — Overview Dashboard + Sample Tracking List
     */
    public function index()
    {
        $userId = Auth::id();

        $samples = MineralSample::where('user_id', $userId)
            ->with(['tracking', 'certificate', 'labTests'])
            ->latest()
            ->get();

        $stats = [
            'total'      => $samples->count(),
            'pending'    => $samples->whereIn('status', [MineralSample::STATUS_REGISTERED])->count(),
            'in_lab'     => $samples->whereIn('status', [MineralSample::STATUS_RECEIVED, MineralSample::STATUS_TESTING])->count(),
            'approved'   => $samples->where('status', MineralSample::STATUS_REVIEWED)->count(),
            'certified'  => $samples->where('status', MineralSample::STATUS_CERTIFIED)->count(),
            'rejected'   => $samples->where('status', MineralSample::STATUS_REJECTED)->count(),
        ];

        $certificates = Certificate::where('user_id', $userId)
            ->with('sample')
            ->latest()
            ->get();

        return view('certificates.index', compact('samples', 'stats', 'certificates'));
    }

    /**
     * DETAILED LIFECYCLE VIEW — Full timeline for one sample
     */
    public function show($id)
    {
        $sample = MineralSample::where('user_id', Auth::id())
            ->with([
                'tracking.admin',
                'certificate.labApproval',
                'labTests.results',
                'verifier',
            ])
            ->findOrFail($id);

        // Build structured lifecycle stages
        $lifecycle = [
            [
                'key'       => 'REGISTERED',
                'label'     => 'Sample Registered',
                'icon'      => 'fingerprint',
                'color'     => 'yellow',
                'desc'      => 'Digital identity created. QR code issued.',
                'authority' => 'Mining Entity / System',
                'done'      => true,
                'timestamp' => $sample->created_at,
            ],
            [
                'key'       => 'RECEIVED',
                'label'     => 'Physical Receipt Verified',
                'icon'      => 'inventory_2',
                'color'     => 'blue',
                'desc'      => 'Physical sample delivered and verified. Chain-of-custody established.',
                'authority' => 'Government Receiving Officer',
                'done'      => in_array($sample->status, [MineralSample::STATUS_RECEIVED, MineralSample::STATUS_TESTING, MineralSample::STATUS_REVIEWED, MineralSample::STATUS_CERTIFIED, MineralSample::STATUS_REJECTED]),
                'timestamp' => $sample->received_at,
            ],
            [
                'key'       => 'TESTING',
                'label'     => 'Laboratory Testing',
                'icon'      => 'biotech',
                'color'     => 'purple',
                'desc'      => 'Chemical composition, purity, and grade analysis underway.',
                'authority' => 'Accredited Laboratory Technician',
                'done'      => in_array($sample->status, [MineralSample::STATUS_TESTING, MineralSample::STATUS_REVIEWED, MineralSample::STATUS_CERTIFIED, MineralSample::STATUS_REJECTED]),
                'timestamp' => $sample->labTests->first()?->created_at,
            ],
            [
                'key'       => 'REVIEWED',
                'label'     => 'Government Review',
                'icon'      => 'gavel',
                'color'     => 'orange',
                'desc'      => 'Scientific findings under review by regulatory authority.',
                'authority' => 'Bureau of Mineral Standards',
                'done'      => in_array($sample->status, [MineralSample::STATUS_REVIEWED, MineralSample::STATUS_CERTIFIED, MineralSample::STATUS_REJECTED]),
                'timestamp' => $sample->certificate?->labApproval?->approved_at,
            ],
            [
                'key'       => 'CERTIFIED',
                'label'     => 'Certified',
                'icon'      => 'workspace_premium',
                'color'     => 'green',
                'desc'      => 'Official mineral certificate issued. Asset cleared for trade.',
                'authority' => 'Government Mineral Authority',
                'done'      => $sample->status === MineralSample::STATUS_CERTIFIED,
                'timestamp' => $sample->certificate?->created_at,
            ],
        ];

        if ($sample->status === MineralSample::STATUS_REJECTED) {
            $lifecycle[4] = [
                'key'       => 'REJECTED',
                'label'     => 'Rejected',
                'icon'      => 'cancel',
                'color'     => 'red',
                'desc'      => 'Sample failed to meet regulatory standards.',
                'authority' => 'Government Mineral Authority',
                'done'      => true,
                'timestamp' => $sample->updated_at,
            ];
        }

        return view('certificates.show', compact('sample', 'lifecycle'));
    }
}
