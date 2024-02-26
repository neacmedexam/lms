<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CampaignModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_campaign';
    public $timestamps = false;
    protected $primaryKey = 'campaign_number';


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
