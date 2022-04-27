<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    /**
     * @var string $table
     */
    protected $table = 'currency';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'symbol',
    ];
    use HasFactory;
}
