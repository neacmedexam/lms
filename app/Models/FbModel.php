<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FbModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_fbanalytics';
    public $timestamps = false;
    protected $primaryKey = 'fbanalytics_number';

    public function scopeFilter($query, array $filters,$month,$year){

        
        // dd($filters['search']);
        if(!$month && !$year){
            
            // $query->where('month', '=', $month)
            // ->where('year', '=', $year);
            
        }
        //mema
        if($filters['search'] ?? false){
           
        }
        elseif($month && $year ?? false){

                $query->where('month', '=', $month)
                ->where('year', '=', $year);

                // $query->select( DB::raw('ifnull(tbl_campaign.reach,0) as reach'))
                // ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
                // ->where('month', '=', $month)
                // ->where('year', '=', $year)
                // ->orderBy('tbl_months.month_number');
            
         
        }
        elseif(!$month && $year ?? false){

            $query->where('year', '=', $year);
       
     
        }
        elseif($month && !$year ?? false){

        }
        // elseif(!$month && $year ?? false){

        //     $query->where('year', '=', $year);
    
        // }
        // elseif($month && !$year ?? false){

        //     $query->where('month', '=', $month);
  
        // }
    }
}
