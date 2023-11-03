<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        return Video::query()
            ->withRelationships(request('with', []))
            ->fromPeriod(Period::tryFrom(request('period')))
            ->search(request('que ry'))
            ->orderBy(request('sort', 'created_at'), request('order', 'desc'))
            ->paginate(request('limit'))
            ->withQueryString();
    }

    public function show(Video $video): Video
    {
        return $video->loadRelationships(request('with', []));
    }
}
