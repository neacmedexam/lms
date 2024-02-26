<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadSourceModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_leadsource';
    public $timestamps = false;
    protected $primaryKey = 'leadsourceID';
}
