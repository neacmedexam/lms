<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Inquiries;
use Illuminate\Http\Request;
use App\Models\ServicesModel;
use App\Models\StatusInquiryModel;
use App\Models\UpdateHistoryModel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Arr;

class InquiryController extends Controller
{
    //
    //view applicant button
    public function forViewInquiries($id){
        $edit = DB::table('tbl_inquiries')->where('inquiryID', $id)->first();
      
        
        $lc = DB::table('tbl_accounts')
        ->join('tbl_usertype', 'tbl_accounts.userType', '=' , 'tbl_usertype.utID')
        ->where('tbl_accounts.userType', 2)
        ->orWhere('tbl_accounts.userType',3)
        ->where('tbl_accounts.isActive', '=', '1')->get();


        $getAvailedServices = DB::select(DB::raw("
            SELECT ts.serviceName as servicename
           
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
                    AND t1.inquiryID = $id
                ) AS inq
            ON inq.stype = ts.serviceID
            GROUP BY serviceID
            ORDER BY serviceID;
        "));
        $getServiceAndPaymentAndLCAndNotes = DB::select(DB::raw("
            SELECT tbl_services.serviceName as servicename
                , x.servicetype as servicenumber
                , tbl_status.statusName as statusname
                , x.status as statusnumber
                , CAST(x.sdate as DATETIME) as sdate
                , x.assignedLCID as assignedlcid
                , x.notes as notes
                
                FROM (
                    SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.serviceType  ,',',seq.n-1) FROM SUBSTRING_INDEX(t1.serviceType  ,',',seq.n)), ',','') AS servicetype
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
                    AND t1.inquiryID = $id
                ) AS x
            JOIN tbl_status   ON x.status      = tbl_status.statusID
            JOIN tbl_services ON x.servicetype = tbl_services.serviceID
            ORDER BY x.servicetype+0;
        "));
           
        // $scoring = DB::table('tbl_scoring')->where('isActive', '=', '1')->get();
        $scoring = DB::table('tbl_scoring')
        ->join('tbl_inquiries', 'tbl_scoring.scoringID','=','tbl_inquiries.scoring')
        ->where('tbl_inquiries.isActive', '=', '1')
        ->where('tbl_inquiries.inquiryID','=',$id)
        ->first();
        $leadsource = DB::table('tbl_leadsource')->where('isActive', '=', '1')->get();
        $services = DB::table('tbl_services')->where('isActive', '=', '1')->get();
        // $representatives = DB::table('tbl_accounts')->where('isActive', '=', '1')->get();
              $representatives = DB::table('tbl_accounts')
        ->join('tbl_usertype', 'tbl_accounts.userType', '=' , 'tbl_usertype.utID')
        ->whereIn('tbl_accounts.userType', [2,3])
        ->where('tbl_accounts.isActive', '=', '1')->get();
        $status = DB::table('tbl_status')->where('isActive', '=', '1')->get();
        $rep = array_map('intval', explode(',', $edit->representative));
        
        $serviceType = explode(',',$edit->serviceType);
      
        $paymentStatus = array_map('intval', explode(',', $edit->paymentStatus));
        $datePaid = explode(',',$edit->sampDate);
        $assignedLC = array_map('intval', explode(',', $edit->assignedLC));
        // dd($paymentStatus,$datePaid,$assignedLC);
        // dd($edit->assignedLC,$assignedLC[0]);
        return view('inquiry.forviewinquiry', [
            'edit' => $edit,
            // 'assignedLC' => $lc,
            'scoring' => $scoring->scoringName,
            'leadsource' => $leadsource,
            'services' => $services,
            'representatives' => $representatives,
            'status' => $status,
            'lc' => $lc,
            'serviceType' => $serviceType,
            'rep' => $rep,
            'getAvailedServices' => $getAvailedServices,
            'paymentStatus' => $paymentStatus,
            'getServiceAndPaymentAndLCAndNotes' => $getServiceAndPaymentAndLCAndNotes,
            'datePaid' => $datePaid,
            'destination' => $edit->paymentStatus,
            'assignedLC' => $assignedLC,
            
          
          
        ]);
    }


