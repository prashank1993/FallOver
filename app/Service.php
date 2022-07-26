<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Service extends Model
{
    use HasFactory;
    use HasSlug;

    public $table = 'services';

    protected $fillable = [
        'name',
        'description',
        'slug',
        'status',
    ];

    // public function parentCategory()
    // {
    //     return $this->belongsTo(self::class, 'parent');
    // }

    // public function childCategory()
    // {
    //     return $this->hasMany(self::class, 'parent');
    // }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
