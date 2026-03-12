<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::query()->latest()->paginate(20);

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('status', 'Contact message deleted.');
    }
}
