<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'type',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    const TYPES = [
        'kegiatan_mahasiswa' => 'Kegiatan Mahasiswa',
        'kegiatan_prodi' => 'Kegiatan Prodi',
        'club_mahasiswa' => 'Club Mahasiswa',
    ];

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\Admin::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(\App\Models\Admin::class, 'updated_by');
    }

    public function getTypeLabel()
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