    public function viewInquiries(Request $request){
        $select = request('category');
        $advsearch = request('advSearch');
        $servicefilter = request('services');
        $statusfilter = request('status');
        $services = DB::table('tbl_services')->where('isActive', '=', '1')->get();
        $status = DB::table('tbl_status')->where('isActive', '=', '1')->get();
        // dd($status);
        
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        
        $getserviceid = $request->input('services');
        $getstatusid = $request->input('status');

        $fetchService = ServicesModel::select('serviceName')
        ->where('serviceID','=', $getserviceid)
        ->first();

        $fetchStatus = StatusInquiryModel::select('statusName')
        ->where('statusID','=', $getstatusid)
        ->first();
        
        $getServiceName = null;
        $getStatusName = null;

        if($fetchService !== null){
            $getServiceName = $fetchService->serviceName;
     
        }
        else{
            $getServiceName = null;
         
        }
    
        if($fetchStatus !== null){
            $getStatusName = $fetchStatus->statusName;
        }
        else{
            $getStatusName = null;
        }
    
        return view('inquiry.viewinquiry',[
            'inquiries' => Inquiries::filter(request(['search']),$select,$advsearch,$servicefilter,$statusfilter)
            ->join('tbl_services', 'tbl_inquiries.serviceType', '=', 'tbl_services.serviceID')
            ->join('tbl_leadsource', 'tbl_inquiries.inquiryLeadSource', '=', 'tbl_leadsource.leadsourceID')
            ->join('tbl_status', 'tbl_inquiries.paymentStatus', '=', 'tbl_status.statusID')
            ->join('tbl_scoring', 'tbl_inquiries.scoring', '=', 'tbl_scoring.scoringID')
            // ->join('tbl_accounts', 'tbl_inquiries.representative', '=', 'tbl_accounts.id')
            ->join('tbl_accounts', 'tbl_inquiries.createdBy', '=', 'tbl_accounts.id')
            ->join('tbl_inquirytype','tbl_inquiries.inquiryType','=','tbl_inquirytype.itID')
            ->where('tbl_accounts.isActive', '=', '1')
            ->select('tbl_inquiries.*', 'tbl_services.serviceName', 'tbl_leadsource.leadSourceName', 'tbl_status.statusName', 'tbl_scoring.scoringName', 'tbl_accounts.firstName' , 'tbl_accounts.lastName','tbl_inquirytype.itName')
            ->orderBy('tbl_inquiries.inquiryID','desc')
            ->paginate(100),
            'leadsource' => DB::table('tbl_leadsource')->get(),
            'services' => $services,
            'status' => $status,
            'countries' => $countries,
            'fetchService' => $getServiceName,
            'fetchStatus' => $getStatusName,
        ]);
    }
    public function showImportInquiries(){
        return view('inquiry.importinquiry');
    }
    public function showAddInquiries(){
        
        $services = DB::table('tbl_services')->where('isActive', '=', '1')->get();
        $leadsource = DB::table('tbl_leadsource')->where('isActive', '=', '1')->get();
        $inquiryType = DB::table('tbl_inquirytype')->where('isActive','=',1)->get();
        $representatives = DB::table('tbl_accounts')
        ->where('isActive', '=', '1')
        ->where('userType','=','2')
        ->orWhere('userType','=','3')
        ->get();
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        if(auth()->user()->userType == 5){
            return view('inquiry.addinquiryx',[
            'services' => $services,
            'leadsource' => $leadsource,
            'representatives' => $representatives,
            'countries' => $countries,
            'inquirytype' => $inquiryType,
        ]);
        }
        else{
            return view('inquiry.addinquiry',[
            'services' => $services,
            'leadsource' => $leadsource,
            'representatives' => $representatives,
            'countries' => $countries,
            'inquirytype' => $inquiryType,
        ]);
        }
    }

