<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WebAcquisitionModel;

class WebAcquisitionController extends Controller
{
    public function showAddReportWebAcquisition(){
        return view('webacquisition.addwebacquisition');
    }

    public function addWebAcquisition(Request $request){
        
        $inputmonth = $request->input('month');
        $inputyear = $request->input('year');
        $check = WebAcquisitionModel::where('month', '=', $inputmonth)->where('year', '=', $inputyear)->exists();
        // $checkyear = CampaignModel::where('year', '=', $inputyear)->exists();
        
        // $x = $inputmonth .' '.$checkmonth;
        // $y = $inputyear .' '.$checkyear;

        if($check){
                 
            return redirect('/addreport/webacquisition')->with('message', 'Month and year already exist. Please try again.');
        }
        else{

            $formData = $request->validate([
            
                'month' => 'required',
                'year' => 'required',
                'direct_traffic' => 'required',
                'email_marketing' => 'required',
                'organic_search' => 'required',
                'paid_search' => 'required',
                'referrals' => 'required',
                'social_media' => 'required',
                'other_campaigns' => 'required',
                'offline_sources' => 'required',
                'display' => 'required',
        
            ]);
            $formData = [
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'direct_traffic' => $request->input('direct_traffic'),
                'email_marketing' => $request->input('email_marketing'),
                'organic_search' => $request->input('organic_search'),
                'paid_search' => $request->input('paid_search'),
                'referrals' => $request->input('referrals'),
                'social_media' => $request->input('social_media'),
                'other_campaigns' => $request->input('other_campaigns'),
                'offline_sources' => $request->input('offline_sources'),
                'display' => $request->input('display'),
                'createdBy' => auth()->user()->id,
                'dateCreated' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
                'isActive' => '1',
        
            ];
    
    
            WebAcquisitionModel::create($formData);
            return redirect('/addreport/webacquisition')->with('message', 'Report Successfully created.');
        
        }
    }

    public function showWebAcquisition(Request $request){
        

            $month = request('month');
            $year = request('year');
        
            $getMonths = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select('tbl_months.month_name as months')
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('months');

            $getTotal = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('direct_traffic+email_marketing+organic_search+paid_search+referrals+social_media+other_campaigns+offline_sources as total'))
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('total');
            
