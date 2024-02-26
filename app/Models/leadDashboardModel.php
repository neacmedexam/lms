<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class leadDashboardModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_inquiries';
    public $timestamps = false;
    protected $primaryKey = 'inquiryID';
    
    public function scopeFilter($query, array $filters,$searchdate,$searchdateend,$salesofficer,$leadcapture,$countryReside, $inquiryType){

  
       
        // dd($filters['search']);
        // if($filters['search'] ?? false){
        //     $query->where('tbl_inquiries.inquiryID', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_leadsource.leadSourceName', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_inquiries.applicantFirstName', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_inquiries.applicantLastName', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_inquiries.fbName', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_inquiries.email', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_inquiries.phoneNumber', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_inquiries.countryReside', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_services.serviceName', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_status.statusName', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_inquiries.datePaid', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_scoring.scoringName', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_inquiries.assignedLC', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_inquiries.notes', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_inquiries.representative', 'like', '%' . request('search') . '%')
        //     // ->orWhere('tbl_usertype.utName', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_inquiries.dateCreated', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_inquiries.modifiedBy', 'like', '%' . request('search') . '%')
        //     ->orWhere('tbl_inquiries.dateModified', 'like', '%' . request('search') . '%');
        // }
            // dd($filters['search']);
        
        $ref = (isset($_GET['ref'])) ? trim($_GET['ref']) : '';
        $ref_val = (isset($_GET['ref_val'])) ? trim($_GET['ref_val']) : '';
        $searchdate = (isset($_GET['datestart'])) ? trim($_GET['datestart']) : '';
        
        
        
        
        //MEMA
        if($filters['search'] ?? false){
            $query->orWhere(DB::raw('DATE(tbl_inquiries.dateCreated)'), 'like', '%' . $searchdate . '%')
            ->orWhereRaw('tbl_inquiries.representative IN ('.$salesofficer.')')
            ->orWhere('tbl_inquiries.inquiryLeadSource', 'like', '%' . $leadcapture . '%');
            dd($query);
        }
        

        // //DATE, SALES OFFICER, LEAD CAPTURE, COUNTRY, AND INQUIRY TYPE
        // else if($searchdate && $searchdateend && $salesofficer && $leadcapture && $countryReside && $inquiryType ?? false){
                
        //     $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //     ->whereRaw('tbl_inquiries.representative IN ('.$salesofficer.')')
        //     ->where('tbl_inquiries.inquiryLeadSource', '=', $leadcapture)
        //     ->where('tbl_inquiries.countryReside', '=', $countryReside)
        //     ->where('tbl_inquiries.inquiryType', '=', $inquiryType);

        // }
        
        // //DATE, SALES OFFICER, LEAD CAPTURE, and COUNTRY
        // else if($searchdate && $searchdateend && $salesofficer && $leadcapture && $countryReside ?? false){
                
        //     $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //     ->whereRaw('tbl_inquiries.representative IN ('.$salesofficer.')')
        //     ->where('tbl_inquiries.inquiryLeadSource', '=', $leadcapture)
        //     ->where('tbl_inquiries.countryReside', '=', $countryReside);

        // }
        
        // //DATE, SALES OFFICER, LEAD CAPTURE, and INQUIRY TYPE
        // else if($searchdate && $searchdateend && $salesofficer && $leadcapture && $inquiryType ?? false){
                
        //     $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //     ->whereRaw('tbl_inquiries.representative IN ('.$salesofficer.')')
        //     ->where('tbl_inquiries.inquiryLeadSource', '=', $leadcapture)
        //     ->where('tbl_inquiries.inquiryType', '=', $inquiryType);

        // }
        
        // //DATE, LEAD CAPTURE, COUNTRY, and INQUIRY TYPE
        // else if($searchdate && $searchdateend && $leadcapture && $countryReside && $inquiryType ?? false){
                
        //     $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //     ->where('tbl_inquiries.inquiryLeadSource', '=', $leadcapture)
        //     ->where('tbl_inquiries.countryReside', '=', $countryReside)
        //     ->where('tbl_inquiries.inquiryType', '=', $inquiryType);

        // }
        
        //  //DATE, SALES OFFICER, COUNTRY, and INQUIRY TYPE
        // else if($searchdate && $searchdateend && $salesofficer && $countryReside && $inquiryType ?? false){
                
        //     $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //     ->whereRaw('tbl_inquiries.representative IN ('.$salesofficer.')')
        //     ->where('tbl_inquiries.countryReside', '=', $countryReside)
        //     ->where('tbl_inquiries.inquiryType', '=', $inquiryType);

        // }
        
        // //DATE, SALES OFFICER, AND LEAD CAPTURE
        // else if($searchdate && $searchdateend && $salesofficer && $leadcapture?? false){
        
        //     $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //     ->whereRaw('tbl_inquiries.representative IN ('.$salesofficer.')')
        //     ->where('tbl_inquiries.inquiryLeadSource', '=', $leadcapture);

        // }
        
        // //DATE, LEAD CAPTURE, AND COUNTRY
        // else if($searchdate && $searchdateend && $leadcapture && $countryReside?? false){
            
            
        //     if($countryReside == "Unknown"){
        
        //              $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //                 ->where('tbl_inquiries.inquiryLeadSource', '=', $leadcapture)
        //                 ->whereNull('tbl_inquiries.countryReside')
        //                 ->orWhere('tbl_inquiries.countryReside','=','N/A');

              
        //     }
        //     else{
        //              $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //             ->where('tbl_inquiries.inquiryLeadSource', '=', $leadcapture)
        //             ->where('tbl_inquiries.countryReside', '=', $countryReside);
         
        //     }
          
        //     // $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //     // ->where('tbl_inquiries.representative', '=', $salesofficer)
        //     // ->where('tbl_inquiries.countryReside', '=', $countryReside);

        // }
        
        // //DATE, SALES OFFICER, AND COUNTRY
        // else if($searchdate && $searchdateend && $salesofficer && $countryReside?? false){
            
            
        //     if($countryReside == "Unknown"){
        
        //              $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //                 ->whereRaw('tbl_inquiries.representative IN ('.$salesofficer.')')
        //                 ->whereNull('tbl_inquiries.countryReside')
        //                 ->orWhere('tbl_inquiries.countryReside','=','N/A');
                       

              
        //     }
        //     else{
        //              $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //             ->whereRaw('tbl_inquiries.representative IN ('.$salesofficer.')')
        //             ->where('tbl_inquiries.countryReside', '=', $countryReside);
              
                
         
        //     }
          
        //     // $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //     // ->where('tbl_inquiries.representative', '=', $salesofficer)
        //     // ->where('tbl_inquiries.countryReside', '=', $countryReside);

        // }

        // //DATE ONLY
        // else if($searchdate && $searchdateend && !$salesofficer && !$leadcapture && !$countryReside?? false){
      
        //     $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend]);
            
        // }

        // //SALES OFFICER ONLY
        // else if(!$searchdate && !$searchdateend && $salesofficer && !$leadcapture && !$countryReside?? false){
        

        //     $query->whereRaw('tbl_inquiries.representative IN ('.$salesofficer.')');
    
         
        // }

        // //LEAD CAPTURE ONLY
        // else if(!$searchdate && !$searchdateend && !$salesofficer && $leadcapture && !$countryReside?? false){
        
        //     $query->where('tbl_inquiries.inquiryLeadSource', '=', $leadcapture);
          

        // }

        //  //COUNTRY RESIDE ONLY
        //  else if(!$searchdate && !$searchdateend && !$salesofficer && !$leadcapture && $countryReside ?? false){
            
        //     if($countryReside == "Unknown"){
          
        //         $query->whereNull('tbl_inquiries.countryReside')
        //         ->orWhere('tbl_inquiries.countryReside','=','N/A');
              
        //     }
        //     else{
        //         $query->where('tbl_inquiries.countryReside','=', $countryReside);
                
         
        //     }
          
              
        // }
        // //DATE and SALES OFFICER
        // else if($searchdate && $searchdateend && $salesofficer && !$leadcapture?? false){
        
        //     $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //     ->where('tbl_inquiries.representative', '=', $salesofficer);

        // }
        // //DATE AND LEAD CAPTURE
        // else if($searchdate && $searchdateend && !$salesofficer && $leadcapture?? false){
        
            
        //     $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //     ->where('tbl_inquiries.inquiryLeadSource', '=', $leadcapture);
           
         
        // }

        // //DATE AND COUNTRY
        // else if($searchdate && $searchdateend && !$salesofficer && !$leadcapture && $countryReside ?? false){
             
        //     if($countryReside == "Unknown"){
                 
        //         $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //         ->whereNull('tbl_inquiries.countryReside')
        //         ->orWhere('tbl_inquiries.countryReside','=','N/A');
        //      }   
        //      else{
        //         $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend])
        //         ->where('tbl_inquiries.countryReside','=', $countryReside); 
                    
        //      }
        //     // $query->whereRaw("DATE(tbl_inquiries.dateCreated) BETWEEN $searchdate AND $searchdateend AND tbl_inquiries.countryReside is null");
        
        // }


        // //SALES OFFICER AND LEAD CAPTURE
        // else if(!$searchdate && !$searchdateend && $salesofficer && $leadcapture?? false){
        

        //     $query->whereRaw('tbl_inquiries.representative IN ('.$salesofficer.')')
        //     ->where('tbl_inquiries.inquiryLeadSource', '=', $leadcapture);
          
         
        // }

        
        // //SALES OFFICER AND COUNTRY
        // else if(!$searchdate && !$searchdateend && $salesofficer && !$leadcapture && $countryReside?? false){
        
        //     if($countryReside == "Unknown"){
                 
        //         $query->whereRaw('tbl_inquiries.representative IN ('.$salesofficer.')')
        //         ->whereNull('tbl_inquiries.countryReside')
        //         ->orWhere('tbl_inquiries.countryReside','=','N/A');
        //      }   
        //      else{
        //         $query->whereRaw('tbl_inquiries.representative IN ('.$salesofficer.')')
        //         ->where('tbl_inquiries.countryReside', '=', $countryReside);
        //      }
    
          
         
        // }

        
        // //LEAD CAPTURE AND COUNTRY
        // else if(!$searchdate && !$searchdateend && !$salesofficer && $leadcapture && $countryReside?? false){
        
        //     if($countryReside == "Unknown"){
                 
        //         $query->where('tbl_inquiries.inquiryLeadSource', '=', $leadcapture)
        //         ->whereNull('tbl_inquiries.countryReside')
        //         ->orWhere('tbl_inquiries.countryReside','=','N/A');
                
        //      }   
        //      else{
               
        //         $query->where('tbl_inquiries.inquiryLeadSource', '=', $leadcapture)
        //         ->where('tbl_inquiries.countryReside', '=', $countryReside);
        //      }
    
       
          
         
        // }
        else{
       
            if($searchdate && $searchdateend){
                $query->whereBetween(DB::raw('DATE(tbl_inquiries.dateCreated)'), [$searchdate, $searchdateend]);
            }
            if($leadcapture){
                $query->where('tbl_inquiries.inquiryLeadSource', '=', $leadcapture);
            }
            if($salesofficer){
                
                $query->whereRaw('tbl_inquiries.representative IN ('.$salesofficer.')');
            }
            if($countryReside){
                if($countryReside == "Unknown"){
          
                $query->whereNull('tbl_inquiries.countryReside')
                ->orWhere('tbl_inquiries.countryReside','=','N/A');
              
                }
                else{
                    $query->where('tbl_inquiries.countryReside','=', $countryReside);
                    
             
                }
            }
            if($inquiryType){
                $query->where('tbl_inquiries.inquiryType', '=', $inquiryType);
            }
   
        }
        
    }
}
