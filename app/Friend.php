<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'friend';
    protected $primaryKey = 'w_id';

    public $timestamps = false;

    protected $guarded = [];
}
