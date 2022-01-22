<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table   = 'articles';
    protected $primaryKey = 'id';
    protected $fillable = ['article_type', 'article_no', 'age_group', 's_1', 's_2', 's_3', 's_4', 's_5', 's_6', 's_7', 's_8', 's_9', 's_10', 's_11', 's_12', 's_13', 'price'];
}
