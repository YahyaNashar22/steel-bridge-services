<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id' => ['nullable', 'exists:services,id'],
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        ServiceRequest::create($data);

        return back()->with('status', 'Your request has been submitted.');
    }
}
