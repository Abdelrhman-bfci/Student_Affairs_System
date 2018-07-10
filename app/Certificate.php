<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    //

    protected $fillable = [
        'Student_ID',
        'Certificate_ID',
        'name'
    ];
}
