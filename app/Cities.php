<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    public $table = 'cities';

    protected $fillable = [
        'name',
        'state_id',
    ];
}
