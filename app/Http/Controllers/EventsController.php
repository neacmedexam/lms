<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\EventsModel;
use App\Models\EventsRecordsModel;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    //
    public function showAddEvents(){
        return view('events.addevents');
    }
    
    
    public function addEvents(Request $request){
        // $forms = $request->validated();
        
        $formData = $request->validate([
            
                'eventname' => 'required',
        
            ]);
        $formData = [
            'eventname' => $request->input('eventname'),
            'isActive' => '1',
            'createdBy' => auth()->user()->id,
            'dateCreated' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
    
        ];
        
        // dd($formData);
            
        EventsModel::create($formData);
        
        return redirect('/events/viewevents')->with('success', 'New Event Added.');   
        
    }
    
    public function viewEvents(){
        if(auth()->user()->userType == 4){
            $events = EventsModel::where('isActive','=','1')
            ->orderBy('eventID','desc')
            ->paginate(5);
        }
        else{
            $events = EventsModel::orderBy('eventID','desc')
            ->paginate(5);
        }
   
        // dd($events);
        
        return view('events.viewevents',[
                'events' => $events
                
               
    
        ]);
    }
    
    
    public function showEditEvent(Request $request, $id){
        $events = EventsModel::where('isActive','=','1')
        ->where('eventID','=', $id)
        ->first();
        // dd($events);
        
        return view('events.editevent',[
                'events' => $events
                
               
    
        ]);
    }
    
    public function editEvent(Request $request, $id){
        $edit = EventsModel::find($id);
        
        $edit->eventName = $request->input('eventname');
        $edit->save();
        
        return redirect('/events/viewevents')->with('success', 'Event Updated');   
    }
    
    public function deleteEvent(Request $request, $id){
        $edit = EventsModel::find($id);
        $edit->isActive = 0;
        $edit->save();
        
        return redirect('/events/viewevents')->with('success', 'Event deleted');   
    }
    
    public function reactivateEvent(Request $request, $id){
        $edit = EventsModel::find($id);
        $edit->isActive = 1;
        $edit->save();
        
        return redirect('/events/viewevents')->with('success', 'Event reactivated.');   
    }
    
    public function showAddParticipants($id){
    
        
            $event = EventsModel::where('eventID', $id)->first();
        
          return view('events.records.addrecord',[
                'events' => $event
                
               
    
        ]);
        
    }
    
    public function addParticipants(Request $request){
        $formData = $request->validate([
            
            'fullName' => 'required',
            'email' => 'required',
            'contactNumber' => 'required',
            'statecountry' => 'required',
        
            ]);
        $formData = [
            'fullName' => $request->input('fullName'),
            'email' => $request->input('email'),
            'contactNumber' => $request->input('contactNumber'),
            'statecountry' => $request->input('statecountry'),
            'eventID' => $request->input('events'),
            'status' => 'Inquiry',
            'createdBy' => auth()->user()->id,
            'isActive' => '1',
            'dateCreated' => Carbon::now()->timezone('Asia/Kuala_Lumpur'),
    
        ];
        
        // dd($formData);
            
        EventsRecordsModel::create($formData);
        
          
        return redirect()->back()->with('success', 'New Participant Added.'); 
    }
    
    public function showEditParticipants( $id){
        $events = EventsRecordsModel::where('isActive','=','1')
        ->where('eventRecordID','=', $id)
        ->first();
        // dd($events);
        
        return view('events.records.editrecord',[
                'events' => $events
                
               
    
        ]);
    }
    
       
    public function editParticipant(Request $request, $id){
        $edit = EventsRecordsModel::find($id);
        
        $edit->fullName = $request->input('fullName');
        $edit->email = $request->input('email');
        $edit->contactNumber = $request->input('contactNumber');
        $edit->statecountry = $request->input('statecountry');
        $edit->fb = $request->input('fb');
        $edit->status = $request->input('status');
        // dd($edit);
        $edit->save();
        
        return redirect()->back()->with('success', 'Participant Updated');   
    }
    
         
    public function deleteParticipant(Request $request, $id){
        $edit = EventsRecordsModel::find($id);
        
        $edit->isActive = 0;
        // dd($edit);
        $edit->save();
        
        return redirect()->back()->with('success', 'Participant Deleted');   
    }
    
    
     public function reactivateParticipant(Request $request, $id){
        $edit = EventsRecordsModel::find($id);
        
        $edit->isActive = 1;
        // dd($edit);
        $edit->save();
        
        return redirect()->back()->with('success', 'Participant Reactivated');   
    }
    
    public function viewEventsRecords($id){
        if(auth()->user()->userType == 4){
          
            $records = EventsRecordsModel::join('tbl_events','tbl_eventsrecords.eventID','=','tbl_events.eventID')
        ->select('tbl_eventsrecords.isActive as activitystatus','tbl_eventsrecords.eventRecordID','tbl_eventsrecords.fullName','tbl_eventsrecords.fb','tbl_eventsrecords.email','tbl_eventsrecords.contactNumber','tbl_eventsrecords.statecountry','tbl_eventsrecords.status','tbl_eventsrecords.isActive','tbl_eventsrecords.createdBy','tbl_eventsrecords.dateCreated')
        ->where('tbl_eventsrecords.isActive','=','1')
        ->where('tbl_eventsrecords.eventID','=', $id)
        ->paginate(20);
        }
        else{
            $records = EventsRecordsModel::join('tbl_events','tbl_eventsrecords.eventID','=','tbl_events.eventID')
        ->select('tbl_eventsrecords.isActive as activitystatus','tbl_eventsrecords.eventRecordID','tbl_eventsrecords.fullName','tbl_eventsrecords.fb','tbl_eventsrecords.email','tbl_eventsrecords.contactNumber','tbl_eventsrecords.statecountry','tbl_eventsrecords.status','tbl_eventsrecords.isActive','tbl_eventsrecords.createdBy','tbl_eventsrecords.dateCreated')
        ->where('tbl_eventsrecords.eventID','=', $id)
        ->paginate(20);

        }
    
        // $try = EventsRecordsModel::join('tbl_events','tbl_eventsrecords.eventID','=','tbl_events.eventID')
        // ->select('tbl_eventsrecords.isActive as activitystatus','tbl_eventsrecords.eventRecordID','tbl_eventsrecords.fullName','tbl_eventsrecords.fb','tbl_eventsrecords.email','tbl_eventsrecords.contactNumber','tbl_eventsrecords.statecountry','tbl_eventsrecords.status','tbl_eventsrecords.isActive','tbl_eventsrecords.createdBy','tbl_eventsrecords.dateCreated')
        // ->where('tbl_eventsrecords.eventID','=', $id)
        // ->get();
        
        
        // dd($try);
        $event = EventsModel::where('eventID','=',$id)->first();
        return view('events.records.viewrecord',[
               'id' => $id,
                'records' => $records,
                'event' => $event,
                
               
    
        ]);
    }
    
    
}
