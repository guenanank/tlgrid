<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreAuthorizationsRequest;
use App\Http\Requests\UpdateAuthorizationsRequest;
use App\Models\Authorizations;
use App\Models\Applications;

class AuthorizationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authorizations = Cache::rememberForever('authorizations:all', function () {
            return Authorizations::all();
        });

        if ($authorizations->isEmpty()) {
            return view('stisla.components.empty-state', ['target' => route('authorizations.create')]);
        }

        return view('stisla.authorizations.index', compact('authorizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $applications = Cache::get('applications:all', function () {
            return Applications::all();
        })->pluck('name', 'id');

        return view('stisla.authorizations.create', compact('applications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAuthorizationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuthorizationsRequest $request)
    {
        $create = Authorizations::create($request->validated());
        Cache::forget('authorizations:all');
        Cache::forever('authorizations:' . $create->id, $create);
        return response()->json($create);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Authorizations  $authorization
     * @return \Illuminate\Http\Response
     */
    public function edit(Authorizations $authorization)
    {
        $applications = Cache::get('applications:all', function () {
            return Applications::all();
        })->pluck('name', 'id');

        return view('stisla.authorizations.edit', compact('applications', 'authorization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuthorizationsRequest  $request
     * @param  \App\Models\Authorizations  $authorization
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuthorizationsRequest $request, Authorizations $authorization)
    {
        $update = $authorization->update($request->validated());
        Cache::forget('authorizations:' . $authorization->id);
        Cache::forget('authorizations:all');
        Cache::forever('authorizations:' . $authorization->id, $authorization);
        return response()->json($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Authorizations  $authorization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Authorizations $authorization)
    {
        Cache::forget('authorizations:all');
        Cache::forget('authorizations:' . $authorization->id);
        $delete = $authorization->delete();
        return response()->json($delete);
    }
}