    public function addInquiry(Request $request){
        
        $x = $request->input('serviceType');

        // $fullname = Inquiries::where('applicantName', '=', $request->input('applicantName'))
        // ->select('applicantName')
        // ->first();

        $email = Inquiries::where('email', '=', $request->input('email'))
        ->select('email')
        ->count();

        $fb = Inquiries::where('fbName', '=', $request->input('fbName'))
        ->select('fbName')
        ->count();

        $fullname = Inquiries::where('applicantName', '=', $request->input('applicantName'))
        ->select('applicantName')
        ->count();
        
        $rawemail = $request->input('email');
        $rawfb = $request->input('fbName');
        $rawfname = $request->input('applicantName');

        // if($rawfname != null){
        //     dd("no text",$rawfname);
        // }
        
        if($rawemail != null && $rawfb != null){
            if ($email > 0 && $fb > 0){
                // $formData = $request->validate([
                //     'email' => Rule::unique('tbl_inquiries','email'),
                //     'fbName' => Rule::unique('tbl_inquiries','fbName'),
    
                // ]);
                throw ValidationException::withMessages([
                    'email' => ['Email already exists.'],
                    'fbName' => ['This facebook account already exists.']
                ]);
            }
        }

        if($rawemail != null){
            // dd("may laman ang email",$rawemail,$email);
            if ($email > 0){
                // $formData = $request->validate([
                //     'email' => Rule::unique('tbl_inquiries','email'),
    
                // ]);
                throw ValidationException::withMessages([
                    'email' => ['Email already exists'],
                ]);
            }
        }

        if($rawfb != null){
            // dd("may laman ang fb",$rawfb,$fb);
            if ($fb > 0){
                // $formData = $request->validate([
                //     'fbName' => Rule::unique('tbl_inquiries','fbName'),
    
                // ]);
                throw ValidationException::withMessages([
                    'fbName' => ['This facebook account already exists.']
                ]);
            }
        }
        // else{
            // if($rawemail == null && $rawfb == null){
                
     
            //     $formData = $request->validate([
            //         'email' => 'required',
            //         'fbName' => 'required',
            //         'inquiryLeadSource' => 'required',
            //         'scoring' => 'required',
    
            //     ]);
            // }
            // else if($rawfb == null && $rawemail != null){
               
            //     $formData = $request->validate([
            //         'fbName' => 'required',
            //         'inquiryLeadSource' => 'required',
            //         'scoring' => 'required',
    
            //     ]);
            // }
            // else if($rawemail == null && $rawfb != null){
               
            //     $formData = $request->validate([
            //         'email' => 'required',
            //         'inquiryLeadSource' => 'required',
            //         'scoring' => 'required',
    
            //     ]);
            // }
        if($rawfname == null){
            $formData = $request->validate([
                // 'applicantName' => 'required',
                'inquiryLeadSource' => 'required',
                'scoring' => 'required',

            ]);
        }
            
            
        // }

        $representatives = '';
        $serviceType = '';
        $paymentStatus = '';
        $datePaidPerService = '';
        $assignedLC = '';
        $notes = '';
        
        $insertRepresentatives = [];
        $insertPaymentStatus = [];
        $insertDatePaidStatus = [];
        $insertAssignedLC = [];
        $insertNotes = [];
        if($x){
            foreach($x as $y){
                $insertPaymentStatus[] = 1;
                $insertDatePaidStatus[] = '';
                $insertAssignedLC[] = '';
                $insertNotes[] = '';
                // $insertRepresentatives[] = '';
                $insertRepresentatives[] = $request->input('representative');
            }
            $representatives = implode(',',$insertRepresentatives);
            $serviceType = implode(',', $request->input('serviceType'));
            $paymentStatus = implode(',',$insertPaymentStatus);
            $datePaidPerService = implode(',',$insertDatePaidStatus);
            $assignedLC = implode(',',$insertAssignedLC);
            $notes = implode(',',$insertNotes);
        }
 
    // dd($representatives);
        
        $formData = $request->validate([
            'inquiryLeadSource' => 'required',
            'phoneNumber' => $request->input('phoneNumber') ? 'required' : '',
            'countryReside' => $request->input('countryReside') ? 'required' : '',
            'scoring' => $request->input('scoring') ? 'required' : '',
            'serviceType' => 'required',
 
        ]);

        $formData = [
            'inquiryLeadSource' => $request->input('inquiryLeadSource') ,
            'applicantName' => $request->input('applicantName'),
            'fbName' => $request->input('fbName'),
            'email' => $request->input('email'),
            'phoneNumber' => $request->input('phoneNumber'),
            'countryReside' => $request->input('countryReside'),
            'inquiryType' => $request->input('inquiryType'),
            'serviceType' => $serviceType,
            'paymentStatus' => $paymentStatus,
            'scoring' => $request->input('scoring'),
            'assignedLC' => $assignedLC,
            'notes' => $notes,
            'representative' => $representatives,
            'createdBy' => auth()->user()->id,
            'dateCreated' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
            'isActive' => 1,
            'sampDate' => $datePaidPerService,
        ];
        // dd($formData);
  
        Inquiries::create($formData);

        return redirect('/viewinquiries')->with('message', 'Inquiry Successfully created.');
        
    }

