<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAchievement extends Model
{
    use HasFactory;

    protected $table = 'student_achievements';

    protected $fillable = [
        'nama_kegiatan',
        'waktu_pelaksanaan',
        'tingkat',
        'prestasi_yang_dicapai',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'waktu_pelaksanaan' => 'date',
        'tingkat' => 'string',
        'is_active' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
