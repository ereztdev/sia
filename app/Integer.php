<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integer extends Model
{
    protected $table = 'integers';
    protected $fillable = ['integer', 'is_current'];



}