    public function showEditInquiries($id){
        
        $edit = DB::table('tbl_inquiries')->where('inquiryID', $id)->first();
        
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        
        $getAvailedServices = DB::select(DB::raw("
            SELECT ts.serviceName as servicename
           
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
                    AND t1.inquiryID = $id
                ) AS inq
            ON inq.stype = ts.serviceID
            GROUP BY serviceID
            ORDER BY serviceID;
        "));
     
    

        $getServiceAndPaymentAndLCAndNotes = DB::select(DB::raw("
            SELECT tbl_services.serviceName as servicename
                , x.servicetype as servicenumber
                , tbl_status.statusName as statusname
                , x.status as statusnumber
                , CAST(x.sdate as DATETIME) as sdate
                , x.assignedLCID as assignedlcid
                , x.notes as notes
                
                FROM (
                    SELECT REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.serviceType  ,',',seq.n-1) FROM SUBSTRING_INDEX(t1.serviceType  ,',',seq.n)), ',','') AS servicetype
                        , REPLACE(TRIM(LEADING SUBSTRING_INDEX(t1.representative,',',seq.n-1) FROM SUBSTRING_INDEX(t1.representative,',',seq.n)), ',','') AS representative
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
                    AND t1.inquiryID = $id
                ) AS x
            JOIN tbl_status   ON x.status      = tbl_status.statusID
            JOIN tbl_services ON x.servicetype = tbl_services.serviceID
            GROUP BY serviceID
            ORDER BY serviceID;
        "));
        $listscoring = DB::table('tbl_scoring')
        ->where('isActive', '=', '1')
        ->where('scoringID','!=','3')
        ->get();
        
      
        $scoring = DB::table('tbl_scoring')
        ->join('tbl_inquiries', 'tbl_scoring.scoringID','=','tbl_inquiries.scoring')
        ->where('tbl_inquiries.isActive', '=', '1')
        ->where('tbl_inquiries.inquiryID','=',$id)
        ->first();

        $leadsource = DB::table('tbl_leadsource')->where('isActive', '=', '1')->get();
        $services = DB::table('tbl_services')->where('isActive', '=', '1')->get();
        $status = DB::table('tbl_status')->where('isActive', '=', '1')->get();
    
        $inquiryType = DB::table('tbl_inquirytype')->where('isActive','=','1')->get();
    
        $lc = DB::table('tbl_accounts')
        ->join('tbl_usertype', 'tbl_accounts.userType', '=' , 'tbl_usertype.utID')
        ->whereIn('tbl_accounts.userType', [2,3])
        ->where('tbl_accounts.isActive', '=', '1')->get();
        
    
        $representatives = DB::table('tbl_accounts')
        ->join('tbl_usertype', 'tbl_accounts.userType', '=' , 'tbl_usertype.utID')
        ->whereIn('tbl_accounts.userType', [2,3])
        ->where('tbl_accounts.isActive', '=', '1')->get();
        
        $notrep = DB::table('tbl_accounts')
        ->join('tbl_usertype', 'tbl_accounts.userType', '=' , 'tbl_usertype.utID')
        ->whereNotIn('tbl_accounts.userType', [2,3])->get();
        
        // dd($notrep->count());
   
        
        $serviceType = explode(',',$edit->serviceType);
      
        
        $paymentStatus = array_map('intval', explode(',', $edit->paymentStatus));
        $assignedLC = array_map('intval', explode(',', $edit->assignedLC));
        $rep = array_map('intval', explode(',', $edit->representative));
        $datePaid = explode(',',$edit->sampDate);
        
        $requestEdit = DB::table('tbl_inquiries')
        ->join('tbl_accounts', 'tbl_inquiries.canEdit', '=', 'tbl_accounts.id')
        ->where('inquiryID', $id)
        ->get();
        
        $checkRequestEdit = DB::table('tbl_inquiries')
        ->join('tbl_accounts', 'tbl_inquiries.approvedEdit', '=', 'tbl_accounts.id')
        ->where('inquiryID', $id)
        ->first();


        $history = DB::table('tbl_updatehistory')
        ->join('tbl_accounts', 'tbl_updatehistory.accountID', '=', 'tbl_accounts.id')
        ->select('tbl_updatehistory.*','tbl_accounts.*','tbl_updatehistory.dateCreated as dateCreated')
        ->where('tbl_updatehistory.inquiryID', $id)
        ->orderBy('updateID','desc')
        ->get();
        // dd($history);
        // dd($lc,$assignedLC);
        
        // $socmed = array(
        //     'Facebook', 
        //     'Twitter', 
        //     'Instagram', 
        //     'Github'
        // );
        // $selectedstatus = array(1, 1, 0, 1);

        // $statuslist = array('None', 'Created');

        //  dd($assignedLC,$selectedstatus);
        

        return view('inquiry.editapplicantprofile', [
            'edit' => $edit,
            'assignedLC' => $lc,
            'scoring' => $scoring->scoringName,
            'scoringid' =>$scoring->scoringID,
            'listscoring' => $listscoring,
            'leadsource' => $leadsource,
            'services' => $services,
            'representatives' => $representatives,
            'notrep' => $notrep->count()+1,
            'status' => $status,
            'lc' => $lc,
            'serviceType' => $serviceType,
            'getAvailedServices' => $getAvailedServices,
            'paymentStatus' => $paymentStatus,
            'getServiceAndPaymentAndLCAndNotes' => $getServiceAndPaymentAndLCAndNotes,
            'datePaid' => $datePaid,
            'destination' => $edit->paymentStatus,
            'servicesraw' =>$edit->serviceType,
            'fixedprevstatus' => $edit->paymentStatus,
            'countries' => $countries,
            'assignedLC' => $assignedLC,
            'rep' => $rep,
            'inquiryType' => $inquiryType,
            'requestEdit' => $requestEdit,
            'checkRequestEdit' => $checkRequestEdit,
            'history' => $history,
            // 'socmed' => $socmed,
            // 'statuslist' => $statuslist,
            // 'selectedstatus' => $selectedstatus,
          
          
        ]);
  
    }

    // public function edit(Request $request, Inquiries $edit){
        

    //     $x = $request->input('serviceType') ? $request->input('serviceType') : 0;
        

    //     $updatePaymentStatus = [];
    //     $updateDatePaidStatus = [];
    //     $updateAssignedLC = [];
    //     $updateNotes = [];

    //     $willUpdateStatus = $request->input('destination');
    //     $fixedStatus = explode(',',$request->input('prevstatus'));

    //     $rawStatus = $request->input('paymentStatus');
    //     $getStatus = implode(',', $rawStatus);
    //     $getServices = $request->input('serviceType') ? implode(',', $request->input('serviceType')) : null;

    
    //     $getDatePaid = implode(',', $request->input('datePaid'));

    //     $getAssignedLC = implode (',', $request->input('assignedLC'));
    //     $getNotes = implode(',',$request->input('notes'));

      
    //     $getonlydatepaid = array_filter($request->input('datePaid'));
    //     $setDatePaid = array_values($getonlydatepaid);
    //     $finaldatepaid = '';
      
    //     if(empty($setDatePaid)){
    //         $finaldatepaid = null;
    //     }
    //     else{
    //         $finaldatepaid = min($setDatePaid);
           
    //     }
     
    //     // $sortdatepaid = asort($setDatePaid);
        

    //     $getRawServices = $request->input('servicesraw');
  
    //     $samp = $request->input('serviceType') ? implode(',', $request->input('serviceType')) : null;
        
   
        
    //     //to determine the inquiry scoring
    //     if(in_array(2,$rawStatus)){
    //         $edit->update([
                    
