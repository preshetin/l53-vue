<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['receipt', 'amount'];
    
    protected $casts = [
        'receipt' => 'collection'
    ];
}
