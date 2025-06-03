<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str; // Tambahkan ini

class Lecturer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lecturers';

    protected $fillable = [
        'employee_id',
        'image',
        'name',
        'email',
        'linkedIn',
        'room',
        'education',
        'research',
        'courses',
        'role',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
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

    // Accessor untuk mendapatkan URL LinkedIn yang benar
    public function getLinkedInUrlAttribute(): ?string
    {
        if (empty($this->linkedIn)) {
            return null;
        }
        if (Str::startsWith($this->linkedIn, ['http://', 'https://'])) {
            return $this->linkedIn;
        }
        return 'https://www.linkedin.com/in/' . $this->linkedIn;
    }

    // Accessor untuk mendapatkan teks tampilan LinkedIn (username)
    public function getLinkedInUsernameAttribute(): ?string
    {
        if (empty($this->linkedIn)) {
            return null;
        }
        if (Str::contains($this->linkedIn, 'linkedin.com/in/')) {
            return basename(parse_url($this->linkedIn, PHP_URL_PATH));
        }
        return $this->linkedIn;
    }
}
