<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceRequest;
use App\Models\TrustedBrand;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'categories' => ServiceCategory::count(),
            'services' => Service::count(),
            'published_services' => Service::where('is_published', true)->count(),
            'contact_messages' => ContactMessage::count(),
            'service_requests' => ServiceRequest::count(),
            'trusted_brands' => TrustedBrand::count(),
        ];

        $latestMessages = ContactMessage::latest()->limit(5)->get();
        $latestRequests = ServiceRequest::query()
            ->with('service:id,title')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latestMessages', 'latestRequests'));
    }
}
