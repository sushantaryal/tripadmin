<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amadeus extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'amadeus';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['auth_at', 'access_token', 'expires_in', 'state'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'auth_at' => 'datetime',
        'expires_in' => 'integer'
    ];
}