    //             'scoring' => 3,
               
    //         ]);
    //     }
    //     else if(in_array(3,$rawStatus)){
    //         $edit->update([
                    
    //             'scoring' => 3,
               
    //         ]);
    //     }
    //     else if(in_array(4,$rawStatus)){
    //         $edit->update([
                    
    //             'scoring' => 3,
               
    //         ]);
    //     }
    //     else{
    //         if($willUpdateStatus != $fixedStatus){
    //             // dd(explode(',',$willUpdateStatus),$fixedStatus);
    //             if(in_array(2,explode(',',$willUpdateStatus))){
    //                 $edit->update([
                        
    //                     'scoring' => 3,
                    
    //                 ]);
    //             }
    //             else if(in_array(3,explode(',',$willUpdateStatus))){
    //                 $edit->update([
                        
    //                     'scoring' => 3,
                    
    //                 ]);
    //             }
    //             else if(in_array(4,explode(',',$willUpdateStatus))){
    //                 $edit->update([
                        
    //                     'scoring' => 3,
                    
    //                 ]);
    //             }
    //             else{
          
    //                 $edit->update([
                        
    //                     'scoring' => 1,
                    
    //                 ]);
    //             }
    //         }
    //     }
        

    //     if($getDatePaid){
    //         $edit->update([
    //             'datePaid' => $finaldatepaid,
            
    //         ]);
    //     }
    //     else{
       
    //         $edit->update([
    //             'datePaid' => null,
            
    //         ]);
    //     }


    //     if($getStatus == $willUpdateStatus){
    //         $edit->update([
    //             'paymentStatus' => $getStatus,
            
    //         ]);
    //     }
    //     else if($getStatus != $willUpdateStatus){
     
    //         $edit->update([
    //             'paymentStatus' => $willUpdateStatus,
            
    //         ]);
    //     }

    //     if($getServices != $getRawServices){
    //     //reset inquiry

    //         $edit->update([
                    
    //             'scoring' => 1,
               
    //         ]);
            
    //         if($samp){
    //             foreach($x as $y){
    //                 $updatePaymentStatus[] = 1;
    //                 $updateDatePaidStatus[] = '';
    //                 $updateAssignedLC[] = 0;
    //                 $updateNotes[] = '';
    //             }
    
    //             $getUpdatedPayment = implode(',',$updatePaymentStatus);
    //             $getUpdatedDatePaid = implode(',',$updateDatePaidStatus);
    //             $getUpdatedAssignedLC = implode(',',$updateAssignedLC);
    //             $getUpdatedNotes = implode(',',$updateNotes);
                
    //             $edit->update([
    //                 'assignedLC' => $getUpdatedAssignedLC,
    //                 'notes' => $getUpdatedNotes,
    //                 'datePaid' => null,
    //                 'serviceType' => $samp,
    //                 'paymentStatus' => $getUpdatedPayment,
    //                 'modifiedBy' => auth()->user()->firstName .' '. auth()->user()->lastName,
    //                 'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
    //                 'sampDate' => $getUpdatedDatePaid,
    //             ]);
    //         }
    //         else{
            
    //             $formDataInquiry = $request->validate([
    //                 'serviceType' =>  !$request->input('serviceType') ? 'required' : '',
                 
        
    //             ]);
    //         }

    //     }

    //     else if ($getServices == $getRawServices){
        
    //         $edit->update([
      
    //             'assignedLC' => implode(',',$request->input('assignedLC')),
    //             'notes' => implode(',',$request->input('notes')),
    //             'serviceType' => implode(',',$request->input('serviceType')),
    //             'modifiedBy' => auth()->user()->id,
    //             'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
    //             'sampDate' => implode(',',$request->input('datePaid')),
    //         ]);
    //     }
        
    //     try{

    //         $formDataInquiry = $request->validate([
    //             'inquiryLeadSource' => $request->input('inquiryLeadSource') ? 'required' : '',
           
    //             // 'applicantFirstName' => $request->input('applicantFirstName') ? 'required' : '',
    //             // 'applicantLastName' => $request->input('applicantLastName') ? 'required' : '',
    //             'applicantName' =>  $request->input('applicantName') ? 'required' : '',
    //             'fbName' => $request->input('fbName') ? 'required' : '',
    //             'email' => $request->input('email') ?  'required' : '',
    //             'phoneNumber' => $request->input('phoneNumber') ? 'required': '',
    //             'countryReside' => $request->input('countryReside') ? 'required' : '',
    //             'representative' => $request->input('representative') ? 'required' : '',
      
    
    //         ]);
    //         // dd($formDataInquiry);
    //         $edit->update($formDataInquiry);
         
    //         return back()->with('message','Inquiry updated successfully!');
    //     }
    //     catch(Exception $th){
    //         return response()->json(['Something went wrong. Please try again.']);
    //     }
        
       
    // }
    
