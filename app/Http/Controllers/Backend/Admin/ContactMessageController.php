<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', '');

        $messages = ContactMessage::when($status, fn($q) => $q->where('status', $status))
            ->latest()
            ->paginate(15);

        $unreadCount = ContactMessage::unread()->count();

        return view('backend.admin.contact_messages.index', compact('messages', 'unreadCount', 'status'));
    }

    public function show(ContactMessage $contactMessage)
    {
        // Auto-mark as read when opened
        if ($contactMessage->isUnread()) {
            $contactMessage->update(['status' => 'read']);
        }
        return view('backend.admin.contact_messages.show', compact('contactMessage'));
    }

    public function updateStatus(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'status'     => 'required|in:unread,read,replied',
            'admin_note' => 'nullable|string',
        ]);

        $contactMessage->update([
            'status'     => $request->status,
            'admin_note' => $request->admin_note,
        ]);

        return back()->with('success', 'Message status updated.');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return back()->with('success', 'Message deleted.');
    }
}
