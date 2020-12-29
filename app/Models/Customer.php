<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table='customer';
    protected $primaryKey='cusId';
    protected $keyType='string';
    public $timestamps = false;




}
