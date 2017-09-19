<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'tmh_ir_request_transaction';
    protected $fillable = [
        'id',
        'transaction_id',
        'msisdn',
        'x_rat',
        'x_oper',
        'x_imei',
        'ip_address',
        'operator',
        'action',
        'step',
        'type',
        'mcc_mnc',
        'os',
        'device',
        'browser',
        'user_agent',
        'page',
        'request_param',
        'response',
        'response_time',
        'header',
        'warning_level',
        'accepted',
        'country_code',
        'country_name_en',
        'country_name_th',
        'operator_en',
        'operator_th',
        'created_at',
        'updated_at',
    ];
}
