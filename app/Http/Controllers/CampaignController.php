<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CampaignModel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    //
    //CATEGORIES
    public function showCategories(){
        return view('campaigncategories.categories');
    }
    
    public function showAddReportCategories(){
        return view('campaigncategories.addreport');
    }

    public function showEditReportCategories(){
        return view('campaigncategories.editreport');

    }

    public function showAddReportWebAcquisition(){
        return view('fbanalytics.addfbanalytics');
    }

    public function addWebAcquisition(Request $request){
        
        $inputmonth = $request->input('month');
        $inputyear = $request->input('year');
        $check = CampaignModel::where('month', '=', $inputmonth)->where('year', '=', $inputyear)->exists();
        // $checkyear = CampaignModel::where('year', '=', $inputyear)->exists();
        
        // $x = $inputmonth .' '.$checkmonth;
        // $y = $inputyear .' '.$checkyear;

        if($check){
                 
            return redirect('/addreport')->with('message', 'Month and year already exist. Please try again.');
        }
        else{

            $formData = $request->validate([
            
                'month' => 'required',
                'year' => 'required',
                'reach' => 'required',
                'impressions' => 'required',
                'link_clicks' => 'required',
                'post_engagement' => 'required',
                'nmc' => 'required',
                'amount_spent' => 'required',
        
            ]);
            $formData = [
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'reach' => $request->input('reach'),
                'impressions' => $request->input('impressions'),
                'link_clicks' => $request->input('link_clicks'),
                'post_engagement' => $request->input('post_engagement'),
                'nmc' => $request->input('nmc'),
                'amount_spent' => $request->input('amount_spent'),
                'createdBy' => auth()->user()->id,
                'dateCreated' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
                'isActive' => '1',
        
            ];
            
    
            CampaignModel::create($formData);
            return redirect('/addreport')->with('message', 'Report Successfully created.');
        
        }
    } 
    public function showWebAcquisition(Request $request){
        

        $month = request('month');
        $year = request('year');

        $getMonths = CampaignModel::filter(request(['search']),$month,$year)
        ->select('tbl_months.month_name as months')
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('months');


        $getReach = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.reach,0)) as reach'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('reach');
       
        $getImpressions = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.impressions,0)) as impressions'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('impressions');

        $getLinkClicks = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.link_clicks,0)) as link_clicks'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('link_clicks');
       
        $getPostEngagement = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.post_engagement,0)) as post_engagement'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('post_engagement');

        $getNMC = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.nmc,0)) as nmc'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('nmc');
    
        $getAmountSpent = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.amount_spent,0)) as amount_spent'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('amount_spent');

    

        return view('webacquisition.webacquisitiondashboard',[
            'campaign' => CampaignModel::filter(request(['search']),$month,$year)
            ->select(
                DB::raw('SUM(reach) as reach'),
                DB::raw('SUM(impressions) as impressions'),
                DB::raw('SUM(link_clicks) as link_clicks'),
                DB::raw('SUM(post_engagement) as post_engagement'),
                DB::raw('SUM(nmc) as nmc'),
                DB::raw('SUM(amount_spent) as amount_spent'))
            
            // ->where('year','=',DB::raw('YEAR(CURRENT_DATE())'))
            ->where('isActive','=','1')
            ->get(),
            'getMonths' => $getMonths,
            'getImpressions' => $getImpressions,
            'getLinkClicks' => $getLinkClicks,
            'getPostEngagement' => $getPostEngagement,
            'getNMC' => $getNMC,
            'getAmountSpent' => $getAmountSpent,
            'getReach' => $getReach,

            // 'getReachMonth'=> $rawMonthReach
            
           

        ]);
   
    }
    public function searchCampaign(Request $request){

        $month = request('month');
        $year = request('year');

        $getMonths = CampaignModel::filter(request(['search']),$month,$year)
        ->select('tbl_months.month_name as months')
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('months');

     
        $getReach = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.reach,0)) as reach'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('reach');
       
        $getImpressions = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.impressions,0)) as impressions'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('impressions');

        $getLinkClicks = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.link_clicks,0)) as link_clicks'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('link_clicks');
       
        $getPostEngagement = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.post_engagement,0)) as post_engagement'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('post_engagement');

        $getNMC = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.nmc,0)) as nmc'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('nmc');
    
        $getAmountSpent = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.amount_spent,0)) as amount_spent'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('amount_spent');

    

        return view('campaign.campaigndashboardsearch',[
            'campaign' => CampaignModel::filter(request(['search']),$month,$year)
            ->select(
                DB::raw('SUM(reach) as reach'),
                DB::raw('SUM(impressions) as impressions'),
                DB::raw('SUM(link_clicks) as link_clicks'),
                DB::raw('SUM(post_engagement) as post_engagement'),
                DB::raw('SUM(nmc) as nmc'),
                DB::raw('SUM(amount_spent) as amount_spent'))
            
            // ->where('year','=',DB::raw('YEAR(CURRENT_DATE())'))
            ->where('isActive','=','1')
            ->get(),
            'getMonths' => $getMonths,
            'getImpressions' => $getImpressions,
            'getLinkClicks' => $getLinkClicks,
            'getPostEngagement' => $getPostEngagement,
            'getNMC' => $getNMC,
            'getAmountSpent' => $getAmountSpent,
            'getReach' => $getReach,
            'month' => $month,
            'year' => $year,

            // 'getReachMonth'=> $rawMonthReach
            
           

        ]);
    }
    
    public function showCampaignDashboard(Request $request){

        $month = request('month');
        $year = request('year');

        $getMonths = CampaignModel::filter(request(['search']),$month,$year)
        ->select('tbl_months.month_name as months')
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('months');


        $getReach = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.reach,0)) as reach'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('reach');
       
        $getImpressions = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.impressions,0)) as impressions'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('impressions');

        $getLinkClicks = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.link_clicks,0)) as link_clicks'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('link_clicks');
       
        $getPostEngagement = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.post_engagement,0)) as post_engagement'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('post_engagement');

        $getNMC = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.nmc,0)) as nmc'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('nmc');
    
        $getAmountSpent = CampaignModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_campaign.amount_spent,0)) as amount_spent'))
        ->rightJoin('tbl_months', 'tbl_campaign.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_campaign.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('amount_spent');

    

        return view('campaign.campaigndashboard',[
            'campaign' => CampaignModel::filter(request(['search']),$month,$year)
            ->select(
                DB::raw('SUM(reach) as reach'),
                DB::raw('SUM(impressions) as impressions'),
                DB::raw('SUM(link_clicks) as link_clicks'),
                DB::raw('SUM(post_engagement) as post_engagement'),
                DB::raw('SUM(nmc) as nmc'),
                DB::raw('SUM(amount_spent) as amount_spent'))
            
            // ->where('year','=',DB::raw('YEAR(CURRENT_DATE())'))
            ->where('isActive','=','1')
            ->get(),
            'getMonths' => $getMonths,
            'getImpressions' => $getImpressions,
            'getLinkClicks' => $getLinkClicks,
            'getPostEngagement' => $getPostEngagement,
            'getNMC' => $getNMC,
            'getAmountSpent' => $getAmountSpent,
            'getReach' => $getReach,

            // 'getReachMonth'=> $rawMonthReach
            
           

        ]);

    }

    public function viewCampaignRecord(Request $request){

        $getRecord = DB::table('tbl_campaign')->paginate(12);
    
        return view('campaign.showcampaign',[
            
            'getRecord' => $getRecord,

            // 'getReachMonth'=> $rawMonthReach

        ]);

    }
    public function showEditReport($campaign_number){
       
        $edit = DB::table('tbl_campaign')->where('campaign_number', $campaign_number)->first();
    
        
        return view('campaign.editcampaign', [
            'edit' => $edit,
        ]);
        
    }

    public function editCampaignRecord(Request $request, CampaignModel $edit){
     
        $formData = $request->validate([
            'reach' => 'required',
            'impressions' => 'required',
            'link_clicks' => 'required',
            'post_engagement' => 'required',
            'nmc' => 'required',
            'amount_spent' => 'required',
        ]);

        $edit->update([
            // 'modifiedBy' =>  auth()->user()->firstName.' '.auth()->user()->lastName,
            'modifiedBy' =>  auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
        ]);

        $edit->update($formData);

        return back()->with('message','record updated successfully!');
    }

    public function deleteCampaignRecord(Request $request, CampaignModel $edit){
     

        $edit->update([
            // 'modifiedBy' =>  auth()->user()->firstName.' '.auth()->user()->lastName,
            
            'modifiedBy' =>  auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
            'isActive' => 0,
        ]);

  

        return back()->with('message','record deleted successfully!');
    }

    public function reactivateReport(Request $request, CampaignModel $edit){
           
        $find = CampaignModel::find($edit->campaign_number);
     
        $find->update([
            'isActive' => '1',
            'modifiedBy' => auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur')
        ]);
   
       
        return back()->with('message','record reactivated!');

    }

    public function showAddReportCampaign(){

        return view('campaign.addcampaign');
    }

    public function addReport(Request $request){
        
        $inputmonth = $request->input('month');
        $inputyear = $request->input('year');
        $check = CampaignModel::where('month', '=', $inputmonth)->where('year', '=', $inputyear)->exists();
        // $checkyear = CampaignModel::where('year', '=', $inputyear)->exists();
        
        // $x = $inputmonth .' '.$checkmonth;
        // $y = $inputyear .' '.$checkyear;
        

        if($check){
                 
            return redirect('/addreport/campaign')->with('message', 'Month and year already exist. Please try again.');
            
     
        }
        else{

            $formData = $request->validate([
            
                'month' => 'required',
                'year' => 'required',
                'reach' => 'required',
                'impressions' => 'required',
                'link_clicks' => 'required',
                'post_engagement' => 'required',
                'nmc' => 'required',
                'amount_spent' => 'required',
        
            ]);
            $formData = [
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'reach' => $request->input('reach'),
                'impressions' => $request->input('impressions'),
                'link_clicks' => $request->input('link_clicks'),
                'post_engagement' => $request->input('post_engagement'),
                'nmc' => $request->input('nmc'),
                'amount_spent' => $request->input('amount_spent'),
                'createdBy' => auth()->user()->id,
                'dateCreated' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
                'isActive' => '1',
        
            ];
            
    
            CampaignModel::create($formData);
            return redirect('/addreport/campaign')->with('message', 'Report Successfully created.');
        
        }
    }
}
