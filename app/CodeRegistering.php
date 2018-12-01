<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Log;

class CodeRegistering extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'phone';

}