@extends('layouts.professor-layout')

@section('no_hero', true)

@section('content')
<style>
    body {
        background: #f4f8ff;
    }
    .messagerie-container {
        display: flex;
        gap: 32px;
        margin: 40px auto;
        max-width: 1200px;
        min-height: 70vh;
    }
    .messages-list-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px 0 rgba(60,72,88,.08);
        padding: 24px 0 24px 0;
        width: 420px;
        display: flex;
        flex-direction: column;
        min-height: 400px;
        height: 100%;
    }
    .messages-list-card h2 {
        color: #2563eb;
        font-size: 2rem;
        font-weight: 700;
        margin-left: 24px;
        margin-bottom: 8px;
    }
    .badge-unread {
        background: #2563eb;
        color: #fff;
        border-radius: 12px;
        font-size: 0.85rem;
        padding: 2px 10px;
        margin-left: 8px;
    }
    .search-input {
        margin: 0 24px 16px 24px;
        padding: 10px 16px;
        border: 1px solid #e0e7ef;
        border-radius: 8px;
        font-size: 1rem;
        outline: none;
        background: #f4f8ff;
    }
    .message-item {
        display: flex;
        flex-direction: column;
        padding: 16px 24px;
        border-bottom: 1px solid #f0f0f0;
        cursor: pointer;
        background: transparent;
        transition: background 0.2s;
    }
    .message-item:last-child {
        border-bottom: none;
    }
    .message-item.selected, .message-item:hover {
        background: #eaf1ff;
    }
    /* Style pour les messages non lus */
    .message-item.unread {
        background: #f0f0f0;
        font-weight: bold;
    }
    .message-item.read {
        background: #fff;
        font-weight: normal;
    }
    .message-title {
        color: #2563eb;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 2px;
    }
    .message-title span {
        color: #2563eb;
    }
    .message-snippet {
        color: #555;
        font-size: 0.97rem;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 90%;
    }
    .message-date {
        color: #a0a0a0;
        font-size: 0.85rem;
    }
    .content-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px 0 rgba(60,72,88,.08);
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 400px;
        width: 100%;
        height: 100%;
        max-height: 80vh;
        overflow-y: auto;
    }
    .empty-message {
        text-align: center;
        color: #8a94a6;
    }
    .empty-message i {
        font-size: 3rem;
        color: #b0b8c9;
        margin-bottom: 12px;
    }
    /* Liens et boutons dans la zone de détail */
    .content-card a,
    .content-card button,
    .content-card .btn {
        background: #2563eb !important;
        color: #fff !important;
        border: none;
        border-radius: 8px;
        padding: 10px 24px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.2s;
    }
    .content-card a:hover,
    .content-card button:hover,
    .content-card .btn:hover {
        background: #174bbd !important;
    }
    .delete-btn {
        background: transparent;
        border: none;
        color: #e74c3c;
        font-size: 1.1rem;
        cursor: pointer;
        float: right;
        margin-left: 8px;
    }
    .delete-btn:hover {
        color: #b71c1c;
    }
    .modal-overlay {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(36, 54, 90, 0.18);
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
    }
    .modal-confirm {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 32px 0 rgba(60,72,88,.18);
        padding: 36px 40px 28px 40px;
        min-width: 340px;
        max-width: 90vw;
        text-align: center;
        z-index: 1001;
    }
    .modal-confirm h4 {
        color: #2563eb;
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 18px;
    }
    .modal-confirm p {
        color: #444;
        font-size: 1.08rem;
        margin-bottom: 24px;
    }
    .modal-confirm .modal-btn {
        background: #2563eb;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px 28px;
        font-size: 1rem;
        font-weight: 600;
        margin: 0 10px;
        cursor: pointer;
        transition: background 0.2s;
    }
    .modal-confirm .modal-btn.cancel {
        background: #e0e7ef;
        color: #2563eb;
    }
    .modal-confirm .modal-btn:hover {
        background: #174bbd;
        color: #fff;
    }
