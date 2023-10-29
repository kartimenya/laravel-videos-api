<?php

namespace App\Models;

use App\Traits\WithRelationship;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory, WithRelationship;

    protected static array $relationships = ['videos', 'playlists', 'user'];

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch(Builder $query, ?string $name)
    {
        return $query->where('name', 'like', '%'.$name.'%');
    }
}
