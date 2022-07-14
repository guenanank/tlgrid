<?php

namespace App\Models;

use App\MongoDB;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Models\Applications;

class Authorizations extends MongoDB
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['appId', 'rules'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'rules' => AsCollection::class
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'application:_id,name'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['rules_name'];

    /**
     * Get the application that owns the authorization.
     */
    public function application()
    {
        return $this->belongsTo(Applications::class, 'appId', '_id');
    }

    /**
     * Get the rules's viewable name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function rulesName(): Attribute
    {
        return Attribute::make(
            get: function($value, $attributes) {
                return implode(', ', array_map(function($rule) {
                    return strtoupper($rule);
                }, json_decode($attributes['rules'])));
            } 
        );
    }
}
