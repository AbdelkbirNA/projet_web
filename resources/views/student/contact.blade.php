@extends('layouts.master')

@section('title', 'ENSIASD - Contact')
@section('description', 'Contactez les professeurs de l\'ENSIASD')

@section('content')
    <style>
        body {
            background: #f4f8ff;
        }
        .contact-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 12px 0 rgba(60,72,88,.08);
            max-width: 500px;
            margin: 40px auto;
            padding: 32px 32px 24px 32px;
        }
        .contact-title {
            color: #2563eb;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 18px;
            text-align: center;
        }
        .contact-label {
            color: #2563eb;
            font-weight: 600;
            margin-bottom: 6px;
        }
        .contact-input, .contact-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e0e7ef;
            border-radius: 8px;
            font-size: 1rem;
            margin-bottom: 16px;
            background: #f4f8ff;
            outline: none;
        }
        .contact-btn {
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 32px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 8px;
            width: 100%;
        }
        .contact-btn:hover {
            background: #174bbd;
        }
        .contact-success {
            background: #e6f9ec;
            color: #217a3a;
            border-radius: 8px;
            padding: 10px 18px;
            margin-bottom: 18px;
            text-align: center;
            font-weight: 600;
        }
    </style>

    <!-- Contact Form Section -->
    <section class="section" style="background: #f8f9fa; padding: 40px 0;">
        <div class="container">
            <div class="contact-form-wrapper" style="max-width: 900px; margin: 0 auto; background: #fff; border-radius: 18px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); padding: 40px 36px;">
                <h1 style="font-size: 2.3rem; font-weight: bold; text-align: center; margin-bottom: 18px; color: #1a237e;">Contactez un professeur</h1>
                <p style="text-align: center; color: #444; margin-bottom: 32px;">Remplissez ce formulaire pour envoyer un message à un professeur de l'école.</p>
                @if(session('success'))
                    <div class="alert alert-success" style="background: #e6f9ec; color: #217a3a; border: none; border-radius: 8px;">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4 pb-4" style="border-bottom:1.5px solid #e0e0e0;">
                        <label for="professor_email" class="form-label" style="display:block; font-weight:700; font-size:1.13rem; color:#1a237e; margin-bottom:8px;">Professeur</label>
                        <select name="professor_email" id="professor_email" class="form-select @error('professor_email') is-invalid @enderror" required style="border-radius: 0px; width:100%; min-width:0;">
                            <option value="">Sélectionnez un professeur</option>
                            @foreach($professors as $professor)
                                <option value="{{ $professor->email }}">{{ $professor->name }} ({{ $professor->email }})</option>
                            @endforeach
                        </select>
                        @error('professor_email')
                            <div class="invalid-feedback" style="color: #e74c3c;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4 pb-4" style="border-bottom:1.5px solid #e0e0e0;">
                        <label for="subject" class="form-label" style="display:block; font-weight:700; font-size:1.13rem; color:#1a237e; margin-bottom:8px;">Sujet</label>
                        <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" required style="border-radius: 0px; width:100%; min-width:0;">
                        @error('subject')
                            <div class="invalid-feedback" style="color: #e74c3c;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4 pb-4" style="border-bottom:1.5px solid #e0e0e0;">
                        <label for="message" class="form-label" style="display:block; font-weight:700; font-size:1.13rem; color:#1a237e; margin-bottom:8px;">Message</label>
                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="10" required style="border-radius: 0px; font-size: 1.1rem; min-height: 220px; border: 1.5px solid #bdbdbd; box-shadow: none; transition: border-color 0.2s; outline: none; padding: 16px; resize: vertical; width:100%; min-width:0;" onfocus="this.style.borderColor='#1a237e'" onblur="this.style.borderColor='#bdbdbd'">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback" style="color: #e74c3c;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="attachment" class="form-label" style="display:block; font-weight:700; font-size:1.13rem; color:#1a237e; margin-bottom:8px;">Pièce jointe (optionnel)</label>
                        <input type="file" class="form-control @error('attachment') is-invalid @enderror" id="attachment" name="attachment" style="border-radius: 0px; width:100%; min-width:0;">
                        @error('attachment')
                            <div class="invalid-feedback" style="color: #e74c3c;">{{ $message }}</div>
                        @enderror
                        <div style="margin-top: 6px;">
                            <small class="text-muted">Formats acceptés : PDF, images. Taille maximale : 10MB</small>
                        </div>
                    </div>
                    <div>
                        <button type="submit" style="background: #1a237e; color: #fff; border: none; border-radius: 0px; padding: 14px 0; font-size: 1.1rem; font-weight: 600; box-shadow: 0 2px 8px rgba(26,35,126,0.08); transition: background 0.2s; width:100%; min-width:0; display:block;">
                            <i class="fas fa-paper-plane"></i> Envoyer le message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection 