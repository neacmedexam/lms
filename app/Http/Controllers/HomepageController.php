<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\HomeModel;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    //

    public function search(){
        $datestart = $_GET['datestart'];
        $dateend = $_GET['dateend'];
      
        $getdatestart = $datestart ? Carbon::parse($_GET['datestart'])->format('F d Y') : '';
        $getdateend = $dateend ? Carbon::parse($_GET['dateend'])->format('F d Y') : '';


        
        //------------------------------getLeadScore
        $leadscoring = HomeModel::filter($datestart,$dateend)
        ->select('tbl_scoring.scoringName as scoringname',DB::raw("(COUNT(tbl_inquiries.scoring)/SUM(COUNT(tbl_inquiries.scoring)) over())*100 as totalpercentage"))
        ->join('tbl_scoring', 'tbl_inquiries.scoring', '=', 'tbl_scoring.scoringID')  
        // ->whereRaw("tbl_inquiries.scoring NOT IN (3) AND tbl_inquiries.isActive = 1")
        ->groupBy('tbl_inquiries.scoring')
        ->get();

        
        $rawLeadScore = [];
        foreach ($leadscoring as $getLeadScoring){
            $rawLeadScore[] = ['name' => $getLeadScoring['scoringname'], 'y' => $getLeadScoring['totalpercentage']];
        }

       
        //------------------------------
        
        //------------------------------getLeadSource
        $ls = HomeModel::filter($datestart,$dateend)
        ->join('tbl_leadsource', 'tbl_inquiries.inquiryLeadSource', '=', 'tbl_leadsource.leadsourceID')
        ->where('tbl_inquiries.isActive', '=', '1')
        ->select('tbl_leadsource.leadSourceName as lead', 
        DB::raw('COUNT(tbl_inquiries.inquiryLeadSource)/SUM(COUNT(tbl_inquiries.inquiryLeadSource)) over ()*100 as lstotal'))
        ->groupBy('tbl_inquiries.inquiryLeadSource')
        ->get();
    
        $rawLeadSource = [];
        foreach ($ls as $getLS){
            $rawLeadSource[] = ['name' => $getLS['lead'], 'y' => $getLS['lstotal']];
        }
  
        
        // $toplc = HomeModel::filter($datestart,$dateend)
        // ->select(DB::raw('count(*) as total'))
        // ->select('tbl_inquiries.representative')
        // ->select(DB::raw('concat(tbl_accounts.firstName, tbl_accounts.lastName) as name'))
        // ->join('tbl_accounts', 'tbl_inquiries.representative', '=', 'tbl_accounts.id')
        // ->whereRaw('tbl_inquiries.inquiryLeadSource IN (1,2,3,6)')
        // ->where('tbl_inquiries.scoring','=','3')
        // ->groupBy('tbl_inquiries.representative')
        // ->orderBy(DB::raw('COUNT(*)'),'desc')
        // ->pluck('total');

        // dd($toplc);


    
        // $toplc = HomeModel::filter($datestart,$dateend)
        // ->select(DB::raw("CONCAT(tbl_accounts.firstName,' ',tbl_accounts.lastName) as name"), DB::raw("ifnull(count(*),0) as totalcounttoplc"))
        // ->join('tbl_accounts', 'tbl_inquiries.representative', '=', 'tbl_accounts.id')
        // ->where('tbl_accounts.worksite', '=', 1)
        // ->where('tbl_inquiries.scoring', '=', 3)
        // ->groupBy('tbl_inquiries.representative')
        // ->orderBy(DB::raw('COUNT(*)'),'desc')
        // ->get();
        // $tiplc = HomeModel::filter($datestart,$dateend)
        // ->select(DB::raw("CONCAT(tbl_accounts.firstName,' ',tbl_accounts.lastName) as name"), DB::raw("ifnull(count(*),0) as totalcounttiplc"))
        // ->join('tbl_accounts', 'tbl_inquiries.representative', '=', 'tbl_accounts.id')
        // ->where('tbl_accounts.worksite', '=', 0)
        // ->where('tbl_inquiries.scoring', '=', 3)
        // ->groupBy('tbl_inquiries.representative')
        // ->orderBy(DB::raw('COUNT(*)'),'desc')
        // ->get();


        $getMonths = HomeModel::filter($datestart,$dateend)
        ->select('tbl_months.month_name as months')
        ->rightJoin('tbl_months', DB::raw('month(tbl_inquiries.dateCreated)'), '=', 'tbl_months.month_number')
        ->orderBy('tbl_months.month_number')
        ->distinct()
        ->pluck('months');

        $raw = null;
        $raw2 = null;
        $toplc = null;
        $tiplc = null;
        
        
        if(!$datestart || !$dateend){

            
            $toplc = DB::select("SELECT concat(tbl_accounts.firstName,' ',tbl_accounts.lastName) as representative
                    , count(*) as totalsales
                FROM (
                        SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.representative  ,',',seq.n-1) FROM SUBSTRING_INDEX(t1.representative  ,',',seq.n)), ',','') AS srepresentative
                            , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) FROM SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)), ',','') AS status
                        FROM tbl_inquiries AS t1
                        JOIN (
                                SELECT 1 + x1.n + (x2.n * 10) AS n
                                    FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
                                    , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
                            ) AS seq
                            ON seq.n > 0 AND SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) <> SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)
                               WHERE t1.isActive = 1
                    ) AS x
                    
                JOIN tbl_status   ON x.status      = tbl_status.statusID
                JOIN tbl_accounts ON x.srepresentative = tbl_accounts.id
                where x.status <> 1 and x.status <> 5 and tbl_accounts.worksite = 1
            
                group by tbl_accounts.id
                ORDER BY totalsales desc;");
                
            $tiplc = DB::select("SELECT concat(tbl_accounts.firstName,' ',tbl_accounts.lastName) as representative
                    , count(*) as totalsales
                FROM (
                        SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.representative  ,',',seq.n-1) FROM SUBSTRING_INDEX(t1.representative  ,',',seq.n)), ',','') AS srepresentative
                            , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) FROM SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)), ',','') AS status
                        FROM tbl_inquiries AS t1
                        JOIN (
                                SELECT 1 + x1.n + (x2.n * 10) AS n
                                    FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
                                    , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
                            ) AS seq
                            ON seq.n > 0 AND SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) <> SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)
                               WHERE t1.isActive = 1
                    ) AS x
                    
                JOIN tbl_status   ON x.status      = tbl_status.statusID
                JOIN tbl_accounts ON x.srepresentative = tbl_accounts.id
                where x.status <> 1 and x.status <> 5 and tbl_accounts.worksite = 0
            
                group by tbl_accounts.id
                ORDER BY totalsales desc;");
            
            
            $raw = "SELECT ts.serviceName as servicename
            , COUNT(*) AS totalservices
            FROM tbl_services AS ts
            JOIN (
                    SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.serviceType,',',seq.n-1) FROM SUBSTRING_INDEX(t1.serviceType,',',seq.n)), ',','') AS stype
                    FROM tbl_inquiries AS t1
                    JOIN (
                            SELECT 1 + x1.n + (x2.n * 10) AS n
                                FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
                                , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
                            ) AS seq
                        ON seq.n > 0 AND SUBSTRING_INDEX(t1.serviceType,',',seq.n-1) <> SUBSTRING_INDEX(t1.serviceType,',',seq.n)
                           WHERE t1.isActive = 1
                     
                ) AS inq
            ON inq.stype = ts.serviceID
            GROUP BY serviceID
            ORDER BY count(*) desc;";



            $raw2 = "SELECT ts.serviceName as servicename
            , COUNT(*) AS totalservices
            FROM tbl_services AS ts
            JOIN (
                SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.serviceType,',',seq.n-1) FROM SUBSTRING_INDEX(t1.serviceType,',',seq.n)), ',','') AS stype
                    FROM tbl_inquiries AS t1
                    JOIN (
                            SELECT 1 + x1.n + (x2.n * 10) AS n
                            FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
                                , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
                        ) AS seq
                    ON seq.n > 0 AND SUBSTRING_INDEX(t1.serviceType,',',seq.n-1) <> SUBSTRING_INDEX(t1.serviceType,',',seq.n)
                    AND t1.paymentStatus IN (2, 3, 4)     WHERE t1.isActive = 1
                ) AS inq
            ON inq.stype = ts.serviceID
            GROUP BY serviceID
            ORDER BY totalservices desc;";

          
        }

        else{
            //TOP ONLINE PERFORMACE - LC
             $toplc = DB::select("SELECT concat(tbl_accounts.firstName,' ',tbl_accounts.lastName) as representative
                    , count(*) as totalsales
                FROM (
                        SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.representative  ,',',seq.n-1) FROM SUBSTRING_INDEX(t1.representative  ,',',seq.n)), ',','') AS srepresentative
                            , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) FROM SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)), ',','') AS status
                        FROM tbl_inquiries AS t1
                        JOIN (
                                SELECT 1 + x1.n + (x2.n * 10) AS n
                                    FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
                                    , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
                            ) AS seq
                            ON seq.n > 0 AND SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) <> SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)
                            WHERE date(t1.dateCreated) BETWEEN '$datestart' AND '$dateend' AND t1.isActive = 1
                    ) AS x
                    
                JOIN tbl_status   ON x.status      = tbl_status.statusID
                JOIN tbl_accounts ON x.srepresentative = tbl_accounts.id
                where x.status <> 1 and x.status <> 5 and tbl_accounts.worksite = 1
            
                group by tbl_accounts.id
                ORDER BY totalsales desc;");
                
            //TOP ONLINE PERFORMACE - LC   
            $tiplc = DB::select("SELECT concat(tbl_accounts.firstName,' ',tbl_accounts.lastName) as representative
                    , count(*) as totalsales
                FROM (
                        SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.representative  ,',',seq.n-1) FROM SUBSTRING_INDEX(t1.representative  ,',',seq.n)), ',','') AS srepresentative
                            , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) FROM SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)), ',','') AS status
                        FROM tbl_inquiries AS t1
                        JOIN (
                                SELECT 1 + x1.n + (x2.n * 10) AS n
                                    FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
                                    , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
                            ) AS seq
                            ON seq.n > 0 AND SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) <> SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)
                            WHERE date(t1.dateCreated) BETWEEN '$datestart' AND '$dateend' AND t1.isActive = 1
                    ) AS x
                    
                JOIN tbl_status   ON x.status      = tbl_status.statusID
                JOIN tbl_accounts ON x.srepresentative = tbl_accounts.id
                where x.status <> 1 and x.status <> 5 and tbl_accounts.worksite = 0
            
                group by tbl_accounts.id
                ORDER BY totalsales desc;");
            
            //TOP INQUIRED SERVICES
            $raw = "SELECT ts.serviceName as servicename
            , COUNT(*) AS totalservices
            FROM tbl_services AS ts
            JOIN (
                    SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.serviceType,',',seq.n-1) FROM SUBSTRING_INDEX(t1.serviceType,',',seq.n)), ',','') AS stype
                    FROM tbl_inquiries AS t1
                    JOIN (
                            SELECT 1 + x1.n + (x2.n * 10) AS n
                                FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
                                , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
                            ) AS seq
                        ON seq.n > 0 AND SUBSTRING_INDEX(t1.serviceType,',',seq.n-1) <> SUBSTRING_INDEX(t1.serviceType,',',seq.n)
                        WHERE date(t1.dateCreated) BETWEEN '$datestart' AND '$dateend' AND  t1.isActive = 1
                ) AS inq
            ON inq.stype = ts.serviceID
            GROUP BY serviceID
            ORDER BY count(*) desc;";
            
            
            //TOP SOLD SERVICES
            $raw2 = "SELECT ts.serviceName as servicename
            , COUNT(*) AS totalservices
            FROM tbl_services AS ts
            JOIN (
                SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.serviceType,',',seq.n-1) FROM SUBSTRING_INDEX(t1.serviceType,',',seq.n)), ',','') AS stype
                    FROM tbl_inquiries AS t1
                    JOIN (
                            SELECT 1 + x1.n + (x2.n * 10) AS n
                            FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
                                , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
                        ) AS seq
                    ON seq.n > 0 AND SUBSTRING_INDEX(t1.serviceType,',',seq.n-1) <> SUBSTRING_INDEX(t1.serviceType,',',seq.n)
                    AND t1.paymentStatus IN (2, 3, 4) AND date(t1.dateCreated) BETWEEN '$datestart' AND '$dateend'
                       WHERE t1.isActive = 1
                ) AS inq
            ON inq.stype = ts.serviceID
            GROUP BY serviceID
            ORDER BY totalservices desc;";
        }
        //TOP INQUIRED SERVICES
        $tisRaw = DB::select($raw);
        
        //TOP SOLD SERVICES
        $ssRaw = DB::select($raw2);

        $signup = HomeModel::filter($datestart,$dateend)
        ->select(DB::raw('ifnull(count(if(tbl_inquiries.scoring = 3, 1, null)),0) as totalsignedup'))
        ->join('tbl_scoring', 'tbl_inquiries.scoring', '=', 'tbl_scoring.scoringID')
        ->rightJoin('tbl_months', DB::raw('month(tbl_inquiries.datePaid)'),'=','tbl_months.month_number')
        ->groupBy('tbl_months.month_number')
        ->orderBy('tbl_months.month_number')
        ->pluck('totalsignedup');
        
        $newlead = HomeModel::filter($datestart,$dateend)
        ->select(DB::raw("ifnull(COUNT(tbl_inquiries.inquiryID),0) as count"))
        ->rightJoin('tbl_months', DB::raw('month(tbl_inquiries.dateCreated)'), '=', 'tbl_months.month_number')
        ->groupBy('tbl_months.month_number')
        ->orderBy('tbl_months.month_number')
        ->pluck('count');

 
        return view('home.homesearch',[
            'userData' => HomeModel::filter($datestart,$dateend)
            ->select(DB::raw("COUNT(*) as count"))
            ->whereYear('dateCreated', date('Y'))
            ->where('tbl_inquiries.isActive', '=', '1')
            ->groupBy(DB::raw("Month(dateCreated)"))
            ->pluck('count'),
            'newlead' => $newlead,
            'month'=> $getMonths,
            'signup' => $signup,
            'tis' => $tisRaw,
            'leadscoring' => $rawLeadScore,
            'ls' => $rawLeadSource,
            'ss' => $ssRaw,
            'datestart' => $getdatestart,
            'dateend' => $getdateend,
            'toplc'=> $toplc,
            'tiplc' => $tiplc,
        ]);

    }

    public function showHomepage(){
        $datestart = request('datestart');
        $dateend = request('dateend');
        
        //------------------------------getLeadScore
        $leadscoring = HomeModel::filter($datestart,$dateend)
        ->select('tbl_scoring.scoringName as scoringname',DB::raw("(COUNT(tbl_inquiries.scoring)/SUM(COUNT(tbl_inquiries.scoring)) over())*100 as totalpercentage"))
        ->join('tbl_scoring', 'tbl_inquiries.scoring', '=', 'tbl_scoring.scoringID') 
        // ->whereRaw("tbl_inquiries.scoring NOT IN (3) AND tbl_inquiries.isActive = 1")
        ->groupBy('tbl_inquiries.scoring')
        ->get();

        
        $rawLeadScore = [];
        foreach ($leadscoring as $getLeadScoring){
            $rawLeadScore[] = ['name' => $getLeadScoring['scoringname'], 'y' => $getLeadScoring['totalpercentage']];
        }
     

        //------------------------------
        
        //------------------------------getLeadSource
        $ls = HomeModel::filter($datestart,$dateend)
        ->join('tbl_leadsource', 'tbl_inquiries.inquiryLeadSource', '=', 'tbl_leadsource.leadsourceID')
        ->where('tbl_inquiries.isActive', '=', '1')
        ->select('tbl_leadsource.leadSourceName as lead', 
        DB::raw('COUNT(tbl_inquiries.inquiryLeadSource)/SUM(COUNT(tbl_inquiries.inquiryLeadSource)) over ()*100 as lstotal'))
        ->groupBy('tbl_inquiries.inquiryLeadSource')
        ->get();
        
        $rawLeadSource = [];

        foreach ($ls as $getLS){
            $rawLeadSource[] = ['name' => $getLS['lead'], 'y' => $getLS['lstotal']];
        }
         
        //OLD
        // $toplc = HomeModel::filter($datestart,$dateend)
        // ->select(DB::raw("CONCAT(tbl_accounts.firstName,' ',tbl_accounts.lastName) as name"), DB::raw("ifnull(count(*),0) as totalcount"))
        // ->join('tbl_accounts', 'tbl_inquiries.representative', '=', 'tbl_accounts.id')
        // ->where('tbl_accounts.worksite', '=', 1)
        // ->where('tbl_inquiries.scoring', '=', 3)
        // ->groupBy('tbl_inquiries.representative')
        // ->orderBy(DB::raw('COUNT(*)'),'desc')
        // ->get();
        
        //NEW
        $toplc = DB::select("SELECT concat(tbl_accounts.firstName,' ',tbl_accounts.lastName) as representative
                        , count(*) as totalsales
                    FROM (
                            SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.representative  ,',',seq.n-1) FROM SUBSTRING_INDEX(t1.representative  ,',',seq.n)), ',','') AS srepresentative
                                , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) FROM SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)), ',','') AS status
                            FROM tbl_inquiries AS t1
                            JOIN (
                                    SELECT 1 + x1.n + (x2.n * 10) AS n
                                        FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
                                        , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
                                ) AS seq
                                ON seq.n > 0 AND SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) <> SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)
                                   WHERE t1.isActive = 1
                        ) AS x
                        
                    JOIN tbl_status   ON x.status      = tbl_status.statusID
                    JOIN tbl_accounts ON x.srepresentative = tbl_accounts.id
                    where x.status <> 1 and x.status <> 5 and tbl_accounts.worksite = 1
                
                    group by tbl_accounts.id
                    ORDER BY totalsales desc;");
    
        //OLD
        // $tiplc = HomeModel::filter($datestart,$dateend)
        // ->select(DB::raw("CONCAT(tbl_accounts.firstName,' ',tbl_accounts.lastName) as name"), DB::raw("ifnull(count(*),0) as totalcount"))
        // ->join('tbl_accounts', 'tbl_inquiries.representative', '=', 'tbl_accounts.id')
        // ->where('tbl_accounts.worksite', '=', 0)
        // ->where('tbl_inquiries.scoring', '=', 3)
        // ->groupBy('tbl_inquiries.representative')
        // ->orderBy(DB::raw('COUNT(*)'),'desc')
        // ->get();
        
        //NEW
        $tiplc = DB::select("SELECT concat(tbl_accounts.firstName,' ',tbl_accounts.lastName) as representative
                        , count(*) as totalsales
                    FROM (
                            SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.representative  ,',',seq.n-1) FROM SUBSTRING_INDEX(t1.representative  ,',',seq.n)), ',','') AS srepresentative
                                , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) FROM SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)), ',','') AS status
                            FROM tbl_inquiries AS t1
                            JOIN (
                                    SELECT 1 + x1.n + (x2.n * 10) AS n
                                        FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
                                        , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
                                ) AS seq
                                ON seq.n > 0 AND SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) <> SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)
                                   WHERE t1.isActive = 1
                        ) AS x
                        
                    JOIN tbl_status   ON x.status      = tbl_status.statusID
                    JOIN tbl_accounts ON x.srepresentative = tbl_accounts.id
                    where x.status <> 1 and x.status <> 5 and tbl_accounts.worksite = 0
                
                    group by tbl_accounts.id
                    ORDER BY totalsales desc;");

        $getMonths = HomeModel::filter($datestart,$dateend)
        ->select('tbl_months.month_name as months')
        ->rightJoin('tbl_months', DB::raw('month(tbl_inquiries.dateCreated)'), '=', 'tbl_months.month_number')
        ->orderBy('tbl_months.month_number')
        ->distinct()
        ->pluck('months');
   
        $raw = " SELECT ts.serviceName as servicename
        , COUNT(*) AS totalservices
        FROM tbl_services AS ts
        JOIN (
                SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.serviceType,',',seq.n-1) FROM SUBSTRING_INDEX(t1.serviceType,',',seq.n)), ',','') AS stype,
            		REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) FROM SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)), ',','') AS spaymentstatus
                FROM tbl_inquiries AS t1
                JOIN (
                        SELECT 1 + x1.n + (x2.n * 10) AS n
                            FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
                            , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
                        ) AS seq
                    ON seq.n > 0 AND SUBSTRING_INDEX(t1.serviceType,',',seq.n-1) <> SUBSTRING_INDEX(t1.serviceType,',',seq.n)
                    WHERE t1.isActive = 1
                 
            ) AS inq
        ON inq.stype = ts.serviceID
        WHERE spaymentstatus NOT IN (5)
        GROUP BY serviceID
        ORDER BY count(*) desc;";
  
        $tisRaw = DB::select($raw);  
        
        //-----OLD
        // $raw2 = " SELECT ts.serviceName as servicename
        // , COUNT(*) AS totalservices
        // FROM tbl_services AS ts
        // JOIN (
        //     SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.serviceType,',',seq.n-1) FROM SUBSTRING_INDEX(t1.serviceType,',',seq.n)), ',','') AS stype
        //         FROM tbl_inquiries AS t1
        //         JOIN (
        //                 SELECT 1 + x1.n + (x2.n * 10) AS n
        //                 FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
        //                     , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
        //             ) AS seq
        //         ON seq.n > 0 AND SUBSTRING_INDEX(t1.serviceType,',',seq.n-1) <> SUBSTRING_INDEX(t1.serviceType,',',seq.n)
        //         AND t1.paymentStatus <> 1
        //     ) AS inq
        // ON inq.stype = ts.serviceID
        // GROUP BY serviceID
        // ORDER BY totalservices desc;";

        //-----NEW
        $raw2 = " SELECT tbl_services.serviceName as servicename
                        , count(*) as totalservices
                    FROM (
                            SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.serviceType  ,',',seq.n-1) FROM SUBSTRING_INDEX(t1.serviceType  ,',',seq.n)), ',','') AS servicetype
                                , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) FROM SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)), ',','') AS status
                            FROM tbl_inquiries AS t1
                            JOIN (
                                    SELECT 1 + x1.n + (x2.n * 10) AS n
                                        FROM ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x1
                                        , ( SELECT  0 AS n UNION SELECT  1 UNION SELECT  2 UNION SELECT  3 UNION SELECT  4 UNION SELECT  5 UNION SELECT  6 UNION SELECT  7 UNION SELECT  8 UNION SELECT  9) AS x2
                                ) AS seq
                                ON seq.n > 0 AND SUBSTRING_INDEX(t1.paymentStatus,',',seq.n-1) <> SUBSTRING_INDEX(t1.paymentStatus,',',seq.n)
                                   WHERE t1.isActive = 1
                                
                        ) AS x
                        
                    JOIN tbl_status   ON x.status      = tbl_status.statusID
                    JOIN tbl_services ON x.servicetype = tbl_services.serviceID
                    where x.status <> 1 and x.status <> 5
                
                    group by serviceID
                    ORDER BY totalservices desc;
        ";
        //   ORDER BY x.servicetype+0;
        $ssRaw = DB::select($raw2);
        

       

        $signup = HomeModel::filter($datestart,$dateend)
        ->select(DB::raw('ifnull(count(if(tbl_inquiries.scoring = 3, 1, null)),0) as totalsignedup'))
        ->join('tbl_scoring', 'tbl_inquiries.scoring', '=', 'tbl_scoring.scoringID')
        ->rightJoin('tbl_months', DB::raw('month(tbl_inquiries.datePaid)'),'=','tbl_months.month_number')
        ->groupBy('tbl_months.month_number')
        ->orderBy('tbl_months.month_number')
        // ->where('tbl_inquiries.isActive', '=', '1')
        // ->take(99999999)
        // ->skip(1)
        ->pluck('totalsignedup');
 
        $newlead = HomeModel::filter($datestart,$dateend)
        ->select(DB::raw("ifnull(COUNT(tbl_inquiries.inquiryID),0) as count"))
        ->rightJoin('tbl_months', DB::raw('month(tbl_inquiries.dateCreated)'), '=', 'tbl_months.month_number')
        ->groupBy('tbl_months.month_number')
        ->orderBy('tbl_months.month_number')
        ->pluck('count');

        // $tpo = HomeModel::filter(request(['search']))
        // ->select('tbl_inquiries.representative',DB::raw('concat(tbl_accounts.firstName, tbl_accounts.lastName)'),DB::raw("COUNT(*)"))
        // ->join('tbl_accounts','tbl_inquiries.representative','=','tbl_accounts.id')
        // ->orWhere('tbl_inquiries.inquiryLeadSource','=','1')
        // ->orWhere('tbl_inquiries.inquiryLeadSource','=','2')
        // ->orWhere('tbl_inquiries.inquiryLeadSource','=','3')
        // ->orWhere('tbl_inquiries.inquiryLeadSource','=','6')
        // ->where('tbl_inquiries.scoring','=','3')
        // ->groupBy('tbl_inquiries.representative')
        // ->get();

        // dd($tpo);
       

        return view('home.homepage',[
            'userData' => HomeModel::filter($datestart,$dateend)
            ->select(DB::raw("COUNT(*) as count"))
            ->whereYear('dateCreated', date('Y'))
            ->where('tbl_inquiries.isActive', '=', '1')
            ->groupBy(DB::raw("Month(dateCreated)"))
            ->pluck('count'),

            'newlead' => $newlead,
            
            // 'month' => HomeModel::filter(request(['search']))
            // ->select(DB::raw('MONTHNAME(dateCreated) as getmonth'))
            // ->groupBy(DB::raw("Month(dateCreated)"))
            // ->pluck('getmonth'),
            'month'=> $getMonths,
         
            'signup' => $signup,

            // 'tis' => HomeModel::filter(request(['search']))
            // ->select('tbl_services.serviceName as servicename', DB::raw('COUNT(tbl_inquiries.serviceType) as totalservices'))
            // ->join('tbl_services', 'tbl_inquiries.serviceType', '=', 'tbl_services.serviceID')
            // ->where('tbl_inquiries.isActive', '=', '1')
            // ->groupBy('tbl_inquiries.serviceType')
            // ->orderBy(DB::raw('COUNT(tbl_inquiries.serviceType)'),'desc')
            // ->get(),
            'tis' => $tisRaw,


            'leadscoring' => $rawLeadScore,

            'ls' => $rawLeadSource,

            'ss' => $ssRaw,
            'toplc' => $toplc,
            'tiplc' => $tiplc,

        ]);


        // $userData = User::select(\DB::raw("COUNT(*) as count"))
        // ->whereYear('created_at', date('Y'))
        // ->groupBy(\DB::raw("Month(created_at)"))
        // ->pluck('count');
             
        // return view('home', compact('userData'));

        
    }
}
