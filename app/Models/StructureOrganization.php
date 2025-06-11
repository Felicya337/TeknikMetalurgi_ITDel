<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StructureOrganization extends Model
{
    use HasFactory;

    protected $table = 'structureorganizations';

    protected $fillable = [
        'name',
        'title',
        'degree',
        'level',
        'parent_id',
        'image',
        'order',
        'is_active',
        'created_by',
        'updated_by',
    ];

    // Relationship with parent structure
    public function parent()
    {
        return $this->belongsTo(StructureOrganization::class, 'parent_id');
    }

    // Relationship with children structures
    public function children()
    {
        return $this->hasMany(StructureOrganization::class, 'parent_id');
    }

    // Relationship with the admin who created the structure
    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    // Relationship with the admin who updated the structure
    public function updater()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}
