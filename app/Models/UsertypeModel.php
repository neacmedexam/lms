<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsertypeModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_usertype';
    public $timestamps = false;
    protected $primaryKey = 'utID';
}
