<?php

namespace App\Exports;

use App\Models\Inquiries;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Inquiries::select("tbl_inquiries.dateCreated",
        "tbl_leadsource.leadSourceName", 
        "tbl_inquiries.applicantName", 
        "tbl_inquiries.fbName", 
        "tbl_inquiries.email", 
        "tbl_inquiries.phoneNumber", 
        "tbl_inquiries.countryReside", 
        DB::raw("GROUP_CONCAT(tbl_services.serviceName)"),
        "tbl_inquiries.notes", 
        "tbl_inquiries.assignedLC", 
        "tbl_scoring.scoringName", 
        DB::raw("CONCAT(tbl_accounts.firstName,' ',tbl_accounts.lastName)"), 
        DB::raw("CONCAT(tbl_accounts.firstName,' ',tbl_accounts.lastName) as 'Created By'"),
        )
        ->join('tbl_services', function($join){
            $join->on(DB::raw("CONCAT(',', tbl_inquiries.serviceType, ',')"), 'LIKE', DB::raw("concat('%,', tbl_services.serviceID, ',%')"));
        })
        ->join('tbl_accounts', 'tbl_accounts.id', '=', 'tbl_inquiries.representative')
        ->join('tbl_scoring','tbl_scoring.scoringID','=','tbl_inquiries.scoring')
        ->join('tbl_leadsource', 'tbl_leadsource.leadsourceID', '=', 'tbl_inquiries.inquiryLeadSource')
        ->groupBy('tbl_inquiries.inquiryID')
        ->orderBy('tbl_inquiries.inquiryID')
        ->get();
    }

    public function headings(): array
    {
        return ["Date Created","Lead Source", "Applicant Name", "Facebook", "Email", "Phone Number", "Country", "Service", "Notes", "Scoring", "Assigned LC", "Sales Representative", "Created By"];
    }
}
