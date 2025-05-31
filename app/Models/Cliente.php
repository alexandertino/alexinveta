<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
        protected $fillable = [
    'nombres',
    'pri_ape',
    'seg_ape',
    'docu_tip',
    'docu_num',
    'telefono',
    'direccion'
];
}
