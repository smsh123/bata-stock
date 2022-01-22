<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    protected $table   = 'sell';
    protected $primaryKey = 'id';
    protected $fillable = ['bill_no', 'cust_name', 'cust_mobile', 'txnNo', 'article_no', 'article_size', 'quantity', 'article_price', 'total_price'];
}
