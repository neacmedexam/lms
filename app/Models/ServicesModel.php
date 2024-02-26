<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServicesModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_services';
    public $timestamps = false;
    protected $primaryKey = 'serviceID';


    public function scopeFilter($query,$fromDate,$toDate){
  
        if($fromDate && $toDate ?? false){

                $query->whereBetween(DB::raw('DATE(t1.dateCreated)'), [$fromDate, $toDate]);

            return $query;
        }
    }
    public function scopeSample($query,$fromDate,$toDate){
         $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$fromDate, $toDate]);
   

    return $query;
    }
}
