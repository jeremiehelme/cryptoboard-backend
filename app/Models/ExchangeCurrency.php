<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeCurrency extends Model
{

    /**
     * @var string $table
     */
    protected $table = 'exchange_currencies';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'currency_id',
        'exchange_id',
        'quantity',
    ];
    use HasFactory;
}
