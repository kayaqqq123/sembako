<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class goods extends Model
{
    protected $dates = ['expired_date'];
    protected $fillable = ['id','name', 'stock', 'input_barang','expired_date'];
}
