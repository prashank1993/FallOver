<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;
    public $table = 'countries';

    protected $fillable = [
        'shortname',
        'name',
        'phonecode',
    ];
}
