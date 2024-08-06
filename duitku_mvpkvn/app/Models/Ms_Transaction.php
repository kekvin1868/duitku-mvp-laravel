<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ms_Transaction extends Model
{
    const TYPE_CASH_IN = 'cash-in';
    const TYPE_CASH_OUT = 'cash-out';

    protected $table = 'ms_transactions';

    protected $fillable = [
        'dt_trc_amount',
        'dt_trc_type',
        'dt_trc_description',
        'dt_trc_invoice_id',
    ];

    public static function getTransactionTypes()
    {
        return [
            self::TYPE_CASH_IN,
            self::TYPE_CASH_OUT,
        ];
    }
}
