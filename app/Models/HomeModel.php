<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_inquiries';
    public $timestamps = false;
    protected $primaryKey = 'inquiryID';

    public function scopeFilter($query,$fromDate,$toDate){
      
        if($fromDate && $toDate ?? false){
            $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$fromDate, $toDate]);
     
            return $query;

        }
    
   
    
    }


}
