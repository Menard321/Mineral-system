<?php

namespace App\Http\Controllers;

use App\Models\MineralSample;
use App\Models\SampleTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SampleManagementController extends Controller
{
    public function index()
    {
        $samples = MineralSample::where('user_id', Auth::id())->latest()->get();
        return view('samples.index', compact('samples'));
    }

    public function create()
    {
        return view('samples.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mineral_type' => 'required|string',
            'mineral_category' => 'required|string',
            'mining_license_number' => 'required|string',
            'estimated_weight' => 'required|numeric',
            'collection_site' => 'required|string',
            'sample_purpose' => 'required|string',
        ]);

        // Anti-Duplicate Detection: License + Weight combination within 24h
        $exists = MineralSample::where('mining_license_number', $request->mining_license_number)
            ->where('estimated_weight', $request->estimated_weight)
            ->where('created_at', '>=', now()->subHours(24))
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'CRITICAL ERROR: A sample with this license and weight combination was already filed in the last 24 hours. Submission blocked to prevent duplicates.');
        }

        $sample = MineralSample::create([
            'sample_id' => MineralSample::generateId(),
            'user_id' => Auth::id(),
            'mineral_type' => $request->mineral_type,
            'mineral_category' => $request->mineral_category,
            'mining_license_number' => $request->mining_license_number,
            'sample_purpose' => $request->sample_purpose,
            'estimated_weight' => $request->estimated_weight,
            'collection_site' => $request->collection_site,
            'gps_coordinates' => $request->gps_coordinates,
            'status' => MineralSample::STATUS_REGISTERED,
            'qr_code' => 'GMITE-QR-' . uniqid(),
        ]);

        SampleTracking::create([
            'sample_id' => $sample->id,
            'stage' => 'DIGITAL_REGISTRATION',
            'updated_by' => Auth::id(),
            'notes' => 'Sample digitally registered by ' . Auth::user()->name,
        ]);

        return redirect()->route('user.samples.index')->with('success', 'Sample Registered Successfully. Please print the QR code for physical delivery.');
    }
}
