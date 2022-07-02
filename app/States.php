<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    use HasFactory;
    public $table = 'states';

    protected $fillable = [
        'name',
        'country_id',
    ];
}
