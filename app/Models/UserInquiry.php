<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInquiry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email',
        'type',
        'user_type',
        'content',
        'rating',
        'admin_response',
        'is_responded',
        'responded_at',
        'responded_by',
    ];

    protected $casts = [
        'is_responded' => 'boolean',
        'responded_at' => 'datetime',
    ];

    public function scopeQuestions($query)
    {
        return $query->where('type', 'question');
    }

    public function scopeReviews($query)
    {
        return $query->where('type', 'review');
    }

    public function scopeUnresponded($query)
    {
        return $query->where('is_responded', false);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'responded_by');
    }
}
