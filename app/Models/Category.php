<?php

namespace App\Models;

use App\Traits\WithRelationship;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, WithRelationship;

    protected static array $relationships = ['videos'];

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    public function scopeSearch(Builder $query, ?string $name)
    {
        return $query->where('name', 'like', '%'.$name.'%');
    }
}
