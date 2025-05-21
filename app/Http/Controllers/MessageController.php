<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::where('receiver_id', Auth::id())
            ->with('sender')
            ->latest()
            ->get();

        $selectedMessage = null;
        if ($request->has('selected')) {
            $selectedMessage = Message::where('id', $request->selected)
                ->where('receiver_id', Auth::id())
                ->with('sender')
                ->first();

            // Marquer comme lu si ce n'est pas déjà le cas
            if ($selectedMessage && !$selectedMessage->is_read) {
                $selectedMessage->update(['is_read' => true]);
            }
        }

        // Recalculer le compteur APRÈS la mise à jour
        $unreadCount = Message::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();

        $profile = \App\Models\Profile::where('user_id', Auth::id())->first();

        return view('professor.inbox', [
            'messages' => $messages,
            'unreadCount' => $unreadCount,
            'selectedMessage' => $selectedMessage,
            'profile' => $profile,
        ]);
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);

        if ($message->receiver_id == Auth::id() && !$message->is_read) {
            $message->update(['is_read' => true]);
        }

        $profile = \App\Models\Profile::where('user_id', Auth::id())->first();

        return view('professor.show', compact('message', 'profile'));
    }

    public function reply(Request $request, $id)
    {
        $original = Message::findOrFail($id);

        $reply = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $original->sender_id,
            'subject' => 'Re: ' . $original->subject,
            'body' => $request->body,
            'is_read' => false,
        ]);

        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $path = $file->store('attachments');
                Attachment::create([
                    'message_id' => $reply->id,
                    'file_path' => $path
                ]);
            }
        }

        return redirect()->route('inbox')->with('success', 'Message envoyé avec succès');
    }

    public function mark(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $message->update($request->only('is_important', 'is_archived'));
        return back()->with('success', 'Message mis à jour avec succès');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('query');

        $messages = Message::where('receiver_id', Auth::id())
            ->where(function($q) use ($keyword) {
                $q->where('subject', 'LIKE', "%$keyword%")
                  ->orWhere('body', 'LIKE', "%$keyword%");
            })
            ->get();

        return view('professor.inbox', compact('messages'));
    }

    public function destroy($id)
    {
        $message = Message::where('receiver_id', auth()->id())->findOrFail($id);
        // Supprimer les pièces jointes associées
        foreach ($message->attachments as $attachment) {
            \Storage::disk('public')->delete($attachment->file_path);
            $attachment->delete();
        }
        $message->delete();
        return redirect()->route('inbox')->with('success', 'Message supprimé avec succès.');
    }
}
