<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Inquiries;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
  
        return new Inquiries([
            'inquiryLeadSource' => $row['inquiryleadsource'],
            'applicantName' => $row['applicantname'], 
            'fbName' => $row['fbname'], 
            'email' => $row['email'], 
            'phoneNumber' => $row['phonenumber'], 
            'countryReside' => $row['countryreside'], 
            'inquiryType' => $row['inquirytype'], 
            'serviceType' => $row['servicetype'], 
            'paymentStatus' => $row['paymentstatus'],
            'datePaid' => $row['datepaid'],
            'scoring' => $row['scoring'], 
            'assignedLC' => $row['assignedlc'],
            'notes' => $row['notes'],
            'representative' => $row['representative'],
            'createdBy' => $row['createdby'],
            // 'dateCreated' => \Carbon\Carbon::parse($row['datecreated'])->toDateTimeString(),
            'dateCreated' => $row['datecreated'],
            'sampDate' => $row['sampdate'],
            'isActive' => 1,
        ]);


  
    }
    // public function rules(): array{
      
    //     return[
    //         'inquiryleadsource' => 'required',
    //         'applicantname' => 'required', 
    //         'fbname' => 'unique:tbl_inquiries,fbName', 
    //         'email' => 'unique:tbl_inquiries,email', 
    //         'servicetype' => 'required', 
    //         'paymentstatus' => 'required',
    //         'scoring' => 'required', 
    //         'representatives' => 'required', 
         
    //     ];
    // }
}
