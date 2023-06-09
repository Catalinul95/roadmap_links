<?php

namespace App\Models;

use App\Models\Node;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Roadmap extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'date:Y-m-d'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function nodes()
    {
        return $this->hasMany(Node::class, 'parent_id', 'id');
    }

    public function mainNode()
    {
        return $this->hasOne(Node::class, 'roadmap_id', 'id');
    }

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }
}
