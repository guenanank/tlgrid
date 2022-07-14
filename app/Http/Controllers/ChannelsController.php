<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreChannelsRequest;
use App\Http\Requests\UpdateChannelsRequest;
use App\Models\Groups;
use App\Models\Channels;

class ChannelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Cache::rememberForever('channels:all', function () {
            return Channels::all();
        });

        if ($channels->isEmpty()) {
            return view('stisla.components.empty-state', ['target' => route('channels.create')]);
        }

        return view('stisla.channels.index', compact('channels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Cache::get('groups:all', function() {
            return Groups::all();
        });

        $parent = Channels::all();
        return view('stisla.channels.create', compact('groups', 'parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChannelsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChannelsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Channels  $channels
     * @return \Illuminate\Http\Response
     */
    public function show(Channels $channels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Channels  $channels
     * @return \Illuminate\Http\Response
     */
    public function edit(Channels $channels)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChannelsRequest  $request
     * @param  \App\Models\Channels  $channels
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChannelsRequest $request, Channels $channels)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Channels  $channels
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channels $channels)
    {
        //
    }
}
