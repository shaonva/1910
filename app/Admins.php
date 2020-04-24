<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'admin_id';

    public $timestamps = false;

    protected $guarded = [];
}
