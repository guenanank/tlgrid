<?php

namespace App\Models;

use App\MongoDB;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\AsCollection;

use App\Models\Media;

class Groups extends MongoDB
{
    use HasFactory, SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['code', 'name', 'analytics', 'meta'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta' => AsCollection::class
    ];

    /**
     * Set the group's code.
     *
     * @param  string  $value
     * @return void
     */
    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }

    /**
     * Get the media that owns the group.
     */
    public function media()
    {
        return $this->hasMany(Media::class, 'groupId', '_id');
    }
}
