<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogUpdateBenefit extends Model
{
    protected $table = 'log_update_step';
    protected $fillable = [
        'id',
        'user_id',
        'username',
        'action',
        'id_step',
        'step_old',
        'step_new',
        'price_old',
        'price_new',
        'person_old',
        'person_new',
        'type_old',
        'type_new',
        'created_at',
        'updated_at',
    ];
}
