@extends('layouts.app')

@section('title', 'Detail Inquiry')

@section('header', 'Detail Pertanyaan/Review')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-comment-alt"></i> Detail
                    </div>
                    <div class="card-body">
                        <p><strong>Email:</strong> {{ $inquiry->email }}</p>
                        <p><strong>Tipe:</strong> {{ ucfirst($inquiry->type) }}</p>
                        @if ($inquiry->type === 'question')
                            <p><strong>User:</strong> {{ $inquiry->user_type ? ucfirst($inquiry->user_type) : '-' }}</p>
                        @endif
                        <p><strong>Isi:</strong> {!! nl2br(e($inquiry->content)) !!}</p>
                        @if ($inquiry->rating)
                            <p><strong>Rating:</strong> {{ str_repeat('⭐', $inquiry->rating) }}</p>
                        @endif
                        @if ($inquiry->is_responded)
                            <p><strong>Tanggapan:</strong> {!! nl2br(e($inquiry->admin_response)) !!}</p>
                            <p><strong>Ditanggapi pada:</strong> {{ $inquiry->responded_at->format('d M Y H:i') }}</p>
                            <p><strong>Ditanggapi oleh:</strong> {{ $inquiry->admin ? $inquiry->admin->name : 'Unknown' }}
                            </p>
                        @else
                            <form action="{{ route('admin.inquiries.respond', $inquiry) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="response" class="form-label">Tanggapan</label>
                                    <textarea name="response" id="response" class="form-control" rows="5" required></textarea>
                                    @error('response')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim Tanggapan</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
