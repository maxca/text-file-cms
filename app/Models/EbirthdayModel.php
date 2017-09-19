<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EbirthdayModel extends Model
{
    protected $table = 'transaction_request_url';
    protected $fillable = [
        'id',
        'name',
        'msisdn',
        'sender',
        'url',
        'short_url',
        'response',
    ];

    protected $casts = [
        'response' => 'array',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'response',
    ];
}
