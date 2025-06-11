@extends('layouts.app')

@section('title', __('Kelola Inquiries'))

@section('header', __('Kelola Pertanyaan & Review'))

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-comments"></i> {{ __('Daftar Pertanyaan') }}
                    </div>
                    <div class="card-body table-responsive">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Isi') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($questions as $inquiry)
                                    <tr>
                                        <td>{{ $inquiry->email }}</td>
                                        <td>{{ $inquiry->user_type ? ucfirst($inquiry->user_type) : '-' }}</td>
                                        <td>{{ Str::limit($inquiry->content, 50) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $inquiry->is_responded ? 'success' : 'warning' }}">
                                                {{ $inquiry->is_responded ? __('Sudah Ditanggapi') : __('Belum Ditanggapi') }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.inquiries.show', $inquiry) }}"
                                                class="btn btn-sm btn-primary">{{ __('Lihat') }}</a>
                                            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST"
                                                style="display:inline;"
                                                onsubmit="return confirm('{{ __('Are you sure you want to delete?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger">{{ __('Hapus') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">{{ __('No questions found.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-star"></i> {{ __('Daftar Review') }}
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Isi') }}</th>
                                    <th>{{ __('Rating') }}</th>
                                    <th>{{ __('Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reviews as $inquiry)
                                    <tr>
                                        <td>{{ $inquiry->email }}</td>
                                        <td>{{ Str::limit($inquiry->content, 50) }}</td>
                                        <td>{{ str_repeat('⭐', $inquiry->rating) }}</td>
                                        <td>
                                            <a href="{{ route('admin.inquiries.show', $inquiry) }}"
                                                class="btn btn-sm btn-primary">{{ __('Lihat') }}</a>
                                            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST"
                                                style="display:inline;"
                                                onsubmit="return confirm('{{ __('Are you sure you want to delete?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger">{{ __('Hapus') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">{{ __('No reviews found.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
