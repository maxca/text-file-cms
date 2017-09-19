<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    protected $table = 'tmh_ir_benefit';
    protected $fillable = [
        'id',
        'step',
        'person',
        'type',
        'price',
        'created_at',
        'updated_at',
    ];
}
