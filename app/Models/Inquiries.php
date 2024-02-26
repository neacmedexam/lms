<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inquiries extends Model
{
    use HasFactory;
    protected $table = 'tbl_inquiries';
    public $timestamps = false;
    protected $primaryKey = 'inquiryID';
   

    public function scopeFilter($query, array $filters,$select,$advsearch,$service,$status){

   
        // dd($filters['search']);
        if($filters['search'] ?? false){
            $query->where('tbl_inquiries.inquiryID', '=',  request('search'))
            ->orWhere('tbl_leadsource.leadSourceName', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_inquiries.applicantFirstName', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_inquiries.applicantLastName', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_inquiries.applicantName', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_inquiries.fbName', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_inquiries.email', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_inquiries.phoneNumber', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_inquiries.countryReside', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_services.serviceName', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_status.statusName', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_inquiries.datePaid', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_scoring.scoringName', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_inquiries.assignedLC', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_inquiries.notes', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_inquiries.representative', 'like', '%' . request('search') . '%')
            // ->orWhere('tbl_usertype.utName', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_inquiries.dateCreated', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_inquiries.modifiedBy', 'like', '%' . request('search') . '%')
            ->orWhere('tbl_inquiries.dateModified', 'like', '%' . request('search') . '%');
        }
        else if ($service && $status && $advsearch && $select ){
            $simsam = DB::select(DB::raw("
                SELECT tbl_inquiries.inquiryID as inqid
                
                    FROM (
                    
                        Select t1.inquiryID as inqID
                        , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.serviceType  ,',',seq.n-1) FROM SUBSTRING_INDEX(t1.serviceType  ,',',seq.n)), ',','') AS servicetype
                            , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) FROM SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)), ',','') AS status
                            , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.sampDate,',',seq.n-1) FROM SUBSTRING_INDEX(t1.sampDate,',',seq.n)), ',','') AS sdate
                            , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.assignedLC,',',seq.n-1) FROM SUBSTRING_INDEX(t1.assignedLC,',',seq.n)), ',','') AS assignedLCID
                            , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.notes,',',seq.n-1) FROM SUBSTRING_INDEX(t1.notes,',',seq.n)), ',','') AS notes
                        FROM tbl_inquiries AS t1
                        JOIN (
                                SELECT 1 + x1.n + (x2.n * 10) AS n
                                    FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
                                    , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
                            ) AS seq
                            ON seq.n > 0 AND SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) <> SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)
                    
                    ) AS x
                JOIN tbl_status   ON x.status      = tbl_status.statusID
                JOIN tbl_services ON x.servicetype = tbl_services.serviceID
                join tbl_inquiries on x.inqID = tbl_inquiries.inquiryID
                WHERE x.servicetype = $service and x.status = $status;
            "));
            $new = [];
            foreach($simsam as $res){
                $new[] = $res->inqid;
            }

          
            if($select == "inquiryID"){
                $query->whereIn('tbl_inquiries.inquiryID',$new)
                ->where('tbl_inquiries.inquiryID', '=',  $advsearch);
               
            }
           
            else{
                if($select == 'scoringName'){
                    $query->whereIn('tbl_inquiries.inquiryID',$new)
                    ->where('tbl_scoring.'.$select, '=',  $advsearch);
                

                }
                else if($select == 'serviceName'){
                    $query->whereIn('tbl_inquiries.inquiryID',$new)
                    ->where('tbl_services.'.$select, 'like', '%'. $advsearch .'%');
                }
                else{
                    $query->whereIn('tbl_inquiries.inquiryID',$new)
                    ->where('tbl_inquiries.'.$select, '=',  $advsearch);
                }
                
        
            }
      
        }
        else if ($service && $status && !$advsearch && !$select ){
            $new = [];
            // $newt = [];

            // $simsam = DB::select(DB::raw("
            //     SELECT tbl_inquiries.inquiryID as inqid
                
            //         FROM (
                    
            //             Select t1.inquiryID as inqID
            //             , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.serviceType  ,',',seq.n-1) FROM SUBSTRING_INDEX(t1.serviceType  ,',',seq.n)), ',','') AS servicetype
            //                 , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) FROM SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)), ',','') AS status
            //                 , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.sampDate,',',seq.n-1) FROM SUBSTRING_INDEX(t1.sampDate,',',seq.n)), ',','') AS sdate
            //                 , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.assignedLC,',',seq.n-1) FROM SUBSTRING_INDEX(t1.assignedLC,',',seq.n)), ',','') AS assignedLCID
            //                 , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.notes,',',seq.n-1) FROM SUBSTRING_INDEX(t1.notes,',',seq.n)), ',','') AS notes
            //             FROM tbl_inquiries AS t1
            //             JOIN (
            //                     SELECT 1 + x1.n + (x2.n * 10) AS n
            //                         FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
            //                         , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
            //                 ) AS seq
            //                 ON seq.n > 0 AND SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) <> SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)
                    
            //         ) AS x
            //     JOIN tbl_status   ON x.status      = tbl_status.statusID
            //     JOIN tbl_services ON x.servicetype = tbl_services.serviceID
            //     join tbl_inquiries on x.inqID = tbl_inquiries.inquiryID
            //     WHERE x.servicetype = $service and x.status = $status;
            // "));
            
            // foreach($simsam as $res){
            //     $newt[] = $res->inqid;
            // }

            $getUserIDs = DB::select(DB::raw("
                WITH RECURSIVE seq (n) AS (
                    SELECT 1
                    UNION ALL
                    SELECT n + 1 FROM seq WHERE n <= 9
                )
                , xrows AS (
                            SELECT t1.inquiryID
                                , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.serviceType,',',seq.n-1) FROM SUBSTRING_INDEX(t1.serviceType,',',seq.n)), ',','') AS service
                                , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) FROM SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)), ',','') AS paymentstatus
                            FROM tbl_inquiries AS t1
                            JOIN seq
                                ON seq.n > 0 AND SUBSTRING_INDEX(t1.serviceType,',',seq.n-1) <> SUBSTRING_INDEX(t1.serviceType,',',seq.n)
                    )
                SELECT * FROM xrows
                WHERE service = $service AND paymentstatus = $status
                ORDER BY inquiryID;
            "));

            foreach($getUserIDs as $res){
                $new[] = $res->inquiryID;
            }
     
            $query->whereIn('tbl_inquiries.inquiryID',$new);
    
      
        }

        elseif($advsearch && $select ?? false){

            if($select == "inquiryID"){
             
                $query->where('tbl_inquiries.inquiryID', '=',  $advsearch);
              
            }
           
            else{
                if($select == 'scoringName'){
                    $query->where('tbl_scoring.'.$select, '=',  $advsearch);
                

                }
                else if($select == 'serviceName'){
                    $query->where('tbl_services.'.$select, 'like', '%'. $advsearch .'%');
                }
                else{
                    $query->where('tbl_inquiries.'.$select, '=',  $advsearch);
                }
                
        
            }
         
        }
    }

   
}
