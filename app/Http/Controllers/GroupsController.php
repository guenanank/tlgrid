<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreGroupsRequest;
use App\Http\Requests\UpdateGroupsRequest;
use App\Models\Groups;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Cache::rememberForever('groups:all', function () {
            return Groups::with('media')->get();
        });

        if ($groups->isEmpty()) {
            return view('stisla.components.empty-state', ['target' => route('groups.create')]);
        }

        return view('stisla.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stisla.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGroupsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupsRequest $request)
    {
        $create = Groups::create($request->validated());
        Cache::forget('groups:all');
        Cache::forever('groups:' . $create->id, $create);
        return response()->json($create);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function edit(Groups $group)
    {
        return view('stisla.groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupsRequest  $request
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupsRequest $request, Groups $group)
    {
        $update = $group->update($request->validated());
        Cache::forget('groups:' . $group->id);
        Cache::forget('groups:all');
        Cache::forever('groups:' . $group->id, $group);
        return response()->json($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Groups  $groups
     * @return \Illuminate\Http\Response
     */
    public function destroy(Groups $group)
    {
        Cache::forget('groups:all');
        Cache::forget('groups:' . $group->id);
        $delete = $group->delete();
        return response()->json($delete);
    }
}
