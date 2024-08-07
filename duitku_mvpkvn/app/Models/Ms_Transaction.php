<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ms_Transaction extends Model
{
    const TYPE_CASH_IN = 'cash-in';
    const TYPE_CASH_OUT = 'cash-out';

    const PAYMENT_CREDIT_CARD = 'credit-card';
    const PAYMENT_RETAIL = 'retail';
    const PAYMENT_E_WALLET = 'e-wallet';
    const PAYMENT_QRIS = 'qris';
    const PAYMENT_CREDIT = 'credit';

    // Bank Credit Card
    const BANK_VISA = 'Visa';
    const BANK_MASTERCARD = 'MasterCard';
    const BANK_JCB = 'JCB';

    // Bank Virtual Account
    const BANK_VA_BCA = 'BCA';
    const BANK_VA_MANDIRI = 'Mandiri';
    const BANK_VA_MAYBANK = 'Maybank';
    const BANK_VA_BNI = 'BNI';
    const BANK_VA_CIMB = 'CIMB';
    const BANK_VA_PERMATA = 'Permata Bank';
    const BANK_VA_ATM_BERSAMA = 'ATM Bersama';
    const BANK_VA_ARTHA_GRAHA = 'Bank Artha Graha';
    const BANK_VA_NEO = 'Bank Neo';
    const BANK_VA_BRIVA = 'BRIVA';
    const BANK_VA_BSS = 'BSS';
    const BANK_VA_DANAMON = 'Danamon';
    const BANK_VA_BSI = 'BSI';

    // Bank Retail
    const BANK_RETAIL_ALFA = 'Alfa';
    const BANK_RETAIL_INDOMARET = 'Indomaret';

    // Bank E-Wallet
    const BANK_EWALLET_OVO = 'OVO';
    const BANK_EWALLET_SHOPEE = 'Shopee';
    const BANK_EWALLET_LINKAJA_FIXED_FEE = 'LinkedAja (Fixed Fee)';
    const BANK_EWALLET_LINKAJA_PERCENTAGE = 'LinkAja (Percentage)';
    const BANK_EWALLET_DANA = 'DANA';
    const BANK_EWALLET_SHOPEEPAY = 'Shopee Pay';
    const BANK_EWALLET_JENIUS_PAY = 'Jenius Pay';

    // Bank QRIS
    const BANK_QRIS_SHOPEEPAY = 'Shopee Pay';
    const BANK_QRIS_LINKAJA = 'LinkAja';
    const BANK_QRIS_NOBU = 'Nobu';
    const BANK_QRIS_DANA = 'DANA';
    const BANK_QRIS_GUDANG_VOUCHER = 'Gudang Voucher';
    const BANK_QRIS_NUSAPAY = 'Nusapay';

    // Bank Credit
    const BANK_CREDIT_INDODANA_PAY = 'Indodana Pay';
    const BANK_CREDIT_CREDIT_ATOME = 'ATOME';

    protected $table = 'ms_transactions';

    protected $fillable = [
        'dt_trc_amount',
        'dt_trc_type',
        'dt_trc_description',
        'dt_trc_invoice_id',
        'dt_trc_payment',
        'dt_trc_bank',
        'dt_trc_transfer_amount',
        'dt_trc_status'
    ];

    public static function getTransactionTypes()
    {
        return [
            self::TYPE_CASH_IN,
            self::TYPE_CASH_OUT,
        ];
    }

    public static function getPaymentTypes()
    {
        return [
            self::PAYMENT_CREDIT_CARD,
            self::PAYMENT_RETAIL,
            self::PAYMENT_E_WALLET,
            self::PAYMENT_QRIS,
            self::PAYMENT_CREDIT,
        ];
    }

    public static function getBankTypes()
    {
        return [
            self::BANK_VISA,
            self::BANK_MASTERCARD,
            self::BANK_JCB,
            self::BANK_VA_BCA,
            self::BANK_VA_MANDIRI,
            self::BANK_VA_MAYBANK,
            self::BANK_VA_BNI,
            self::BANK_VA_CIMB,
            self::BANK_VA_PERMATA,
            self::BANK_VA_ATM_BERSAMA,
            self::BANK_VA_ARTHA_GRAHA,
            self::BANK_VA_NEO,
            self::BANK_VA_BRIVA,
            self::BANK_VA_BSS,
            self::BANK_VA_DANAMON,
            self::BANK_VA_BSI,
            self::BANK_RETAIL_ALFA,
            self::BANK_RETAIL_INDOMARET,
            self::BANK_EWALLET_OVO,
            self::BANK_EWALLET_SHOPEE,
            self::BANK_EWALLET_LINKAJA_FIXED_FEE,
            self::BANK_EWALLET_LINKAJA_PERCENTAGE,
            self::BANK_EWALLET_DANA,
            self::BANK_EWALLET_SHOPEEPAY,
            self::BANK_EWALLET_JENIUS_PAY,
            self::BANK_QRIS_SHOPEEPAY,
            self::BANK_QRIS_LINKAJA,
            self::BANK_QRIS_NOBU,
            self::BANK_QRIS_DANA,
            self::BANK_QRIS_GUDANG_VOUCHER,
            self::BANK_QRIS_NUSAPAY,
            self::BANK_CREDIT_INDODANA_PAY,
            self::BANK_CREDIT_CREDIT_ATOME,
        ];
    }
}
