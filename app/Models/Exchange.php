<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'exchange';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'name',
        'exchange_id',
        'api_key',
        'secret_key',
        'user_id'
    ];


    use HasFactory;
}
