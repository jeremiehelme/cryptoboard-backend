<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{

    /**
     * @var string $table
     */
    protected $table = 'portfolio';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'name',
        'user_id',
        'value_invested',
    ];
    use HasFactory;
}
