<?php

namespace App\Http\Controllers;

use App\Models\LeadSourceModel;
use App\Models\ScoringModel;
use App\Models\ServicesModel;
use App\Models\StatusInquiryModel;
use App\Models\UsertypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;

class SettingsController extends Controller
{
    //
 

    public function showSettings(){
        $services = DB::table('tbl_services')->paginate(20);
        $scoring = DB::table('tbl_scoring')->get();
        $status = DB::table('tbl_status')->get();
        $usertype = DB::table('tbl_usertype')->get();
        $leadsource = DB::table('tbl_leadsource')->get();

        return view('settings.settings',[
            'services' => $services,
            'scoring' => $scoring,
            'status' => $status,
            'usertype' => $usertype,
            'leadsource' => $leadsource,
        ]);
    }



    //-----------------SCORING
    public function showEditScoring($id){
        
        $edit = DB::table('tbl_scoring')->where('scoringID', $id)->first();
       
        
        return view('settings.editscoring', [
            'edit' => $edit,
          
        ]);
  
    }
    //show add scoring page
    public function showAddScoring(){
        return view('settings.addscoring');
    }

    //add scoring
    public function addScoring(Request $request){
        
        $formData = $request->validate([
            'scoringName' => 'required'
    
        ]);

        $formData = [
            'scoringName' => $request->input('scoringName'),
            'isActive' => 1,
            
        ];

        ScoringModel::create($formData);
        return redirect('/settings')->with('message','New Service Added!');
        
    }
    //submit edit scoring
    // public function editScoring(Request $request, ScoringModel $edit){
   
    //     $formData = $request->validate([
    //         'scoringName' => 'required',
            
    //     ]);
     
    //     // $inputedData = $request->input('scoringName');
    
    //     // $edit->update([
    //     //     'scoringName' => $inputedData
    //     // ]);

    //     $edit->update($formData);

    //     return redirect('/settings')->with('message','Scoring updated successfully!');
     
    // }
    public function editScoring(Request $request, ScoringModel $edit){
     
        $formData = $request->validate([
            'scoringName' => 'required',
            
        ]);

        $inputedData = $request->input('serviceName');
     
        // $edit->update([
        //     'scoringName' => $inputedData
        // ]);
        $edit->update($formData);

        return redirect('/settings')->with('message','Scoring updated successfully!');
     
    }
    //delete scoring
    public function deleteScoring(ScoringModel $scoringID){
      
        $scoring = ScoringModel::find($scoringID->scoringID);
     
        $scoring->update([
            'isActive' => '0'
        ]);
    
        // $account->update();
        return redirect('/settings')->with('message', 'Scoring successfully deleted.');

    }

    //reactivate scoring
    public function reactivateScoring(ScoringModel $scoringID){
      
        $scoring = ScoringModel::find($scoringID->scoringID);
     
        $scoring->update([
            'isActive' => '1'
        ]);
    
        // $account->update();
        return redirect('/settings')->with('message', 'Scoring successfully reactivated.');

    }



     //-----------------STATUS
     public function showEditStatus($id){
        
        $edit = DB::table('tbl_status')->where('statusID', $id)->first();
       

        return view('settings.editinquirystatus', [
            'edit' => $edit,
          
        ]);
  
    }

    //show add scoring page
    public function showAddStatus(){
        return view('settings.addinquirystatus');
    }

    //add scoring
    public function addStatus(Request $request){
        
        $formData = $request->validate([
            'statusName' => 'required'
    
        ]);

        $formData = [
            'statusName' => $request->input('statusName'),
            'isActive' => 1,
          
        ];

        StatusInquiryModel::create($formData);
        return redirect('/settings')->with('message','New Status Added!');
     
    }

    //submit edit STATUS
    public function editStatus(Request $request, StatusInquiryModel $edit){
      
        $formData = $request->validate([
            'statusName' => 'required',
            
        ]);

        $inputedData = $request->input('statusName');
  
        $edit->update([
            'statusName' => $inputedData
        ]);

        return redirect('/settings')->with('message','Status updated successfully!');
     
    }

    
    //delete STATUS
    public function deleteStatus(StatusInquiryModel $statusID){
      
        $status = StatusInquiryModel::find($statusID->statusID);
     
        $status->update([
            'isActive' => '0'
        ]);
    
        // $account->update();
        return redirect('/settings')->with('message', 'Inquiry Status successfully deleted.');

    }

    //reactivate status
    public function reactivateStatus(StatusInquiryModel $statusID){
    
        $status = StatusInquiryModel::find($statusID->statusID);

        $status->update([
            'isActive' => '1'
        ]);

        // $account->update();
        return redirect('/settings')->with('message', 'Inquiry Status successfully reactivated.');

    }
    

     //-----------------USERTYPE
    //  public function showEditUsertype($id){
        
    //     $edit = DB::table('tbl_usertype')->where('utID', $id)->first();
       

    //     return view('settings.editusertype', [
    //         'edit' => $edit,
          
    //     ]);
  
