<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPortfolio extends Model
{
    use HasFactory;
    public $table = 'user_portfolio';

    protected $fillable = [
        'key',
        'value',
        'user_id',
    ];

    /**
     * Get the user that owns the UserPortfolio
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
