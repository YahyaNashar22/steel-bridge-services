<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        ContactMessage::create($data);

        return back()->with('status', 'Your message has been sent.');
    }
}