    // }

//     //show add usertype page
//     public function showAddUserType(){
//         return view('settings.addusertype');
//     }

//     //add usertype
//     public function addUserType(Request $request){
        
//         $formData = $request->validate([
//             'utName' => 'required'
    
//         ]);

//         $formData = [
//             'utName' => $request->input('utName'),
//             'isActive' => 1,
          
//         ];

//         UsertypeModel::create($formData);
//         return redirect('/settings')->with('message','New User Type Added!');
     
//     }


//     //submit edit USERTYPE
//     public function editUsertype(Request $request, UsertypeModel $edit){
      
//         $formData = $request->validate([
//             'utName' => 'required',
            
//         ]);

//         $inputedData = $request->input('utName');
  
//         $edit->update([
//             'utName' => $inputedData
//         ]);

//         return redirect('/settings')->with('message','User Type updated successfully!');
     
//     }

    
//     //delete USERTYPE
//     public function deleteUsertype(UsertypeModel $utID){
      
//         $usertype = UsertypeModel::find($utID->utID);
     
//         $usertype->update([
//             'isActive' => '0'
//         ]);
    
//         // $account->update();
//         return redirect('/settings')->with('message', 'User Type successfully deleted.');

//     }

//    //delete USERTYPE
//    public function reactivateUsertype(UsertypeModel $utID){
      
//         $usertype = UsertypeModel::find($utID->utID);

//         $usertype->update([
//             'isActive' => '1'
//         ]);

       
//         return redirect('/settings')->with('message', 'User Type successfully reactivated.');

//     }

    //-----------------LEADSOURCE
    public function showEditLeadSource($id){
        
        $edit = DB::table('tbl_leadsource')->where('leadsourceID', $id)->first();
       

        return view('settings.editleadsource', [
            'edit' => $edit,
          
        ]);
  
    }

    //show add leadsource page
    public function showAddLeadSource(){
        return view('settings.addleadsource');
    }

    //add leadsource
    public function addLeadSource(Request $request){
        
        $formData = $request->validate([
            'leadSourceName' => 'required'
    
        ]);

        $formData = [
            'leadSourceName' => $request->input('leadSourceName'),
            'isActive' => 1,
          
        ];

        LeadSourceModel::create($formData);
        return redirect('/settings')->with('message','New Lead Source Added!');
     
    }

    //submit edit LeadSource
    public function editLeadSource(Request $request, LeadSourceModel $edit){
      
        // $formData = $request->validate([
        //     'leadSourceName' => 'required',
            
        // ]);

        $inputedData = $request->input('leadSourceName');
   
        $edit->update([
            'leadSourceName' => $inputedData
        ]);

        return redirect('/settings')->with('message','Lead Source updated successfully!');
     
    }

    
    //delete LeadSource
    public function deleteLeadSource(LeadSourceModel $leadsourceID){
      
        $ls = LeadSourceModel::find($leadsourceID->leadsourceID);
     
        $ls->update([
            'isActive' => '0'
        ]);
    
        // $account->update();
        return redirect('/settings')->with('message', 'Lead Source Status successfully deleted.');

    }
    
    //delete LeadSource
    public function reactivateLeadSource(LeadSourceModel $leadsourceID){
      
        $ls = LeadSourceModel::find($leadsourceID->leadsourceID);
     
        $ls->update([
            'isActive' => '1'
        ]);
    
        // $account->update();
        return redirect('/settings')->with('message', 'Lead Source Status successfully reactivated.');

    }

    //-----------------SERVICES
    public function showEditServices($id){
        
        $edit = DB::table('tbl_services')->where('serviceID', $id)->first();
       

        return view('settings.editservices', [
            'edit' => $edit,
          
        ]);
  
    }
    //show add service page
    public function showAddServices(){
        return view('settings.addservice');
    }

    //add service
    public function addService(Request $request){
        
        $formData = $request->validate([
            'serviceName' => 'required'
    
        ]);

        $formData = [
            'serviceName' => $request->input('serviceName'),
            'isActive' => 1,
          
        ];

        ServicesModel::create($formData);
        return redirect('/settings')->with('message','New Service Added!');
     
    }

    //submit edit SERVICES
    public function editServices(Request $request, ServicesModel $edit){
      
        $formData = $request->validate([
            'serviceName' => 'required',
            
        ]);

        $inputedData = $request->input('serviceName');
  
        $edit->update([
            'serviceName' => $inputedData
        ]);

        return redirect('/settings')->with('message','Service updated successfully!');
     
    }

    
    //delete SERVICES
    public function deleteServices(ServicesModel $serviceID){
      
        $services = ServicesModel::find($serviceID->serviceID);
     
        $services->update([
            'isActive' => '0'
        ]);
    
        // $account->update();
        return redirect('/settings')->with('message', 'Service successfully deleted.');

    }
    

    //reactivate SERVICES
    public function reactivateService(ServicesModel $serviceID){
      
        $services = ServicesModel::find($serviceID->serviceID);
     
        $services->update([
            'isActive' => '1'
        ]);
    
        // $account->update();
        return redirect('/settings')->with('message', 'Service successfully reactivated.');

    }
}
