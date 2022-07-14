<?php

namespace App\Models;

use App\MongoDB;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\AsCollection;

use Illuminate\Support\Str;

use App\Models\Media;

class Channels extends MongoDB
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mediaId', 'name', 'slug', 'sub', 'isDisplayed', 'sort', 'meta', 'analytics', 'oId'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isDisplayed' => 'boolean',
        'analytics' => AsCollection::class,
        'meta' => AsCollection::class,
        'sort' => 'int'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['media:_id,name', 'parent', 'children'];

    /**
     * Get the channels that owns the parent.
     */
    public function parent()
    {
        return $this->belongsTo(Channels::class, '_id', 'sub');
    }

    /**
     * Get the channels that owns the child.
     */
    public function children()
    {
        return $this->hasMany(Channels::class, 'sub', '_id');
    }

    /**
     * Get the media that owns the channels.
     */
    public function media()
    {
        return $this->belongsTo(Media::class, 'mediaId', '_id');
    }

    /**
     * Set the channel slug.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::of($value)->slug('-');
    }
}
