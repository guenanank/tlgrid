<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

// use Illuminate\Http\Request;

use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Models\Media;
use App\Models\Groups;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $media = Cache::rememberForever('media:all', function () {
            return Media::with('group')->get();
        });

        if ($media->isEmpty()) {
            return view('stisla.components.empty-state', ['target' => route('media.create')]);
        }

        return view('stisla.media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Cache::get('groups:all', function () {
            return Groups::all();
        })->pluck('name', 'id');

        return view('stisla.media.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMediaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMediaRequest $request)
    {
        $data = $request->validated();
        $group = Cache::get('groups:' . $request->groupId);
        $path = sprintf('%s/%s/media/', Str::slug($group->code), Str::slug($request->name));

        if ($request->hasFile('assets.logo')) {
            $logo = sprintf('%s-logo.%s', Str::slug($data['name']), $data['assets']['logo']->extension());
            Storage::putFileAs($path, $data['assets']['logo'], $logo);
            $data['assets']['logo'] = [
                'path' => $path,
                'filename' => $logo,
            ];
        } else {
            $data['assets']['logo'] = [];
        }

        if ($request->hasFile('assets.logoAlt')) {
            $logoAlt = sprintf('%s-logo-alt.%s', Str::slug($data['name']), $data['assets']['logoAlt']->extension());
            Storage::putFileAs($path, $data['assets']['logoAlt'], $logoAlt);
            $data['assets']['logoAlt'] = [
                'path' => $path,
                'filename' => $logoAlt,
            ];
        } else {
            $data['assets']['logoAlt'] = [];
        }

        if ($request->hasFile('assets.icon')) {
            $icon = sprintf('%s-icon.%s', Str::slug($data['name']), $data['assets']['icon']->extension());
            Storage::putFileAs($path, $data['assets']['icon'], $icon);
            $data['assets']['icon'] = [
                'path' => $path,
                'filename' => $icon,
            ];
        } else {
            $data['assets']['icon'] = [];
        }

        if ($request->hasFile('assets.css')) {
            // collect($data['assets']['css'])->map(function ($css) use ($path) {
            //     Storage::putFileAs($path, $css);
            // });
            $data['assets']['css'] = [
                'path' => sprintf('%s/css', $path),
                'filename' => $request->file('assets.css'),
            ];
        } else {
            $data['assets']['css'] = [];
        }

        if ($request->hasFile('assets.js')) {
            // collect($data['assets']['js'])->map(function ($js) use ($path) {
            //     Storage::putFileAs($path, $js);
            // });
            $data['assets']['js'] = [
                'path' => sprintf('%s/js', $path),
                'filename' => $request->file('assets.js'),
            ];
        } else {
            $data['assets']['js'] = [];
        }

        $create = Media::create($data);
        Cache::forget('media:all');
        Cache::forever('media:' . $create->id, $create);
        return response()->json($create);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $medium)
    {
        $groups = Cache::get('groups:all', function () {
            return Groups::all();
        })->pluck('name', 'id');

        return view('stisla.media.edit', compact('medium', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMediaRequest  $request
     * @param  \App\Models\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMediaRequest $request, Media $medium)
    {
        $data = $request->validated();
        $group = Cache::get('groups:' . $request->groupId);
        $path = sprintf('%s/%s/media/', Str::slug($group->code), Str::slug($data['name']));

        if ($request->hasFile('assets.logo')) {
            $logo = sprintf('%s-logo.%s', Str::slug($data['name']), $data['assets']['logo']->extension());
            Storage::putFileAs($path, $data['assets']['logo'], $logo);
            $data['assets']['logo'] = [
                'path' => $path,
                'filename' => $logo,
            ];
        } else {
            $data['assets']['logo'] = $medium->assets['logo'] ?? $medium->assets['logo'];
        }

        if ($request->hasFile('assets.logoAlt')) {
            $logoAlt = sprintf('%s-logo-alt.%s', Str::slug($data['name']), $data['assets']['logoAlt']->extension());
            Storage::putFileAs($path, $data['assets']['logoAlt'], $logoAlt);
            $data['assets']['logoAlt'] = [
                'path' => $path,
                'filename' => $logoAlt,
            ];
        } else {
            $data['assets']['logoAlt'] = $medium->assets['logoAlt'] ?? $medium->assets['logoAlt'];
        }

        if ($request->hasFile('assets.icon')) {
            $icon = sprintf('%s-icon.%s', Str::slug($data['name']), $data['assets']['icon']->extension());
            Storage::putFileAs($path, $data['assets']['icon'], $icon);
            $data['assets']['icon'] = [
                'path' => $path,
                'filename' => $icon,
            ];
        } else {
            $data['assets']['icon'] = $medium->assets['icon'] ?? $medium->assets['icon'];
        }

        if ($request->hasFile('assets.css')) {
            // collect($data['assets']['css'])->map(function ($css) use ($path) {
            //     Storage::putFileAs(sprintf('%s/css', $path), $css);
            // });
            $data['assets']['css'] = [
                'path' => sprintf('%s/css', $path),
                'filename' => [],
            ];
        } else {
            $data['assets']['css'] = $medium->assets['css'] ?? $medium->assets['css'];
        }

        if ($request->hasFile('assets.js')) {
            // collect($data['assets']['js'])->map(function ($js) use ($path) {
            //     Storage::putFileAs(sprintf('%s/js', $path), $js);
            // });
            $data['assets']['js'] = [
                'path' => sprintf('%s/js', $path),
                'filename' => [],
            ];
        } else {
            $data['assets']['js'] = $medium->assets['js'] ?? $medium->assets['js'];
        }

        $update = $medium->update($data);
        Cache::forget('media:' . $medium->id);
        Cache::forget('media:all');
        Cache::forever('media:' . $medium->id, $medium);
        return response()->json($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $medium)
    {
        if ($medium->has('group') || $medium->group->isNotEmpty()) {
            $path = sprintf('%s/%s/media/', Str::slug($medium->group->code), Str::slug($medium->name));
            Storage::deleteDirectory($path);
        }
        Cache::forget('media:' . $medium->id);
        Cache::forget('media:all');
        $delete = $medium->delete();
        return response()->json($delete);
    }
}
