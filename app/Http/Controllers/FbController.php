<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\FbModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FbController extends Controller
{
    //
 

    public function showAddReportFB(){
        return view('fbanalytics.addfbanalytics');
    }

    public function addFbAnalytics(Request $request){
        
        $inputmonth = $request->input('month');
        $inputyear = $request->input('year');
        $check = FbModel::where('month', '=', $inputmonth)->where('year', '=', $inputyear)->exists();
        // $checkyear = CampaignModel::where('year', '=', $inputyear)->exists();
        
        // $x = $inputmonth .' '.$checkmonth;
        // $y = $inputyear .' '.$checkyear;

        if($check){
                 
            return redirect('/addreport/fbanalytics')->with('message', 'Month and year already exist. Please try again.');
        }
        else{

            $formData = $request->validate([
            
                'month' => 'required',
                'year' => 'required',
                'page_likes' => 'required',
                'post_reach' => 'required',
                'post_engagement' => 'required',
                'videos' => 'required',
        
            ]);
            $formData = [
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'page_likes' => $request->input('page_likes'),
                'post_reach' => $request->input('post_reach'),
                'post_engagement' => $request->input('post_engagement'),
                'videos' => $request->input('videos'),
                'createdBy' => auth()->user()->id,
                'dateCreated' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
                'isActive' => '1',
        
            ];
            
    
            FbModel::create($formData);
            return redirect('/addreport/fbanalytics')->with('message', 'Report Successfully created.');
        
        }
    }

    public function showFbAnalytics(Request $request){
        

            $month = request('month');
            $year = request('year');
    
            $getMonths = FbModel::filter(request(['search']),$month,$year)
            ->select('tbl_months.month_name as months')
            ->rightJoin('tbl_months', 'tbl_fbanalytics.month', '=', 'tbl_months.month_number')
            ->groupBy('tbl_fbanalytics.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('months');

            $getPageLikes = FbModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_fbanalytics.page_likes,0)) as page_likes'))
            ->rightJoin('tbl_months', 'tbl_fbanalytics.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_fbanalytics.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('page_likes');
    
    
            $getPostReach = FbModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_fbanalytics.post_reach,0)) as post_reach'))
            ->rightJoin('tbl_months', 'tbl_fbanalytics.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_fbanalytics.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('post_reach');
           
            $getPostEngagement = FbModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_fbanalytics.post_engagement,0)) as post_engagement'))
            ->rightJoin('tbl_months', 'tbl_fbanalytics.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_fbanalytics.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('post_engagement');
    
            $getVideos = FbModel::filter(request(['search']),$month,$year)
            ->select( DB::raw('SUM(ifnull(tbl_fbanalytics.videos,0)) as videos'))
            ->rightJoin('tbl_months', 'tbl_fbanalytics.month', '=', 'tbl_months.month_number')
            ->where('isActive','=','1')
            ->groupBy('tbl_fbanalytics.month')
            ->orderBy('tbl_months.month_number')
            ->pluck('videos');
           
            // dd($getPostReach,$getPostEngagement,$getPageLikes,$getVideos);
    
            return view('fbanalytics.fbanalyticsdashboard',[
                'fb' => FbModel::filter(request(['search']),$month,$year)
                ->select(
                    DB::raw('SUM(page_likes) as page_likes'),
                    DB::raw('SUM(post_reach) as post_reach'),
                    DB::raw('SUM(post_engagement) as post_engagement'),
                    DB::raw('SUM(videos) as videos')
          
                )
                // ->where('year','=',DB::raw('YEAR(CURRENT_DATE())'))
                ->where('isActive','=','1')
                ->get(),
                'getMonths' => $getMonths,
                'getPageLikes' => $getPageLikes,
                'getPostReach' => $getPostReach,
                'getPostEngagement' => $getPostEngagement,
                'getVideos' => $getVideos,
                'month' => $month,
                'year' => $year,
                // 'getReachMonth'=> $rawMonthReach
                
               
    
            ]);
    
        
       
    }
    public function searchFbAnalytics(Request $request){
        

        $month = request('month');
        $year = request('year');
        
        $getMonths = FbModel::filter(request(['search']),$month,$year)
        ->select('tbl_months.month_name as months')
        ->rightJoin('tbl_months', 'tbl_fbanalytics.month', '=', 'tbl_months.month_number')
        ->groupBy('tbl_fbanalytics.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('months');

        $getPageLikes = FbModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_fbanalytics.page_likes,0)) as page_likes'))
        ->rightJoin('tbl_months', 'tbl_fbanalytics.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_fbanalytics.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('page_likes');


        $getPostReach = FbModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_fbanalytics.post_reach,0)) as post_reach'))
        ->rightJoin('tbl_months', 'tbl_fbanalytics.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_fbanalytics.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('post_reach');
       
        $getPostEngagement = FbModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_fbanalytics.post_engagement,0)) as post_engagement'))
        ->rightJoin('tbl_months', 'tbl_fbanalytics.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_fbanalytics.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('post_engagement');

        $getVideos = FbModel::filter(request(['search']),$month,$year)
        ->select( DB::raw('SUM(ifnull(tbl_fbanalytics.videos,0)) as videos'))
        ->rightJoin('tbl_months', 'tbl_fbanalytics.month', '=', 'tbl_months.month_number')
        ->where('isActive','=','1')
        ->groupBy('tbl_fbanalytics.month')
        ->orderBy('tbl_months.month_number')
        ->pluck('videos');
       
        // dd($getPostReach,$getPostEngagement,$getPageLikes,$getVideos);

        return view('fbanalytics.fbanalyticsdashboardsearch',[
            'fb' => FbModel::filter(request(['search']),$month,$year)
            ->select(
                DB::raw('SUM(page_likes) as page_likes'),
                DB::raw('SUM(post_reach) as post_reach'),
                DB::raw('SUM(post_engagement) as post_engagement'),
                DB::raw('SUM(videos) as videos')
      
            )
            // ->where('year','=',DB::raw('YEAR(CURRENT_DATE())'))
            ->where('isActive','=','1')
            ->get(),
            'getMonths' => $getMonths,
            'getPageLikes' => $getPageLikes,
            'getPostReach' => $getPostReach,
            'getPostEngagement' => $getPostEngagement,
            'getVideos' => $getVideos,
            'month' => $month,
            'year' => $year,
            // 'getReachMonth'=> $rawMonthReach
            
           

        ]);

    
   
    }
    public function viewFbAnalyticsRecord(Request $request){

        $getRecord = DB::table('tbl_fbanalytics')->paginate(12);
    
        return view('fbanalytics.showfbanalytics',[
            
            'getRecord' => $getRecord,

            // 'getReachMonth'=> $rawMonthReach

        ]);

    }
    public function showEditFbAnalyticsReport($fbanalytics_number){
       
        $edit = DB::table('tbl_fbanalytics')->where('fbanalytics_number', $fbanalytics_number)->first();
    
        
        return view('fbanalytics.editfbanalytics', [
            'edit' => $edit,
        ]);
        
    }

    public function editFbAnalyticsRecord(Request $request, FbModel $edit){
     
        $formData = $request->validate([
            'page_likes' => 'required',
            'post_reach' => 'required',
            'post_engagement' => 'required',
            'videos' => 'required',
        ]);

        $edit->update([
            // 'modifiedBy' =>  auth()->user()->firstName.' '.auth()->user()->lastName,
            'modifiedBy' =>  auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
        ]);

        $edit->update($formData);

        return redirect('/editreport/fbanalytics')->with('message', 'Record updated successfully.');
    }

    public function deleteFbAnalyticsRecord(Request $request, FbModel $edit){
     

        $edit->update([
            // 'modifiedBy' =>  auth()->user()->firstName.' '.auth()->user()->lastName,
            
            'modifiedBy' =>  auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
            'isActive' => 0,
        ]);

  

        return back()->with('message','record deleted successfully!');
    }

    public function reactivateFbAnalyticsReport(Request $request, FbModel $edit){
           
        $find = FbModel::find($edit->fbanalytics_number);
     
        $find->update([
            'isActive' => '1',
            'modifiedBy' => auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur')
        ]);
   
       
        return back()->with('message','record reactivated!');

    }
}
