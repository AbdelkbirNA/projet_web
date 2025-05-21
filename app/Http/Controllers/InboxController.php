<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function show(Request $request)
    {
        $selectedMessageId = $request->query('selected');
        $selectedMessage = null;
        if ($selectedMessageId) {
            $selectedMessage = Message::with('sender')->where('receiver_id', auth()->id())->findOrFail($selectedMessageId);
            // Marquer le message comme lu si ce n'est pas déjà le cas
            if (!$selectedMessage->is_read) {
                $selectedMessage->update(['is_read' => true]);
            }
        }
        $messages = Message::with('sender')->where('receiver_id', auth()->id())->orderBy('created_at', 'desc')->get();
        // Recalcule le compteur après la mise à jour
        $unreadCount = Message::where('receiver_id', auth()->id())->where('is_read', false)->count();
        return view('professor.inbox', compact('messages', 'selectedMessage', 'unreadCount'));
    }
} 