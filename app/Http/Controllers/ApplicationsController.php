<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Http\Requests\StoreApplicationsRequest;
use App\Http\Requests\UpdateApplicationsRequest;
use App\Models\Applications;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Cache::rememberForever('applications:all', function () {
            return Applications::all();
        });

        if ($applications->isEmpty()) {
            return view('stisla.components.empty-state', ['target' => route('applications.create')]);
        }

        return view('stisla.applications.index', compact('applications'));
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

        return view('stisla.applications.create', compact('applications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApplicationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApplicationsRequest $request)
    {
        $create = Applications::create($request->validated());
        Cache::forget('applications:all');
        Cache::forever('applications:' . $create->id, $create);
        return response()->json($create);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Applications  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Applications $application)
    {
        $applications = Cache::get('applications:all', function () {
            return Applications::all();
        })->pluck('name', 'id');

        return view('stisla.applications.edit', compact('applications', 'application'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApplicationsRequest  $request
     * @param  \App\Models\Applications  $application
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApplicationsRequest $request, Applications $application)
    {
        $update = $application->update($request->validated());
        Cache::forget('applications:' . $application->id);
        Cache::forget('applications:all');
        Cache::forever('applications:' . $application->id, $application);
        return response()->json($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Applications  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applications $application)
    {
        Cache::forget('applications:all');
        Cache::forget('applications:' . $application->id);
        $delete = $application->delete();
        return response()->json($delete);
    }
}
