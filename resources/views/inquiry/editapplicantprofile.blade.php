
@props(['addinquiry'])

<x-layouts>
<div class="bg-bgMain w-full p-7 h-full lg:h-screen text-sm ">
    
    <?php if(auth()->user()->userType == 3 || auth()->user()->userType == 1 || auth()->user()->userType == 2):?>
        
        
        

    
        <div class="flex flex-row justify-between items-center">
            <div>
                <h1 class="text-4xl px-4 py-2">Edit Applicant's Profile</h1>
                <form method="POST" action="/viewinquiries/{{$edit->inquiryID}}/request" style="{{ auth()->user()->userType == 1 || auth()->user()->userType == 3  ? 'display:none;' : ''}}">
                    @csrf
                    @method("PUT")
                    <input name="requestedit" type="hidden" value="{{auth()->user()->id}}">
                    @if($edit->canEdit == auth()->user()->id)
                    <button class="px-6
                            mb-2
                            py-3
                            bg-yellow-700
                            text-white
                            font-medium
                            text-sm
                            leading-tight
                            uppercase
                            shadow-md
                            hover:bg-amber-600 hover:shadow-lg
                            focus:bg-amber-600 focus:shadow-lg focus:outline-none focus:ring-0
                            active:bg-amber-600 active:shadow-lg
                            transition-all
                            duration-350
                            ease-in-out" disabled>Waiting to accept your Edit Request.</button>
                    @elseif($edit->approvedEdit == auth()->user()->id)
                    <button class="px-6
                            mb-2
                            py-3
                            bg-green-600
                            text-white
                            font-medium
                            text-sm
                            leading-tight
                            uppercase
                            shadow-md
                            hover:bg-green-700 hover:shadow-lg
                            focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0
                            active:bg-green-600 active:shadow-lg
                            transition-all
                            duration-350
                            ease-in-out" disabled>Request Approved!</button>
                    @else
                    <button class="px-6
                            mb-2
                            py-3
                            bg-yellow-600
                            text-white
                            font-medium
                            text-sm
                            leading-tight
                            uppercase
                            shadow-md
                            hover:bg-amber-600 hover:shadow-lg
                            focus:bg-amber-600 focus:shadow-lg focus:outline-none focus:ring-0
                            active:bg-amber-600 active:shadow-lg
                            transition-all
                            duration-350
                            ease-in-out">Request for edit</button>
                    @endif
                </form>
            </div>
            <form method="POST" action="/viewinquiries/{{$edit->inquiryID}}" >
            @csrf
            @method("PUT")
            <div class="flex flex-row justify-center items-center">
        
                <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4  whitespace-nowrap font-bold lg:w-[45%]">Scoring: </p>
                        @if($scoring == "Signed Up")
                        <p class=" p-1 px-2 inline-block text-center rounded-full text-white text-xs bg-green-600">{{$scoring}}</p>
                        <select name="scoring" id="scoring" class="hidden border px-4 py-2 w-full border-gray-600">
                            @foreach ($listscoring as $list)
                          
                            <option <?php if($list->scoringID == $edit->scoring) echo 'selected="selected"'; ?> id="scoring" value="{{$list->scoringID}}">{{$list->scoringName}}</option>
                            @endforeach
                        </select> 
                        @else
                        <select name="scoring" id="scoring" class="border px-4 py-2 w-full border-gray-600">
                            @foreach ($listscoring as $list)
                          
                            <option <?php if($list->scoringID == $edit->scoring) echo 'selected="selected"'; ?> id="scoring" value="{{$list->scoringID}}">{{$list->scoringName}}</option>
                            @endforeach
                        </select> 
                        @endif
        
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-2   bg-[#fff] shadow-lg shadow-gray-600">
            <div class="">
            
                <div class=" w-full  p-6 bg-[#fff]  shadow-gray-600">
                    <div class="flex flex-row justify-between items-center py-4">
                        <p class="lg:px-4 pr-2 whitespace-nowrap font-bold lg:w-[36%]">Lead Source</p>
                        <select name="inquiryLeadSource" id="inquiryLeadSource" class="px-2 pr-8 py-[2px]" {{auth()->user()->id === $edit->approvedEdit || auth()->user()->userType == 1 || auth()->user()->userType == 3 ? '' : 'disabled' }}>
                            @foreach ($leadsource as $list)
                                <option <?php if($list->leadsourceID == $edit->inquiryLeadSource) echo 'selected="selected"'; ?> value="{{$list->leadsourceID}}">{{$list->leadSourceName}}</option>
                            @endforeach
                    
                        </select>
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">Inquiry</p>
                        <select name="inquiryType" id="inquiryType" class="px-2 pr-8 py-[2px]" {{auth()->user()->id === $edit->approvedEdit || auth()->user()->userType == 1 || auth()->user()->userType == 3 ? '' : 'disabled' }}  >
                           <option value="">Select</option>
                            @foreach ($inquiryType as $list)

                                <option <?php if($list->itID == $edit->inquiryType) echo 'selected="selected"'; ?> value="{{$list->itID}}">{{$list->itName}}</option>
                            @endforeach
                    
                        </select>
                    </div>
                    
            
                    {{-- <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">First Name</p>
                        <input type="text" name="applicantFirstName" value="{{$edit->applicantFirstName}}" placeholder="First name" class="px-4 py-2 border border-gray-600 w-full">
        
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">Last Name</p>
                        <input type="text" name="applicantLastName" value="{{$edit->applicantLastName}}" placeholder="Last name" class="px-4 py-2 border border-gray-600 w-full">
                    </div> --}}

                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">Full Name</p>
                        <input type="text" name="applicantName" value="{{$edit->applicantName}}" placeholder="Full name" class="px-4 py-2 border border-gray-600 w-full">
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">Facebook </p>
                        <input type="text" name="fbName" value="{{$edit->fbName}}"placeholder="Facebook name" class="px-4 py-2 border border-gray-600 w-full">
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">Email Address</p>
                        <input type="text" name="email" value="{{$edit->email}}"placeholder="Email address" class="px-4 py-2 border border-gray-600 w-full">
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">Phone Number</p>
                        <input type="text" name="phoneNumber" value="{{$edit->phoneNumber}}"placeholder="Phone number" class="px-4 py-2 border border-gray-600 w-full">
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">Country Reside</p>
                        <select  id="countryReside" name="countryReside" class="border px-4 py-2 w-full border-gray-600">
                            <option value="" {{$list == $edit->countryReside ? 'selected="selected"' : ''}}>Select</option>
                            @foreach ($countries as $list)
                            <option value="{{$list}}" {{$list == $edit->countryReside ? 'selected="selected"' : ''}}>{{$list}}</option>
                                
                            @endforeach
                        </select>
                   </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  whitespace-nowrap font-bold lg:w-[45%]">Services</p>
                        <div class="border px-4 py-2 w-full h-[150px] overflow-auto border-gray-600 grid-container grid grid-cols-4">
                   
                            @foreach ($services as $list)
                       
                         
                            
                                        <input type="checkbox" id="myServiceType"  name="serviceType[]" value="{{$list->serviceID}}" {{in_array($list->serviceID, $serviceType) ? "checked" : ''}} {{auth()->user()->id === $edit->approvedEdit || auth()->user()->userType == 1 || auth()->user()->userType == 3 ? '' : 'disabled' }} >
                                      
                                    <label for="{{$list->serviceID}}" class=" col-span-3" >{{$list->serviceName}}</label>
                              
                                    
                            @endforeach
                         
                        </div>
                 
                 
                    </div>
                    @error('serviceType')
                    <p class="text-red-600 text-xs whitespace-nowrap text-center">{{$message}}</p>
                    @enderror
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  whitespace-nowrap font-bold lg:w-[45%]">Created By</p>
                        <select name="representative" disabled id="representative" class="border px-4 py-2 w-full border-gray-600">
                          
                            @foreach ($representatives as $list)
                            <option <?php if($list->id == $edit->createdBy) echo 'selected="selected"'; ?> value="{{$list->id}}">{{$list->firstName .' '. $list->lastName}}</option>
                                
                            @endforeach
                        
                        </select>
                    
                        {{-- <p class="px-4 py-2 w-full">{{auth()->user()->firstName .' '. auth()->user()->lastName}}</p> --}}
                    </div>  
                    
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">Date Created</p>
                       
                        <input type="text" name="datecreated" value="{{ \Carbon\Carbon::parse( $edit->dateCreated)->isoFormat('MMMM DD YYYY, h:mm a')}}" disabled class="px-4 py-2 border border-gray-600 w-full">
                    </div> 
                    
                </div>
            </div>
            <div class="">
                <div class="w-full pt-6 px-6  ">
                
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px] lg:h-[450px] overflow-auto">
                        <p class="lg:px-2.5  whitespace-nowrap font-bold lg:w-[45%]">Status</p>
                        <div class="w-full h-full lg:p-4">
                            @foreach ($getServiceAndPaymentAndLCAndNotes as $itemKey => $list)
                                
                                <p class="accordion w-full flex justify-between transition-all duration-300">{{$list->servicename}}<i class="bi bi-caret-down-fill -rotate-90 transition-all duration-150"></i></p>
                                <div class="panel bg-gray-200 transition-all duration-300">
                                            <select  id="source" name="paymentStatus[]" class="border p-2 w-full border-gray-600">
                                                
                                                @foreach ($status as $statusKey => $item)
                                                    <option name="paymentStatus[]" value="{{$item->statusID}}" {{$paymentStatus[$itemKey] === $statusKey+1 ? 'selected' : ''}} >{{$item->statusName }}</option>
                                                @endforeach
                                            </select>
                                            <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-2">
                                                <p class="whitespace-nowrap font-bold lg:w-[45%]">Date Paid</p>
                                                
                                            
                                                <input type="datetime-local" name="datePaid[]" value="{{$list->sdate}}" placeholder="Date paid" class="px-2 py-2 border border-gray-600 w-full">
                                                
                                            </div>
                                            <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                                                <p class="whitespace-nowrap font-bold lg:w-[45%]">Assigned LC</p>
                                                <select name="assignedLC[]" id="assignedLC" class="border px-4 py-2 w-full border-gray-600">
                                                    
                                                    <option value="" selected>Select</option>
                                                    @foreach ($lc as $lcKey => $listz)
                            
                                                    <option  value="{{$listz->id}}" {{$assignedLC[$itemKey] === $lcKey+11 ? 'selected' : ''}}>{{$listz->firstName . ' ' . $listz->lastName}}</option>
                                                    
                                                    @endforeach
                                                
                                                </select>
                                            </div>
                                            <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                                                <p class="whitespace-nowrap font-bold lg:w-[45%]">Notes</p>
                                                <textarea name="notes[]" id="" cols="25" rows="8" class="h-full px-4 py-2 border border-gray-600 w-full">{{$list->notes}}</textarea>
                                            </div>
                                            <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                                                <p class="whitespace-nowrap font-bold lg:w-[45%] pr-2">Sales Representative</p>
                                                
                                                <select name="representative[]"  id="representative" class="border px-4 py-2 w-full border-gray-600">
                                                    <option value="" selected >Select</option>
                                                    @foreach ($representatives as $repKey => $list)
                                                        <option value="{{$list->id}}" {{$rep[$itemKey] === $repKey+$notrep ? 'selected' : ''}} >{{$list->firstName .' '. $list->lastName}}</option>
                                                        
                                                    @endforeach
                                                
                                                </select>
                                            </div>
                                </div>
                                
                            @endforeach
                        </div>
       
                            <!-- <div class="accordion w-full  h-full " id="accordionExample">
                                
                                @foreach ($getServiceAndPaymentAndLCAndNotes as $itemKey => $list)
                                    @php
                                        $var = $itemKey;
                                        $var = $var+1;
                                    @endphp
                                {{$var}}
                                
                                <div id="accordion-collapse" data-accordion="collapse">
                                    <h2 id="accordion-collapse-heading-1">
                                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left border border-b-0" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                                        <span>{{$list->servicename}}</span>
                                        <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </h2>
                                    <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                                        <div class="p-5 border border-b-0 ">
                                            <select  id="source" name="paymentStatus[]" class="border p-2 w-full border-gray-600">
                                                
                                                @foreach ($status as $statusKey => $item)
                                                    <option name="paymentStatus[]" value="{{$item->statusID}}" {{$paymentStatus[$itemKey] === $statusKey+1 ? 'selected' : ''}} >{{$item->statusName }}</option>
                                                @endforeach
                                            </select>
                                            <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-2">
                                                <p class="whitespace-nowrap font-bold lg:w-[45%]">Date Paid</p>
                                                
                                            
                                                <input type="datetime-local" name="datePaid[]" value="{{$list->sdate}}" placeholder="Date paid" class="px-2 py-2 border border-gray-600 w-full">
                                                
                                            </div>
                                            <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                                                <p class="whitespace-nowrap font-bold lg:w-[45%]">Assigned LC</p>
                                                <select name="assignedLC[]" id="assignedLC" class="border px-4 py-2 w-full border-gray-600">
                                                    
                                                    <option value="" selected>Select</option>
                                                    @foreach ($lc as $lcKey => $listz)
                            
                                                    <option  value="{{$listz->id}}" {{$assignedLC[$itemKey] === $lcKey+2 ? 'selected' : ''}}>{{$listz->firstName . ' ' . $listz->lastName}}</option>
                                                    
                                                    @endforeach
                                                
                                                </select>
                                            </div>
                                            <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                                                <p class="whitespace-nowrap font-bold lg:w-[45%]">Notes</p>
                                                <textarea name="notes[]" id="" cols="25" rows="8" class="h-full px-4 py-2 border border-gray-600 w-full">{{$list->notes}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                
                                
                                </div>

                                    <button
                                        class="font-medium leading-tight group relative flex w-full items-center border-0 bg-white py-4 px-5 text-base text-neutral-800 transition "
                                        type="button"
                                        data-te-collapse-init
                                        data-bs-toggle="collapse" 
                                        data-te-target="#collapseOne"
                                        aria-expanded="false"
                                        aria-controls="collapseOne">
                                        {{$list->servicename}}
                                        <span
                                        class="ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-yellow-600 transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="h-6 w-6">
                                            <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                        </span>
                                    </button>
                                    








                                  
                                @endforeach
                            </div> -->
                            
                    </div>
                    

                   <!-- <input id="destination" type="hidden" name="destination" value="{{$destination}}">-->
                   <!--<br>-->
                    <input id="currentservices" type="hidden" name="currentservices" value="{{$servicesraw}}">
                    <input type="hidden" id="myInput" name="newaddedservices">
                    
                    <input type="hidden" id="recentChecked" name="recentchecked" >
                    <!--<input id="prevstatus" type="hidden" name="prevstatus" value="{{$destination}}" >-->
                    <!--<input type="datetime-local"  name="setdatepaid" value="{{$edit->datePaid}}" placeholder="Date paid" class="px-2 py-2 border border-gray-600 w-full hidden">-->
                                                 
                </div>

            
                <div class="flex justify-end items-center p-4 px-6 w-full ">
                    <button type="submit" onclick="return confirm('Are you sure you want to update some changes in this inquiry?')" 
                    class="
                    px-6
                    py-3
                    bg-yellow-600
                    text-white
                    font-medium
                    text-sm
                    leading-tight
                    uppercase
                    shadow-md
                    hover:bg-amber-600 hover:shadow-lg
                    focus:bg-amber-600 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-amber-600 active:shadow-lg
                    transition-all
                    duration-350
                    ease-in-out
                    ">
                        Update
                    </button>
                </div>

            </div>
        </div>
    </form>
    
    <div class="flex gap-2 pt-4 ">
    
        
        <div class="" style="{{auth()->user()->userType == 1 ? '' : 'display:none;'}} " >
            <h1 class="text-4xl px-4 py-4">Update History</h1>
                
                <div class="bg-[#fff] max-h-[50%]  overflow-y-auto w-full  shadow-lg shadow-gray-600 py-0">
                     <table class="table-auto   text-left text-xs w-full  max-w-[50%] lg:max-w-[100%] bg-white  py-4">
            
              <thead class="border-b bg-white shadow-sm sticky top-0">
                <tr>
                  <th class="px-4 py-2">#</th>
                  <th class="px-4 py-2">Title</th>
                  <th class="px-4 py-2">Changes</th>
                  <th class="px-4 py-2">Updated By</th>
                  <th class="px-4 py-2">Date</th>
                </tr>
              </thead>
              <tbody class="">
                  @php
                    $count = 1;
                  @endphp
                @if (count($history) > 0)
                  @foreach ($history as $list)
                    @php 
                        $dec = json_decode($list->description)
                    @endphp
                    <tr class="border-b-2 py-2">
                    
                      <td class="px-4 py-2">{{$count}}</td>
                      <td class="px-4 py-2">{{$list->title}}</td>
                      <td class="px-4 py-2 ">
                          @foreach($dec as $key => $value)
                          <div class="">
                              
                            <span class="font-bold">{{$key }}: </span><span class="inline">{{$value}}</span>
                          </div>
                          @endforeach
                      </td>
                      <td class="px-4 py-2">{{$list->firstName}} {{$list->lastName}}</td>
                      <td class="px-4 py-2">{{$list->dateCreated}}</td>
                    </tr>
                    @php
                        $count++;
                    @endphp
                  @endforeach
                @else
                    <tr class="border-b-2 py-2">
                        <td class="px-4 py-2 text-center" colspan="6">No Record</td>    
                    </tr>
                @endif
                
                
              </tbody>
          </table>
                 
                </div>
          
        </div>
        
        
        <div class="" style="{{auth()->user()->userType == 1 ? '' : 'display:none;'}}">
            <h1 class="text-4xl px-4 py-4">LC Request</h1>
            <form method="POST" action="/viewinquiries/{{$edit->inquiryID}}/accept">
                @csrf
                @method("PUT")
              
                
                @foreach($requestEdit as $item)
                <p>{{$item->firstName}} {{$item->lastName}}</p>
                <input name="acceptrequestedit" type="hidden" value="{{$item->canEdit}}">
                <button class="px-6
                        mb-2
                        py-3
                        bg-yellow-600
                        text-white
                        font-medium
                        text-sm
                        leading-tight
                        uppercase
                        shadow-md
                        hover:bg-amber-600 hover:shadow-lg
                        focus:bg-amber-600 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-amber-600 active:shadow-lg
                        transition-all
                        duration-350
                        ease-in-out">Accept</button>
                @endforeach
            </form>
        </div>
    </div>
    {{-- <div class="bg-white m-4 p-4">
        @foreach ($socmed as $itemKey => $item)
            <p class="font-bold">{{$item}}</p>

            <select name="status" id="status" class=" px-4 mx-4">
                @foreach ($statuslist as $key => $list)
                   <option value={{$key}} {{$selectedstatus[$itemKey] === $key ? 'selected' : ''}}>
                        {{$list}}
                    </option>
                @endforeach
            </select>
       
        @endforeach
    </div> --}}
    <?php else: ?>
        <p class="text-center flex items-center justify-center h-full">you don't have access in this page.</p>
    <?php endif; ?>
</div>

</x-layouts>

<script>
  const checkboxes = document.querySelectorAll('input[type=checkbox]');
  const currentservices = document.getElementById('currentservices');
  const newaddedservice = document.getElementById('myInput');
  const recent = document.getElementById('recentChecked');
    
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', (event) => {
      const values = [];
      checkboxes.forEach((checkbox) => {
        if (checkbox.checked) {
          values.push(checkbox.value);
        }
      });
      newaddedservice.value = values.join(',');
    });
  });
  
    //get unchecked value
   $("input:checkbox").change(function() {
       var ischecked = $(this).is(':checked');
       if (!ischecked){
           
         recent.value =  $(this).val()
       }
       else{
           recent.value = '';
       }
     });
     
 const accordion = document.querySelector('.accordion');
    accordion.addEventListener('click', () => {
      const caretDownIcon = accordion.querySelector('.bi-caret-down-fill');
      caretDownIcon.classList.toggle('-rotate-0');
    });
     
 

</script>
