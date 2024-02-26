<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{

    


    //my profile section
    public function myProfile($aid){
        $edit = DB::table('tbl_accounts')->where('id', $aid)->first();
        $usertype = DB::table('tbl_usertype')->get();
        
        return view('myprofile.myprofile', [
            'edit' => $edit,
            'usertype' => $usertype,
        ]);
    }

    //submit edit profile
    public function editProfile(Request $request, Accounts $edit){


        $formData = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'dateCreated' =>  'required',
            'isActive' => 'required',
            
        ]);

        if($request->hasFile('accountPicture')){
            $formData['accountPicture'] = $request->file('accountPicture')->store('emp_image','public');
        }
        // $formData['password'] = bcrypt($formData['password']);
        
        $edit->update([
            'modifiedBy' => auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur')
        ]);
   
       

        $edit->update($formData);

        return back()->with('message','Account updated successfully!');
    }

    public function showChangePasswordPage($id){
          
        $edit = DB::table('tbl_accounts')->where('id', $id)->first();

        return view('myprofile.changepassword', [
            'edit' => $edit,
          
        ]);
  
    }

    //submit edit change passwrod profile
    public function updatePassword(Request $request, Accounts $edit){


        $formData = $request->validate([
            'password' => 'required',
            
        ]);

        $formData['password'] = bcrypt($formData['password']);
        
        $edit->update([
            'modifiedBy' => auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur')
        ]);

    

        $edit->update($formData);

        return back()->with('message','Password updated successfully!');
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////

    //view all employee
    public function viewemployee(Request $request){
       
        $select = request('category');
        $advsearch = request('advSearch');
        return view('employee.viewemployee',[
            'accounts' => Accounts::filter(request(['search']),$select,$advsearch)
            ->join('tbl_usertype', 'tbl_accounts.userType', '=', 'tbl_usertype.utID')
            // ->where('tbl_accounts.isActive', '=', '1')
            ->select('tbl_accounts.*', 'tbl_usertype.utName')
            ->paginate(100)
        ]);
    
     
    }

    //advanced search
    public function advancedSearch(Request $request){

    
        return view('employee.viewemployee',[
            'accounts' => Accounts::filter(request(['advSearch']))
            ->join('tbl_usertype', 'tbl_accounts.userType', '=', 'tbl_usertype.utID')
            ->where('tbl_accounts.isActive', '=', '1')
            ->select('tbl_accounts.*', 'tbl_usertype.utName')
            ->paginate(20)
        ]);
    }
    //add employee section
    public function showAddEmployee(){

        $usertype = DB::table('tbl_usertype')->where('isActive', '=', '1')->get();
        return view('employee.addemployee',[
            'usertype' => $usertype
        ]);
    }

    public function addEmployee(Request $request){

       

        $formData = $request->validate([
            'firstName' => ['required','min:3'],
            'lastName' => ['required','min:2'],
            'username' => ['required', Rule::unique('tbl_accounts', 'username')],
            'password' => 'required|confirmed|min:6',
            'email' => ['required', 'email', Rule::unique('tbl_accounts','email')],
            'userType' => 'required',
            'worksite' => 'required',
 
            
        ]);

        $formData['password'] = bcrypt($formData['password']);

        if($request->hasFile('accountPicture')){
            $formData['accountPicture'] = $request->file('accountPicture')->store('emp_image','public');
        }
        
        $formData += [
            'dateCreated' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
            'isActive' => 1,
            
          
        ];
        Accounts::create($formData);
        return redirect('/viewemployee')->with('message','Account created successfully!');
    }


    //edit employee section
    public function showEditEmployee($aid){
        $edit = DB::table('tbl_accounts')->where('id', $aid)->first();
        $usertype = DB::table('tbl_usertype')->where('isActive', '=', '1')->get();
        $worksite = DB::table('tbl_accounts')
        ->select('worksite')
        ->groupBy('worksite')
        ->get();
        

        return view('employee.editemployee', [
            'edit' => $edit,
            'usertype' => $usertype,
            'worksite' => $worksite,
        ]);
    }

    //submit edit employee
    public function edit(Request $request, Accounts $edit){
     
        $formData = $request->validate([
            'worksite' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            // 'email' => ['required', 'email'],
            'userType' => 'required',
            
        ]);
       
        if($request->hasFile('accountPicture')){
            $formData['accountPicture'] = $request->file('accountPicture')->store('emp_image','public');
        }
    

        $edit->update([
            'modifiedBy' => auth()->user()->firstName .' '. auth()->user()->lastName,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur')
        ]);

        $edit->update($formData);

        return back()->with('message','Account updated successfully!');
    }
      //submit edit change passwrod 
      public function updateEmployeePassword(Request $request, Accounts $edit){


        $formData = $request->validate([
            'password' => 'required',
            
        ]);

        $formData['password'] = bcrypt($formData['password']);
        
        $edit->update([
            'modifiedBy' => auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur')
        ]);

    

        $edit->update($formData);

        return back()->with('message','Password updated successfully!');
    }

    //delete employee
    public function deleteAccount(Accounts $account){
      
        $accountedit = Accounts::find($account->id);
     
        $accountedit->update([
            'isActive' => '0',
            'modifiedBy' => auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur')
        ]);
  
        // $account->update();
        return redirect('/viewemployee')->with('message', 'Account successfully deleted.');

    }

    //reactivate employee
    public function reactivateAccount(Accounts $account){
      
        $accountedit = Accounts::find($account->id);
     
        $accountedit->update([
            'isActive' => '1',
            'modifiedBy' => auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur')
        ]);
  
        // $account->update();
        return redirect('/viewemployee')->with('message', 'Account Reactivated.');

    }
    // public function show(Accounts $accounts){
    //     return view('viewemployee/{accounts}',[
    //         'accounts' => $accounts
    //     ]);
    // }
}
