<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper_cate extends Model
{
    protected $table = 'paper_cate';
    protected $primaryKey = 'cate_id';

    public $timestamps = false;

    protected $guarded = [];
}
