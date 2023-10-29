<?php

namespace App\Models;

use App\Enums\Period;
use App\Traits\WithRelationship;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory, WithRelationship;

    protected static array $relationships = ['channel', 'playlists', 'categories'];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeFromPeriod(Builder $query, ?Period $period): Builder
    {
        return $period ? $query->where('created_at', '>=', $period->date()) : $query;
    }

    public function scopeSearch(Builder $query, ?string $text)
    {
        return $query->where(function ($query) use ($text){
            $query->where('title', 'like', '%'.$text.'%')
                ->orWhere('description', 'like', '%'.$text.'%');
        });
    }
}
