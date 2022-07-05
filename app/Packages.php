<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Packages extends Model
{
    use HasFactory;
    use HasSlug;

    public $table = 'packages';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'cost',
        'type',
        'time',
        'slug',
        'image',
        'status'
    ];
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['type', 'user_id', 'name'])
            ->saveSlugsTo('slug');
    }


    /**
     * Get the user that owns the Packages
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
