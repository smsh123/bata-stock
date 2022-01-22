<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table   = 'customer';
    protected $primaryKey = 'mobile';
    protected $fillable = ['name', 'mobile']; 
}
