<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioCurrency extends Model
{

    /**
     * @var string $table
     */
    protected $table = 'portfolio_currencies';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'currency_id',
        'portfolio_id',
        'quantity',
        'invested',
    ];
    use HasFactory;
}
