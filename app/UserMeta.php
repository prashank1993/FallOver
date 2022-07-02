<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    use HasFactory;
    public $table = 'usermeta';

    protected $fillable = [
        'key',
        'value',
        'user_id',
    ];
}
