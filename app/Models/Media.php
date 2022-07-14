<?php

namespace App\Models;

use App\MongoDB;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\AsCollection;

use App\Models\Groups;

class Media extends MongoDB
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['groupId', 'name', 'domain', 'analytics', 'meta', 'assets', 'social', 'masthead', 'oId'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'analytics' => AsCollection::class,
        'meta' => AsCollection::class,
        'assets' => AsCollection::class,
        'assets.js' => AsCollection::class,
        'assets.css' => AsCollection::class,
        'social' => AsCollection::class,
        'social.facebook' => AsCollection::class,
        'masthead' => AsCollection::class
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'group:_id,name'
    ];

    /**
     * Get the group that owns the media.
     */
    public function group()
    {
        return $this->belongsTo(Groups::class, 'groupId', '_id');
    }

    /**
     * Get the media that owns the channels.
     */
    // public function channels()
    // {
    //     return $this->hasMany(Channels::class, 'mediaId', '_id');
    // }

}