    public function edit(Request $request, Inquiries $edit){
        $data = DB::table('tbl_inquiries')->where('inquiryID', $edit->inquiryID)->first();
   

        $try = [];
        $getonlydatepaid = array_filter($request->input('datePaid'));
        $getdatepaid = isset($getonlydatepaid) ? $getonlydatepaid : null;
        $setDatePaid = array_values($getdatepaid);
        $finalDatePaid = $setDatePaid ? min($setDatePaid) : null;
        
        //to determine the inquiry scoring
        if(in_array(2,$request->input('paymentStatus'))){
            
            $edit->update([
                    
                'scoring' => 3,
                
            ]);
            $try += $edit->getChanges();
        }
        else if(in_array(3,$request->input('paymentStatus'))){
            $edit->update([
                    
                'scoring' => 3,
                
            ]);
            $try += $edit->getChanges();
        }
        else if(in_array(4,$request->input('paymentStatus'))){
            $edit->update([
                    
                'scoring' => 3,
                
            ]);
            $try += $edit->getChanges();
        }
        else{
            $edit->update([
                    
                'scoring' => $request->input('scoring') ,
                
            ]);
            $try += $edit->getChanges();
        }
        
        if($data->approvedEdit == auth()->user()->id || auth()->user()->userType == 1 || auth()->user()->userType == 3 ){
            $currentServices = $request->input('currentservices');

            $getServices = $request->input('serviceType');
            $implodeServices = implode(',', $request->input('serviceType'));
            if($currentServices != $implodeServices){
                
                  
                // foreach($getServices as $y){
                //     $updatePaymentStatus[] = 1;
                //     $updateRepresentative[] = '';
                //     $updateDatePaidStatus[] = '';
                //     $updateAssignedLC[] = 0;
                //     $updateNotes[] = '';
                // }
                
                // //make it csv
                // $implodePaymentStatus = implode(',',$updatePaymentStatus);
                // $implodeRepresentative = implode(',',$updateRepresentative);
                // $implodeDatePaid = implode(',',$updateDatePaidStatus);
                // $implodeAssignedLC = implode(',',$updateAssignedLC);
                // $implodeNotes = implode(',',$updateNotes);
                
                // // dd($implodePaymentStatus,$implodeDatePaid,$implodeAssignedLC,$implodeNotes);
                
                // $edit->update([
                //     'scoring' => 1,
                //     'assignedLC' => $implodeAssignedLC,
                //     'representative' => $implodeRepresentative,
                //     'notes' => $implodeNotes,
                //     'datePaid' => null,
                //     'serviceType' => $implodeServices,
                //     'paymentStatus' => $implodePaymentStatus,
                //     'inquiryType' => $request->input('inquiryType'),
                //     'modifiedBy' => auth()->user()->firstName .' '. auth()->user()->lastName,
                //     'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
                //     'sampDate' => $implodeDatePaid,
                //     'canEdit' => null,
                //     'approvedEdit' => null,
                // ]);
                
                //IF MAY NIREMOVE NA SERVICE
                if($request->input('recentchecked')){
                    $recentchecked = $request->input('recentchecked');
                    
                    //get the old values
                    $serviceType = $data->serviceType;
                    $paymentStatus = $data->paymentStatus;
                    $sampDate = $data->sampDate;
                    $assignedLC = $data->assignedLC;
                    $notes = $data->notes;
                    $representative = $data->representative;
                    
                    //explode the old values
                    $explodeServices = explode(",",$serviceType);
                    $explodePaymentStatus = explode(",",$paymentStatus);
                    $explodeSampDate = explode(",",$sampDate);
                    $explodeAssignedLC = explode(",",$assignedLC);
                    $explodeNotes = explode(",",$notes);
                    $explodeRepresentative = explode(",",$representative);
                    
                    
                    //get the index
                    $index = array_search($recentchecked,$explodeServices);
                    
                    //remove value
                    array_splice($explodePaymentStatus,$index,1);
                    array_splice($explodeSampDate,$index,1);
                    array_splice($explodeAssignedLC,$index,1);
                    array_splice($explodeNotes,$index,1);
                    array_splice($explodeRepresentative,$index,1);
                    
                    //get the new values
                    $newPaymentStatus = implode(",",$explodePaymentStatus);
                    $newSampDate = implode(",",$explodeSampDate);
                    $newAssignedLC = implode(",",$explodeAssignedLC);
                    $newNotes = implode(",",$explodeNotes);
                    $newRepresentative = implode(",",$explodeRepresentative);
                    
                    $edit->update([
                        'scoring' => $request->input('scoring'),
                        'assignedLC' => $newAssignedLC,
                        'representative' => $newRepresentative,
                        'notes' => $newNotes,
                        'datePaid' => null,
                        'serviceType' => $implodeServices,
                        'paymentStatus' => $newPaymentStatus,
                        'inquiryType' => $request->input('inquiryType'),
                        'modifiedBy' => auth()->user()->firstName .' '. auth()->user()->lastName,
                        'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
                        'sampDate' => $newSampDate,
                        'canEdit' => null,
                        'approvedEdit' => null,
                    ]);
                    $try += $edit->getChanges();
                    
                    // dd($paymentStatus,$sampDate,$assignedLC,$notes,$representative,$explodePaymentStatus,$explodeSampDate,$explodeAssignedLC,$explodeNotes,$explodeRepresentative,$index,$newPaymentStatus,$newSampDate,$newAssignedLC,$newNotes,$newRepresentative);
                }
                //PAG MAY ADD NA NEW SERVICE
                else{
                    $current = explode(",",$request->input('currentservices'));
                    $newlyadded = explode(",",$request->input('newaddedservices'));
                    
                    $getnew = [];

                    foreach ($current as $value) {
                        if (!in_array($value, $newlyadded)) {
                            $getnew[] = $value;
                     
                        }
                    }
                    
                    foreach ($newlyadded as $value) {
                        if (!in_array($value, $current)) {
                            $getnew[] = $value;
                            
                        }
                    }
                    
                    $result = implode(",",$getnew);
                    
                    $index = array_search($result,$newlyadded);
                    
                    
                    //insert to others
                            //get the old values
                    $serviceType = $data->serviceType;
                    $paymentStatus = $data->paymentStatus;
                    $sampDate = $data->sampDate;
                    $assignedLC = $data->assignedLC;
                    $notes = $data->notes;
                    $representative = $data->representative;
                    
                    //explode the old values
                    $explodeServices = explode(",",$serviceType);
                    $explodePaymentStatus = explode(",",$paymentStatus);
                    $explodeSampDate = explode(",",$sampDate);
                    $explodeAssignedLC = explode(",",$assignedLC);
                    $explodeNotes = explode(",",$notes);
                    $explodeRepresentative = explode(",",$representative);
                    
                    
                    array_splice($newlyadded, $index, 0, $result);
                    
                    //remove value
                    array_splice($explodePaymentStatus,$index,0,1);
                    array_splice($explodeSampDate,$index,0,'');
                    array_splice($explodeAssignedLC,$index,0,'');
                    array_splice($explodeNotes,$index,0,'');
                    array_splice($explodeRepresentative,$index,0,'');
                    
                    //get the new values
                    $newPaymentStatus = implode(",",$explodePaymentStatus);
                    $newSampDate = implode(",",$explodeSampDate);
                    $newAssignedLC = implode(",",$explodeAssignedLC);
                    $newNotes = implode(",",$explodeNotes);
                    $newRepresentative = implode(",",$explodeRepresentative);
                    
                    // dd($current,$newlyadded,$result,$index);
                    // dd($newPaymentStatus,$newSampDate,$newAssignedLC,$newNotes,$newRepresentative);
                          $edit->update([
                        'scoring' => $request->input('scoring'),
                        'assignedLC' => $newAssignedLC,
                        'representative' => $newRepresentative,
                        'notes' => $newNotes,
                        'datePaid' => null,
                        'serviceType' => $implodeServices,
                        'paymentStatus' => $newPaymentStatus,
                        'inquiryType' => $request->input('inquiryType'),
                        'modifiedBy' => auth()->user()->firstName .' '. auth()->user()->lastName,
                        'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
                        'sampDate' => $newSampDate,
                        'canEdit' => null,
                        'approvedEdit' => null,
                    ]);
                    $try += $edit->getChanges();
                }
                
                
                
            }
            else if($currentServices == $implodeServices){
                 $edit->update([
                    'assignedLC' =>  implode(',',$request->input('assignedLC')),
                    'representative' => implode(',',$request->input('representative')),
                    'notes' =>  implode(',',$request->input('notes')),
                    // 'datePaid' =>  min($setDatePaid),
                    'datePaid' => $finalDatePaid,
                    'serviceType' => $currentServices,
                    'inquiryType' => $request->input('inquiryType'),
                    'paymentStatus' => implode(',',$request->input('paymentStatus')),
                    'modifiedBy' => auth()->user()->id,
                    'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
                    'sampDate' => implode(',',$request->input('datePaid')),
                    'canEdit' => null,
                    'approvedEdit' => null,
                ]);
                $try += $edit->getChanges();
            }
        }
        else if(!$data->approvedEdit){
            // dd('walang approved edit');
             $edit->update([
                    'assignedLC' =>  implode(',',$request->input('assignedLC')),
                    'representative' => implode(',',$request->input('representative')),
                    'notes' =>  implode(',',$request->input('notes')),
                    // 'datePaid' =>  min($setDatePaid),
                    'datePaid' => $finalDatePaid,
                    // 'serviceType' => $currentServices,
                    'paymentStatus' => implode(',',$request->input('paymentStatus')),
                    'modifiedBy' => auth()->user()->id,
                    'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
                    'sampDate' => implode(',',$request->input('datePaid')),
                 
                ]);
            $try += $edit->getChanges();
        }
      

       
        
        // dd($edit->getChanges());
        
        // dd($edit->fill($request->input())->save());
     
        
        $formDataInquiry = $request->validate([
            'inquiryLeadSource' => $request->input('inquiryLeadSource') ? 'required' : '',
            'applicantName' =>  $request->input('applicantName') ? 'required' : '',
            'fbName' => $request->input('fbName') ? 'required' : '',
            'email' => $request->input('email') ?  'required' : '',
            'phoneNumber' => $request->input('phoneNumber') ? 'required': '',
            'countryReside' => $request->input('countryReside') ? 'required' : '',
            // 'representative' => $request->input('representative') ? 'required' : '',
            // 'serviceType' => $request->input('serviceType') ? 'required' : '',
            

        ]);

        $edit->update($formDataInquiry);  

     
        $try += $edit->getChanges();
        // dd($try);
        foreach ($try as $key => $value) {
            if ($key == 'inquiryLeadSource') {
                $inquiryLeadSource = DB::table('tbl_leadsource')->where('leadsourceID', $value)->first();
                $try[$key] = $inquiryLeadSource->leadSourceName;
                     
             
            }
            
            if ($key == 'inquiryType') {
                $inquiryType = DB::table('tbl_inquirytype')->where('itID', $value)->first();
                $try[$key] = $inquiryType->itName;
                     
             
            }
            
            if ($key == 'serviceType') {
                $x = explode(",",$try[$key]);
                $services = DB::table('tbl_services')
                ->whereIn('serviceID', $x)
                ->pluck('serviceName')
                ->implode(',');
                $try[$key] = $services;
                     
             
            }
            
            if ($key == 'paymentStatus') {
                $paymentStatus = DB::table('tbl_status')->where('statusID', $value)->first();
                $try[$key] = $paymentStatus->statusName;
                     
             
            }
            
            if ($key == 'scoring') {
                $scoring = DB::table('tbl_scoring')->where('scoringID', $value)->first();
                $try[$key] = $scoring->scoringName;
                     
             
            }
            
            if ($key == 'assignedLC') {
                $x = explode(",",$try[$key]);
                $assignedLC = DB::table('tbl_accounts')->where('id', $value)->first();
                $reps = DB::table('tbl_accounts')
                ->whereIn('id', $x)
                ->pluck('firstName')
                ->implode(',');
                // dd($try[$key]);
                if($try[$key] !== ""){
                    if($assignedLC){
                        
                        $try[$key] = $reps;
                    }
                    
                }
                     
             
            }
            
            if ($key == 'representative') {
                $x = explode(",",$try[$key]);
                // $representative = DB::table('tbl_accounts')->where('id', $value)->first();
                $reps = DB::table('tbl_accounts')
                ->whereIn('id', $x)
                ->pluck('firstName')
                ->implode(',');
                // dd($representative,$try[$key]);
                
                if($try[$key] !== ""){
                    
                    if($reps){
                        
                        $try[$key] = $reps;
                    }
                }
                     
             
            }
            
                  
        }
      

        // dd($try,$enc,$dec);
        // $history = new UpdateHistory();
        // $history->accountID = auth()->user()->id;
        // $history->title = 'Inquiry Updated';
        // $history->description = $try;
        // $history->inquiryID = $edit->inquiryID;
        // $history-> createdBy = auth()->user()->id;
        // $history->dateCreated = Carbon::now()->timezone('Asia/Kuala_Lumpur');
        //  $history->save();
        
        UpdateHistoryModel::create([
            'accountID' => auth()->user()->id,
            'title' => 'Inquiry Updated',
            'description' => json_encode(collect($try)->except(['modifiedBy', 'dateModified'])),
            'inquiryID' => $edit->inquiryID,
            'createdBy' => auth()->user()->id,
            'dateCreated' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
            ]);
      


        return back()->with('message','Inquiry updated successfully!');
    }

