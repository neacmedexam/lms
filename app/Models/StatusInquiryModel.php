<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusInquiryModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_status';
    public $timestamps = false;
    protected $primaryKey = 'statusID';
}
