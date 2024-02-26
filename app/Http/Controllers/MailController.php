<?php

namespace App\Http\Controllers;

use Exception;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //

    public function showSendMail($id){

  
        $getEmail = DB::table('tbl_inquiries')->where('inquiryID', $id)->first();
       
    
        return view('emails.sendmail',[
            'getEmail' => $getEmail,
        ]);
    }

    public function sendMail(Request $request,$id){
        $email = DB::table('tbl_inquiries')->where('inquiryID', $id)->first();
        $from = $request->input('from');
        $content = $request->input('content');
        $subject = $request->input('subject');
     
        $details = [
            
            'subject' => $subject,
            'body' => $content,
            'name' => $email->applicantName ? $email->applicantName : $email->fbName,
            'from' => $from,
           
        ];
        // dd($email,$details);
        try{

            Mail::to($email)->send(new SendMail($details));

            return redirect('/viewinquiries')->with('message','Email sent!');
         
        }
        catch(Exception $th){
            // return response()->json(['Something went wrong. Please try again.']);
            return $th;
        }
        
    }
}