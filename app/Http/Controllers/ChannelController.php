<?php

namespace App\Http\Controllers;

use App\Models\Channel;


class ChannelController extends Controller
{
    public function index()
    {
        return Channel::query()
            ->with(request('with', []))
            ->search(request('query'))
            ->orderBy(request('sort', 'name'), request('order', 'asc'))
            ->simplePaginate(request('limit'));
    }

    public function show(Channel $channel)
    {
        return $channel->load(request('with', []));
    }
}
