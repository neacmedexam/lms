<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Inquiries;
use Illuminate\Http\Request;
use App\Models\leadDashboardModel;
use Illuminate\Support\Facades\DB;

class leadDashboardController extends Controller
{
    // public function search(Request $request){
 

    //     $leadcapture = DB::table('tbl_leadsource')->where('isActive', '=', '1')->get();
    //     $salesofficer = DB::table('tbl_accounts')->where('isActive', '=', 1)->get();
        
    //     $datestart = $request->input('datestart');
    //     $dateend =  $request->input('dateend');

    //     $rawSalesOfficer = $request->input('salesofficer');
    //     $rawLeadCapture = $request->input('leadcapture');

    //     $rawSales = $request->get('salesdestination');
    //     $rawCountry = $request->get('countryReside');

    //     $fetchSalesOfficer = leadDashboardModel::select('tbl_accounts.firstName as fname','tbl_accounts.lastName as lname')
    //     ->join('tbl_accounts', 'tbl_inquiries.representative','=','tbl_accounts.id')
    //     ->where('tbl_inquiries.representative','=', $rawSalesOfficer)
    //     ->groupBy('tbl_accounts.id')
    //     ->first();


    //     $fetchLeadCapture = leadDashboardModel::select('tbl_leadsource.leadSourcename as leadsource')
    //     ->join('tbl_leadsource', 'tbl_inquiries.inquiryLeadSource','=','tbl_leadsource.leadsourceID')
    //     ->where('tbl_inquiries.inquiryLeadSource','=', $rawLeadCapture)
    //     ->groupBy('tbl_inquiries.representative')
    //     ->first();
      
     

    //     $getdatestart = null;
    //     $getdateend = null;

    //     $getSalesOfficer = null;
    //     $getLeadCapture = null;
    //     $getLeadCapture = null;
       
    //     if($fetchSalesOfficer !== null){
    //         $getSalesOfficer = $fetchSalesOfficer->fname.' '.$fetchSalesOfficer->lname;
    //     }
    //     else{
    //         $getSalesOfficer = null;
         
    //     }
    
    //     if($fetchLeadCapture !== null){
    //         $getLeadCapture = $fetchLeadCapture->leadsource;
    //     }
    //     else{
    //         $getLeadCapture = null;
    //     }

    //     if($datestart !==  null && $dateend !== null){
    //         $getdatestart = Carbon::parse($_GET['datestart'])->format('F d Y');
    //         $getdateend = Carbon::parse($_GET['dateend'])->format('F d Y');
        
    //     }
    //     else{
    //         $getdatestart = null;
    //         $getdateend = null;
    //     }

    //     return view('dashboard.lcdashboardsearch',[
    //         'closingratio' => leadDashboardModel::filter(request(['search']),$datestart,$dateend,$rawSalesOfficer,$rawLeadCapture,$rawCountry)
    //         ->join('tbl_leadsource', 'tbl_inquiries.inquiryLeadSource', '=', 'tbl_leadsource.leadsourceID')
    //         ->where('tbl_inquiries.isActive', '=', '1')
    //         ->select('tbl_leadsource.leadSourceName as lead', 
    //         DB::raw('COUNT(tbl_inquiries.inquiryLeadSource) as leadnumber'), 
    //         DB::raw('SUM(IF(tbl_inquiries.scoring = 3,1,0)) as signedup'), 
    //         DB::raw('CEIL(SUM(IF(tbl_inquiries.scoring = 3,1,0))/COUNT(tbl_inquiries.inquiryLeadSource)*100) as ClosingRatio'),
    //         DB::raw('SUM(COUNT(tbl_inquiries.inquiryLeadSource)) over ()  totalleadnumbers'),
    //         DB::raw('SUM(SUM(IF(tbl_inquiries.scoring = 3, 1, 0))) over ()  totalsignedup'),
    //         DB::raw('CEIL(SUM(SUM(IF(tbl_inquiries.scoring = 3, 1, 0))) over () /SUM(COUNT(tbl_inquiries.inquiryLeadSource)) over ()  *100) as otp')
    //         )
    //         ->groupBy('tbl_inquiries.inquiryLeadSource')
    //         ->get(),

