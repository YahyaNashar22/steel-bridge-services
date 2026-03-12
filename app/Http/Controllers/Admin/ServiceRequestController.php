<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{
    public function index()
    {
        $requests = ServiceRequest::query()
            ->with('service:id,title')
            ->latest()
            ->paginate(20);

        return view('admin.service-requests.index', compact('requests'));
    }

    public function show(ServiceRequest $serviceRequest)
    {
        $serviceRequest->load('service:id,title');

        return view('admin.service-requests.show', compact('serviceRequest'));
    }

    public function destroy(ServiceRequest $serviceRequest)
    {
        $serviceRequest->delete();

        return redirect()
            ->route('admin.service-requests.index')
            ->with('status', 'Service request deleted.');
    }
}