</style>
<div class="messagerie-container">
    <div class="messages-list-card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-right: 24px;">
            <h2>Messagerie</h2>
            @if($unreadCount > 0)
                <span class="badge-unread">{{ $unreadCount }} non lu(s)</span>
            @endif
        </div>
        <input type="text" class="search-input" placeholder="Rechercher..." wire:model="search">
        <div style="flex:1; overflow-y:auto;">
            @forelse($messages as $message)
                <div class="message-item @if($selectedMessage && $selectedMessage->id == $message->id) selected @endif @if(!$message->is_read) unread @else read @endif" onclick="window.location='{{ route('inbox') }}?selected={{ $message->id }}'">
                    <form action="{{ route('messages.destroy', $message->id) }}" method="POST" style="display:inline;" class="delete-message-form" data-message-id="{{ $message->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete-btn" title="Supprimer" onclick="event.stopPropagation(); showDeleteModal({{ $message->id }});"><i class="fas fa-trash"></i></button>
                    </form>
                    <div class="message-title">{{ $message->subject }}
                        <span style="font-size:0.95em; color:#2563eb; font-weight:400;">
                            — {{ $message->sender->name ?? 'Étudiant inconnu' }}
                        </span>
                    </div>
                    <div class="message-snippet">{{ Str::limit($message->body, 40) }}</div>
                    <div class="message-date">{{ $message->created_at->format('d M Y à H:i') }}</div>
                </div>
            @empty
                <div class="empty-message" style="margin-top: 40px;">
                    <i class="fas fa-inbox"></i><br>
                    Aucun message
                </div>
            @endforelse
        </div>
    </div>
    <div class="content-card" style="min-height: 400px; width: 100%; display: flex; align-items: center; justify-content: center;">
        @if($selectedMessage)
            <div style="width:100%; max-width:100%; padding:40px 48px; box-sizing:border-box; border-radius: 14px; box-shadow: 0 2px 12px 0 rgba(60,72,88,.06);">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                    <h3 style="color:#2563eb; font-size:2rem; font-weight:800; margin:0;">{{ $selectedMessage->subject }}</h3>
                    <span style="color:#a0a0a0; font-size:1rem; font-weight:500;">{{ $selectedMessage->created_at->format('d M Y à H:i') }}</span>
                </div>
                <div style="margin-bottom:18px; color:#2563eb; font-size:1.08rem; font-weight:600;">
                    <i class="fas fa-user-circle" style="margin-right:6px;"></i> {{ $selectedMessage->sender->name ?? 'Étudiant inconnu' }}
                </div>
                <hr style="border: none; border-top: 1.5px solid #e0e7ef; margin: 18px 0;">
                <div style="margin-bottom:28px; color:#222; font-size:1.15rem; line-height:1.8; white-space:pre-line;">
                    {{ $selectedMessage->body }}
                </div>
                @if($selectedMessage->attachments && $selectedMessage->attachments->count())
                    <div style="margin-top:18px;">
                        <b style="color:#2563eb; font-size:1.08rem;">Pièce jointe :</b>
                        @foreach($selectedMessage->attachments as $attachment)
                            <div style="margin-top:12px; display: flex; align-items: center;">
                                @php
                                    $isPdf = Str::endsWith(strtolower($attachment->file_path), '.pdf');
                                    $url = asset('storage/' . $attachment->file_path);
                                @endphp
                                @if($isPdf)
                                    <a href="{{ $url }}" target="_blank" style="color:#2563eb; font-weight:600; text-decoration:underline; margin-right:18px; padding:10px 24px; background:#f4f8ff; border-radius:8px;">Lire le PDF</a>
                                    <a href="{{ $url }}" download style="color:#fff; background:#2563eb; font-weight:600; border-radius:8px; padding:10px 24px; margin-left:8px; text-decoration:none;">Télécharger</a>
                                @else
                                    <a href="{{ $url }}" download style="color:#2563eb; font-weight:600; text-decoration:underline;">Télécharger {{ basename($attachment->file_path) }}</a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <div class="empty-message" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; height: 100%; width: 100%;">
                <i class="fas fa-envelope-open-text" style="font-size:3.5rem; color:#b0b8c9; margin-bottom:18px;"></i>
                <p style="margin-top: 16px; font-size: 1.2rem; color:#8a94a6; font-weight:600;">Aucun message sélectionné</p>
                <p style="color:#b0b8c9;">Sélectionnez un message dans la liste pour afficher son contenu.</p>
            </div>
        @endif
    </div>
</div>
<!-- N'oubliez pas d'inclure FontAwesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Modale de confirmation -->
<div id="modal-overlay" class="modal-overlay">
    <div class="modal-confirm">
        <h4>Confirmer la suppression</h4>
        <p>Voulez-vous vraiment supprimer ce message ? Cette action est irréversible.</p>
        <button class="modal-btn confirm" id="modal-confirm-btn">Supprimer</button>
        <button class="modal-btn cancel" id="modal-cancel-btn">Annuler</button>
    </div>
</div>
<script>
    let formToDelete = null;
    function showDeleteModal(messageId) {
        formToDelete = document.querySelector('.delete-message-form[data-message-id="'+messageId+'"]');
        document.getElementById('modal-overlay').style.display = 'flex';
    }
    document.getElementById('modal-cancel-btn').onclick = function() {
        document.getElementById('modal-overlay').style.display = 'none';
        formToDelete = null;
    };
    document.getElementById('modal-confirm-btn').onclick = function() {
        if(formToDelete) formToDelete.submit();
    };
    // Fermer la modale si on clique en dehors
    document.getElementById('modal-overlay').onclick = function(e) {
        if(e.target === this) {
            this.style.display = 'none';
            formToDelete = null;
        }
    };
</script>
@endsection 