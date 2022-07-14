<?php

namespace App\Models;

use App\MongoDB;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Casts\AsCollection;

class Applications extends MongoDB
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'target', 'sub', 'icon'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['descendant'];

    /**
     * Get the application that owns the parent.
     */
    public function parent()
    {
        return $this->belongsTo(self::class, '_id', 'sub');
    }

    /**
     * Get the application that owns the child.
     */
    public function children()
    {
        return $this->hasMany(self::class, 'sub', '_id');
    }

    /**
     * Get all the application descendant
     */
    public function descendant()
    {
        return $this->children()->with('descendant');
    }
}
