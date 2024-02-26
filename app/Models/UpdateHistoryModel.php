<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateHistoryModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_updatehistory';
    public $timestamps = false;
    protected $primaryKey = 'updateID';
    protected $fillable = [
        'accountID', 'title', 'description','inquiryID','createdBy'
    ];
}
