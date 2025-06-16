@extends('layouts.app')

@php
    $isEdit = isset($admin);
@endphp

@section('title', $isEdit ? 'Edit Admin' : 'Tambah Admin Baru')
@section('header', $isEdit ? 'Edit Admin' : 'Tambah Admin Baru')

@push('styles')
    <style>
        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Formulir Data Admin</h5>
                    </div>
                    <div class="card-body">

                        @if ($isEdit)
                            {{-- Form untuk MENGEDIT. Nama parameter sudah diperbaiki menjadi 'admin' --}}
                            <form action="{{ route('admin.management.update', ['admin' => $admin->id]) }}" method="POST">
                                @method('PUT')
                            @else
                                {{-- Form untuk MENAMBAH BARU --}}
                                <form action="{{ route('admin.management.store') }}" method="POST">
                        @endif

                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $admin->name ?? '') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email', $admin->email ?? '') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" {{ $isEdit ? '' : 'required' }}>
                                @if ($isEdit)
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah
                                        password.</small>
                                @endif
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Peran (Role)</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="is_superadmin"
                                        name="is_superadmin" value="1"
                                        {{ old('is_superadmin', $admin->is_superadmin ?? false) ? 'checked' : '' }}
                                        {{-- Tambahkan disabled jika sedang mengedit akun yang dilindungi --}} @if (isset($admin) && $admin->email === 'aitdel844@gmail.com') disabled @endif>
                                    <label class="form-check-label" for="is_superadmin">Jadikan Super Admin</label>
                                    @if (isset($admin) && $admin->email === 'aitdel844@gmail.com')
                                        <small class="d-block text-muted">Peran Super Admin utama tidak dapat
                                            diubah.</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Akun</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                                        name="is_active" value="1"
                                        {{ old('is_active', $admin->is_active ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Akun Aktif</label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            <a href="{{ route('admin.management.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit"
                                class="btn btn-primary">{{ $isEdit ? 'Simpan Perubahan' : 'Buat Akun' }}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