    //         'applicants' => leadDashboardModel::filter(request(['search']),$datestart,$dateend,$rawSalesOfficer,$rawLeadCapture,$rawCountry)
    //         ->join('tbl_leadsource', 'tbl_inquiries.inquiryLeadSource', '=', 'tbl_leadsource.leadsourceID')
    //         ->where('tbl_inquiries.isActive', '=', '1')
    //         ->select('tbl_inquiries.*','tbl_leadsource.leadsourceName as lead')
    //         ->orderBy('tbl_inquiries.dateCreated','desc')
    //         ->paginate(100),
    //         'leadcapture' => $leadcapture,
    //         'salesofficer' => $salesofficer,
    //         'datestart' => $getdatestart,
    //         'dateend' => $getdateend,
    //         'getSalesOfficer' => $getSalesOfficer,
    //         'getLeadCapture' => $getLeadCapture,
    //         'getCountry' => $rawCountry,
    //         'rawSales' => $rawSales,
           
          
    //     ]);
    // }
    //
    public function showDashboard(Request $request){
  
       
        $datestart = $request->input('datestart');
        $dateend =  $request->input('dateend');

        $rawSalesOfficer = $request->input('salesofficer');
        $rawLeadCapture = $request->input('leadcapture');

        $rawSales = $request->get('salesdestination');
        $rawCountry = $request->get('countryReside');
        $rawInquiryType = $request->get('inquirytype');
  
        $leadcapture = DB::table('tbl_leadsource')->where('isActive', '=', '1')->get();
        $salesofficer = DB::table('tbl_accounts')
        ->where('isActive', '=', '1')
        ->whereIn('userType', [2, 3])
        ->get();
        $inquiryTypes = DB::table('tbl_inquirytype')->where('isActive', '=', '1')->get();

       
        $getdatestart = null;
        $getdateend = null;

        $getSalesOfficer = null;
        $getLeadCapture = null;
        $getLeadCapture = null;
       
        
        $fetchSalesOfficer = leadDashboardModel::select('tbl_accounts.firstName as fname','tbl_accounts.lastName as lname')
        ->join('tbl_accounts', 'tbl_inquiries.representative','=','tbl_accounts.id')
        ->where('tbl_inquiries.representative','=', $rawSalesOfficer)
        ->groupBy('tbl_accounts.id')
        ->first();

        $fetchLeadCapture = leadDashboardModel::select('tbl_leadsource.leadSourcename as leadsource')
        ->join('tbl_leadsource', 'tbl_inquiries.inquiryLeadSource','=','tbl_leadsource.leadsourceID')
        ->where('tbl_inquiries.inquiryLeadSource','=', $rawLeadCapture)
        ->groupBy('tbl_inquiries.representative')
        ->first();
      
        if($fetchSalesOfficer !== null){
            $getSalesOfficer = $fetchSalesOfficer->fname.' '.$fetchSalesOfficer->lname;
        }
        else{
            $getSalesOfficer = null;
         
        }
    
        if($fetchLeadCapture !== null){
            $getLeadCapture = $fetchLeadCapture->leadsource;
        }
        else{
            $getLeadCapture = null;
        }

        if($datestart !==  null && $dateend !== null){
            $getdatestart = Carbon::parse($_GET['datestart'])->format('F d Y');
            $getdateend = Carbon::parse($_GET['dateend'])->format('F d Y');
        
        }
        else{
            $getdatestart = null;
            $getdateend = null;
        }
 
            
        return view('dashboard.lcdashboard',[
            'closingratio' => leadDashboardModel::filter(request(['search']),$datestart,$dateend,$rawSalesOfficer,$rawLeadCapture,$rawCountry,$rawInquiryType)
            ->join('tbl_leadsource', 'tbl_inquiries.inquiryLeadSource', '=', 'tbl_leadsource.leadsourceID')
            ->where('tbl_inquiries.isActive', '=', '1')
            ->select('tbl_leadsource.leadSourceName as lead', 
            DB::raw('COUNT(tbl_inquiries.inquiryLeadSource) as leadnumber'), 
            DB::raw('SUM(IF(tbl_inquiries.scoring = 3,1,0)) as signedup'), 
            DB::raw('CEIL(SUM(IF(tbl_inquiries.scoring = 3,1,0))/COUNT(tbl_inquiries.inquiryLeadSource)*100) as ClosingRatio'),
            DB::raw('SUM(COUNT(tbl_inquiries.inquiryLeadSource)) over ()  totalleadnumbers'),
            DB::raw('SUM(SUM(IF(tbl_inquiries.scoring = 3, 1, 0))) over ()  totalsignedup'),
            DB::raw('CEIL(SUM(SUM(IF(tbl_inquiries.scoring = 3, 1, 0))) over () /SUM(COUNT(tbl_inquiries.inquiryLeadSource)) over ()  *100) as otp')
            )
            ->groupBy('tbl_inquiries.inquiryLeadSource')
            ->get(),

            'applicants' => leadDashboardModel::filter(request(['search']),$datestart,$dateend,$rawSalesOfficer,$rawLeadCapture,$rawCountry,$rawInquiryType)
            ->join('tbl_leadsource', 'tbl_inquiries.inquiryLeadSource', '=', 'tbl_leadsource.leadsourceID')
            ->join('tbl_accounts', 'tbl_inquiries.representative','=','tbl_accounts.id')
            ->where('tbl_inquiries.isActive', '=', '1')
            ->select('tbl_inquiries.*','tbl_leadsource.leadsourceName as lead','tbl_accounts.*','tbl_inquiries.dateCreated as datecreated')
            ->orderBy('tbl_inquiries.dateCreated','desc')
            ->paginate(100),
            'leadcapture' => $leadcapture,
            'salesofficer' => $salesofficer,
            'datestart' => $getdatestart,
            'dateend' => $getdateend,
            'getSalesOfficer' => $getSalesOfficer,
            'getLeadCapture' => $getLeadCapture,
            'getCountry' => $rawCountry,
            'rawSales' => $rawSales,
            'inquiryTypes' => $inquiryTypes,
        ]);



    }
}