    public function deleteInquiry(Inquiries $inqID){
      
        $find = Inquiries::find($inqID->inquiryID);
        $find->delete();
        // $find->update([
        //     'isActive' => '0',
        //     'modifiedBy' => auth()->user()->id,
        //     'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur')
        // ]);
  

        return redirect('/viewinquiries')->with('message', 'Inquiry deleted successfully.');

    }

      //reactivate employee
      public function reactivateInquiry(Inquiries $inqID){
      
        $find = Inquiries::find($inqID->inquiryID);
     
        $find->update([
            'isActive' => '1',
            'modifiedBy' => auth()->user()->id,
            'dateModified' => Carbon::now()->timezone('Asia/Kuala_Lumpur')
        ]);
   
        return redirect('/viewinquiries')->with('message', 'Inquiry Reactivated.');

    }
    
    
    //request for edit inquiry
     public function requestEditInquiry(Request $request, Inquiries $edit){

       
            $edit->update([
                    
                'canEdit' => $request->input('requestedit'),
                
            ]);
       

        // $formDataInquiry = $request->validate([
        //     'inquiryLeadSource' => $request->input('inquiryLeadSource') ? 'required' : '',
        //     'applicantName' =>  $request->input('applicantName') ? 'required' : '',
        //     'fbName' => $request->input('fbName') ? 'required' : '',
        //     'email' => $request->input('email') ?  'required' : '',
        //     'phoneNumber' => $request->input('phoneNumber') ? 'required': '',
        //     'countryReside' => $request->input('countryReside') ? 'required' : '',
        //     // 'representative' => $request->input('representative') ? 'required' : '',
        //     // 'serviceType' => $request->input('serviceType') ? 'required' : '',

        // ]);

        // $edit->update($formDataInquiry);  

       


        return back()->with('message','Please wait for the admin to accept your request!');
    }
    
    //accept request edit inquiry
     public function acceptLcRequest(Request $request, Inquiries $lcID){
    
            $lcID->update([
                'canEdit' => null,
               'approvedEdit' => $request->input('acceptrequestedit')
            ]);


        return back()->with('message','LC Request accepted.');
    }

}
