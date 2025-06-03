<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $table = 'facilities';

    protected $fillable = [
        'type',
        'description',
        'academic_days',
        'academic_hours',
        'collaborative_hours',
        'images',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'academic_days' => 'array',
        'images' => 'array',
        'is_active' => 'boolean',
    ];

    // Scope untuk data aktif (untuk halaman user)
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk semua data (untuk halaman admin)
    public function scopeAll($query)
    {
        return $query;
    }

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}
