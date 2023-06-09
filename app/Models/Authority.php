<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    //use HasFactory;
    protected $table = 'authority';
    protected $primaryKey = 'IdAuthority';

    protected $fillable = [
        'IdState',
        'Name'
    ];

    public $timestamps = false;
}
