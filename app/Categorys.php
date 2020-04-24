<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorys extends Model
{
    protected $table = 'Categorys';
    protected $primaryKey = 'cate_id';

    public $timestamps = false;

    protected $guarded = [];
}