            $getDirectTraffic = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_webacquisition.direct_traffic,0)) as direct_traffic'))
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('direct_traffic');
            
            $getEmailMarketing = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_webacquisition.email_marketing,0)) as email_marketing'))
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('email_marketing');
    
            $getOrganicSearch = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_webacquisition.organic_search,0)) as organic_search'))
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('organic_search');
           
            $getPaidSearch = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_webacquisition.paid_search,0)) as paid_search'))
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('paid_search');
    
            $getReferrals = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_webacquisition.referrals,0)) as referrals'))
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('referrals');
           
            $getSocialMedia = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_webacquisition.social_media,0)) as social_media'))
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('social_media');
            // dd($getPostReach,$getPostEngagement,$getPageLikes,$getVideos);
           

            return view('webacquisition.webacquisitiondashboard',[
                'web' => WebAcquisitionModel::filter(request(['search']),$month,$year)
                ->select(
                    DB::raw('SUM(direct_traffic) as direct_traffic'),
                    DB::raw('SUM(organic_search) as organic_search'),
                    DB::raw('SUM(paid_search) as paid_search'),
                    DB::raw('SUM(referrals) as referrals'),
                    DB::raw('SUM(social_media) as social_media')
          
                )
                // ->where('year','=',DB::raw('YEAR(CURRENT_DATE())'))
                ->where('isActive','=','1')
                ->get(),
                'getMonths' => $getMonths,
                'getDirectTraffic' => $getDirectTraffic,
                'getOrganicSearch' => $getOrganicSearch,
                'getPaidSearch' => $getPaidSearch,
                'getReferrals' => $getReferrals,
                'getSocialMedia' => $getSocialMedia,
                'getEmailMarketing' => $getEmailMarketing,
                'getTotal' => $getTotal,
                // 'getReachMonth'=> $rawMonthReach
                
               
    
            ]);
    
        
       
    }
    public function searchWebAcquisition(Request $request){
        

        $month = request('month');
        $year = request('year');

        // $getMonths = WebAcquisitionModel::filter(request(['search']),$month,$year)
        // ->select('tbl_months.month_name as months')
        // ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
        // ->groupBy('tbl_webacquisition.month')
        // ->orderBy('tbl_months.month_number')
        // ->pluck('months');
        
        // $getTotal = WebAcquisitionModel::filter(request(['search']),$month,$year)
        // ->select( DB::raw('direct_traffic+email_marketing+organic_search+paid_search+referrals+social_media+other_campaigns+offline_sources as total'))
        // ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
        // ->where('isActive','=','1')
        // ->groupBy('tbl_webacquisition.month')
        // ->orderBy('tbl_months.month_number')
        // ->pluck('total');

        // $getDirectTraffic = WebAcquisitionModel::filter(request(['search']),$month,$year)
        // ->select( DB::raw('CAST(SUM(ifnull(tbl_webacquisition.direct_traffic,0)) AS INTEGER) as direct_traffic'))
        // ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
        // ->where('isActive','=','1')
        // ->groupBy('tbl_webacquisition.month')
        // ->orderBy('tbl_months.month_number')
        // ->pluck('direct_traffic');

        // $getEmailMarketing = WebAcquisitionModel::filter(request(['search']),$month,$year)
        // ->select( DB::raw('CAST(SUM(ifnull(tbl_webacquisition.email_marketing,0)) AS INTEGER) as email_marketing'))
        // ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
        // ->where('isActive','=','1')
        // ->groupBy('tbl_webacquisition.month')
        // ->orderBy('tbl_months.month_number')
        // ->pluck('email_marketing');
        
        // $getOrganicSearch = WebAcquisitionModel::filter(request(['search']),$month,$year)
        // ->select( DB::raw('CAST(SUM(ifnull(tbl_webacquisition.organic_search,0)) AS INTEGER) as organic_search'))
        // ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
        // ->where('isActive','=','1')
        // ->groupBy('tbl_webacquisition.month')
        // ->orderBy('tbl_months.month_number')
        // ->pluck('organic_search');
       
        // $getPaidSearch = WebAcquisitionModel::filter(request(['search']),$month,$year)
        // ->select( DB::raw('CAST(SUM(ifnull(tbl_webacquisition.paid_search,0)) AS INTEGER) as paid_search'))
        // ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
        // ->where('isActive','=','1')
        // ->groupBy('tbl_webacquisition.month')
        // ->orderBy('tbl_months.month_number')
        // ->pluck('paid_search');

        // $getReferrals = WebAcquisitionModel::filter(request(['search']),$month,$year)
        // ->select( DB::raw('CAST(SUM(ifnull(tbl_webacquisition.referrals,0)) AS INTEGER) as referrals'))
        // ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
        // ->where('isActive','=','1')
        // ->groupBy('tbl_webacquisition.month')
        // ->orderBy('tbl_months.month_number')
        // ->pluck('referrals');
       
        // $getSocialMedia = WebAcquisitionModel::filter(request(['search']),$month,$year)
        // ->select( DB::raw('CAST(SUM(ifnull(tbl_webacquisition.social_media,0)) AS INTEGER) as social_media'))
        // ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
        // ->where('isActive','=','1')
        // ->groupBy('tbl_webacquisition.month')
        // ->orderBy('tbl_months.month_number')
        // ->pluck('social_media');
        // dd($getPostReach,$getPostEngagement,$getPageLikes,$getVideos);

            $getMonths = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select('tbl_months.month_name as months')
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('months');

            $getTotal = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('direct_traffic+email_marketing+organic_search+paid_search+referrals+social_media+other_campaigns+offline_sources as total'))
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('total');
            
            $getDirectTraffic = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_webacquisition.direct_traffic,0)) as direct_traffic'))
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('direct_traffic');
            
            $getEmailMarketing = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_webacquisition.email_marketing,0)) as email_marketing'))
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('email_marketing');
    
            $getOrganicSearch = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_webacquisition.organic_search,0)) as organic_search'))
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('organic_search');
           
            $getPaidSearch = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_webacquisition.paid_search,0)) as paid_search'))
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('paid_search');
    
            $getReferrals = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_webacquisition.referrals,0)) as referrals'))
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('referrals');
           
            $getSocialMedia = WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_webacquisition.social_media,0)) as social_media'))
            ->rightJoin('tbl_months', 'tbl_webacquisition.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_webacquisition.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('social_media');


        return view('webacquisition.webacquisitiondashboardsearch',[
            'web' => WebAcquisitionModel::filter(request(['search']),$month,$year)
            ->select(
                DB::raw('SUM(direct_traffic) as direct_traffic'),
                DB::raw('SUM(organic_search) as organic_search'),
                DB::raw('SUM(paid_search) as paid_search'),
                DB::raw('SUM(referrals) as referrals'),
                DB::raw('SUM(social_media) as social_media')
      
            )
            // ->where('year','=',DB::raw('YEAR(CURRENT_DATE())'))
            ->where('isActive','=','1')
            ->get(),
            'getMonths' => $getMonths,
            'getDirectTraffic' => $getDirectTraffic,
            'getEmailMarketing' => $getEmailMarketing,
            'getOrganicSearch' => $getOrganicSearch,
            'getPaidSearch' => $getPaidSearch,
            'getReferrals' => $getReferrals,
            'getSocialMedia' => $getSocialMedia,
            'getTotal' => $getTotal,
            'month' => $month,
            'year' => $year,
            // 'getReachMonth'=> $rawMonthReach
            
           

        ]);

   
    }

    public function viewWebAcquisitionRecord(Request $request){

        $getRecord = DB::table('tbl_webacquisition')->paginate(12);
    
        return view('webacquisition.showwebacquisition',[
            
            'getRecord' => $getRecord,

            // 'getReachMonth'=> $rawMonthReach

        ]);

    }
    public function showEditWebAcquisitionReport($webacquisition_number){
       
        $edit = DB::table('tbl_webacquisition')->where('webacquisition_number', $webacquisition_number)->first();
    
        
        return view('webacquisition.editwebacquisition', [
            'edit' => $edit,
        ]);
        
    }

    public function editWebAcquisitionRecord(Request $request, WebAcquisitionModel $edit){
     
        $formData = $request->validate([
            'direct_traffic' => 'required',
            'email_marketing' => 'required',
            'organic_search' => 'required',
            'paid_search' => 'required',
            'referrals' => 'required',
            'social_media' => 'required',
            'other_campaigns' => 'required',
            'offline_sources' => 'required',
            'display' => 'required',
        ]);

        $edit->update([
            // 'modifiedBy' =>  auth()->user()->firstName.' '.auth()->user()->lastName,
            'modifiedBy' =>  auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
        ]);

        $edit->update($formData);

        return back()->with('message','record updated successfully!');
    }

    public function deleteWebAcquisitionRecord(Request $request, WebAcquisitionModel $edit){
     

        $edit->update([
            // 'modifiedBy' =>  auth()->user()->firstName.' '.auth()->user()->lastName,
            
            'modifiedBy' =>  auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
            'isActive' => 0,
        ]);

  

        return back()->with('message','record deleted successfully!');
    }

    public function reactivateWebAcquisitionReport(Request $request, WebAcquisitionModel $edit){
           
        $find = WebAcquisitionModel::find($edit->webacquisition_number);
     
        $find->update([
            'isActive' => '1',
            'modifiedBy' => auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur')
        ]);
   
       
        return back()->with('message','record reactivated!');

    }
}
