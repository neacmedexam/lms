
@props(['addinquiry'])

<x-layouts>
<div class="bg-bgMain w-full p-7 h-full lg:h-screen text-sm ">

    
    
        <div class="flex flex-row justify-between items-center">
            <h1 class="text-4xl p-4 {{$edit->applicantName && !$edit->fbName ? 'visible' : 'hidden' }}" >{{$edit->applicantName ? $edit->applicantName : $edit->fbName}}</h1>
            <h1 class="text-4xl p-4" {{$edit->fbName && !$edit->applicantName ? 'visible' : 'hidden' }}>{{$edit->fbName ? $edit->fbName : $edit->applicantName}}</h1>
            <h1 class="text-4xl p-4 {{$edit->applicantName && $edit->fbName ? 'visible' : 'hidden' }}" >{{$edit->applicantName ? $edit->applicantName : ''}}</h1>
            <div class="flex flex-row justify-center items-center">
        
                {{-- <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4  whitespace-nowrap font-bold lg:w-[45%]">Scoring</p>
                        <p class=" px-4 py-2 w-full">{{$scoring}}</p>
                        <select name="scoring" id="scoring" disabled class=" px-4 py-2 w-full ">
                            @foreach ($scoring as $list)
                          
                            <option <?php if($list->scoringID == $edit->scoring) echo 'selected="selected"'; ?> value="{{$list->scoringID}}">{{$list->scoringName}}</option>
                            @endforeach
                        </select>
        
                </div> --}}
                <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                    <p class="lg:px-4  whitespace-nowrap font-bold lg:w-[45%]">Scoring: </p>
                        <p class=" px-4 py-2 w-full">{{$scoring}}</p>
                        {{-- <select name="scoring" id="scoring" class="border px-4 py-2 w-full border-gray-600">
                            @foreach ($scoring as $list)
                          
                            <option <?php if($list->scoringID == $edit->scoring) echo 'selected="selected"'; ?> id="scoring" value="{{$list->scoringID}}">{{$list->scoringName}}</option>
                            @endforeach
                        </select> --}}
        
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-2   bg-[#fff] shadow-lg shadow-gray-600">
            <div class="">
            
                <div class=" w-full  p-6 bg-[#fff]  shadow-gray-600">
                    <div class="flex flex-row items-center py-4">
                        <p class="lg:px-4 pr-2 whitespace-nowrap font-bold lg:w-[36%]">Lead Source</p>
                        <select name="inquiryLeadSource" disabled id="inquiryLeadSource" class=" px-2 pr-8 py-[2px]">
                            @foreach ($leadsource as $list)
                                <option <?php if($list->leadsourceID == $edit->inquiryLeadSource) echo 'selected="selected"'; ?> value="{{$list->leadsourceID}}">{{$list->leadSourceName}}</option>
                            @endforeach
                    
                        </select>
                    </div>
            
                    {{-- <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">First Name</p>
                        <input type="text" name="applicantFirstName" disabled value="{{$edit->applicantFirstName}}"placeholder="First name" class="px-4 py-2 border border-gray-600 w-full">
        
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">Last Name</p>
                        <input type="text" name="applicantLastName" disabled value="{{$edit->applicantLastName}}"placeholder="Last name" class="px-4 py-2 border border-gray-600 w-full">
                    </div> --}}
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">Full Name</p>
                        <input type="text" name="applicantName" disabled value="{{$edit->applicantName}}"placeholder="Last name" class="px-4 py-2 border border-gray-600 w-full">
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">Facebook </p>
                        <input type="text" name="fbName" disabled value="{{$edit->fbName}}"placeholder="Facebook name" class="px-4 py-2 border border-gray-600 w-full">
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">Email Address</p>
                        <input type="text" name="email" disabled value="{{$edit->email}}"placeholder="Email address" class="px-4 py-2 border border-gray-600 w-full">
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">Phone Number</p>
                        <input type="text" name="phoneNumber" disabled value="{{$edit->phoneNumber}}"placeholder="Phone number" class="px-4 py-2 border border-gray-600 w-full">
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4 whitespace-nowrap font-bold lg:w-[45%]">Country Reside</p>
                        <input type="text" name="countryReside" disabled value="{{$edit->countryReside}}"placeholder="Country reside" class="px-4 py-2 border border-gray-600 w-full">
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  whitespace-nowrap font-bold lg:w-[45%]">Type of Exam</p>
                        {{-- <select  id="cars" name="serviceType" class="border px-4 py-2 w-full border-gray-600"> --}}
                    <div class="border px-4 py-2 w-full h-[150px] overflow-auto border-gray-600 grid-container grid grid-cols-4">
                        @foreach ($services as $list)
                            {{-- <option value="{{$list->serviceID}}">{{$list->serviceName}}</option> --}}
                     
                                <input type="checkbox" id="{{$list->serviceID}}" disabled name="serviceType[]" value="{{$list->serviceID}}" {{in_array($list->serviceID, $serviceType) ? "checked" : ''}} >
                                <label for="{{$list->serviceID}}" disabled class=" col-span-3" >{{$list->serviceName}}</label>
                        
        
                                
                        @endforeach
                    </div>
                 
                    </div>
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                        <p class="lg:px-4  whitespace-nowrap font-bold lg:w-[45%]">Representative</p>
                        <select name="representative" disabled id="representative" class="border px-4 py-2 w-full border-gray-600">
                            @foreach ($representatives as $list)
                            <option <?php if($list->id == $edit->representative) echo 'selected="selected"'; ?> value="{{$list->id}}">{{$list->firstName .' '. $list->lastName}}</option>
                                
                            @endforeach
                        
                        </select>
                    </div>
                    
                
                    
                    
                </div>
            </div>
           
            <div class="">
                <div class="w-full p-6 bg-[#fff]  shadow-gray-600">
                    
                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px] lg:h-[400px] overflow-auto">
                        <p class="lg:px-2.5  whitespace-nowrap font-bold lg:w-[45%]">Status</p>

                        <!-- <div class="accordion w-full  h-full " id="accordionExample">
                            @foreach ($getServiceAndPaymentAndLCAndNotes as $itemKey => $list)
                            <div class="accordion-item bg-white border w-full border-gray-200">
                                <h2 class="accordion-header" id="headingOne">
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
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse w-full " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body px-2 flex items-center">
                                        <p class="font-bold ">Status:</p> <span class="px-2"> {{$list->statusname}}</span>

                                       
                                    </div>
                                    <div class="px-2">
                                        <p class="font-bold inline">Date Paid: </p><span class="inline">{{$list->sdate ? $list->sdate : 'Not Paid'}}</span>
                                    </div>
                                    <div class="px-2">
                                        <p class="font-bold inline">Assigned LC: </p><span class="inline">
                                            <select disabled name="assignedLC[]" id="assignedLC" class="border px-4 py-2 w-full border-gray-600">
                                                  
                                                <option value="" selected>Select</option>
                                                @foreach ($lc as $lcKey => $listz)
                     
                                                <option  value="{{$listz->id}}" {{$assignedLC[$itemKey] === $lcKey+2  ? 'selected' : ''}} >{{$listz->firstName . ' ' . $listz->lastName}}</option>
                                                
                                                @endforeach
                                            
                                            </select>
                                            </span>
                                    </div>
                                    <div class="px-2">
                                        <p class="font-bold inline">Notes: </p>
                                        <textarea name="" id="" cols="30" rows="10" class="w-full p-2" disabled>{{$list->notes ? $list->notes : 'No notes.'}}</textarea>
                                    </div>
                                    <div class="myDiv hidden p-2">
                                        
                                        <select  id="source" onchange="copyTextValue()" name="paymentStatus[]" class="border p-2 w-full border-gray-600">
                                            @foreach ($status as $item)
                                               
                                                <option name="paymentStatus[]" value="{{$item->statusID}}"  id="{{$item->statusID}}">{{$item->statusName}}</option>

                                            @endforeach
                                        </select>
                                 
                                        <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-2">
                                            <p class="whitespace-nowrap font-bold lg:w-[45%]">Date Paid</p>
                                         
                                        
                                            <input type="datetime-local" name="datePaid[]" value="{{$list->sdate}}" placeholder="Date paid" class="px-2 py-2 border border-gray-600 w-full">
                                         
                                        </div>
                                        <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                                            <p class="whitespace-nowrap font-bold lg:w-[45%]">Assigned LC</p>
                                            <select name="assignedLC[]" id="assignedLC" class="border px-4 py-2 w-full border-gray-600">
                                                <option value="">Select</option>
                                             
                                                @foreach ($lc as $listz)
                     
                                                <option  value="{{$listz->id}}">{{$listz->firstName . ' ' . $listz->lastName}}</option>
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
                            @endforeach
                        </div> -->
                        <div class="w-full h-full">
                            @foreach ($getServiceAndPaymentAndLCAndNotes as $itemKey => $list)
                                <button class="accordion w-full">{{$list->servicename}}</button>
                                <div class="panel">
                                    <div class="accordion-body px-2 flex items-center">
                                        <p class="font-bold ">Status:</p> <span class="px-2"> {{$list->statusname}}</span>

                                       
                                    </div>
                                    <div class="px-2">
                                        <p class="font-bold inline">Date Paid: </p><span class="inline">{{$list->sdate ? $list->sdate : 'Not Paid'}}</span>
                                    </div>
                                    <div class="px-2">
                                        <p class="font-bold inline">Assigned LC: </p><span class="inline">
                                            <select  name="assignedLC[]" id="assignedLC" class="border px-4 py-2 w-full border-gray-600" disabled>
                                                  
                                                <option value="" selected>Select</option>
                                                @foreach ($lc as $lcKey => $listz)
                     
                                                <option  value="{{$listz->id}}" {{$assignedLC[$itemKey] === $lcKey+11  ? 'selected' : ''}} >{{$listz->firstName . ' ' . $listz->lastName}}</option>
                                                
                                                @endforeach
                                            
                                            </select>
                                            </span>
                                    </div>
                                    <div class="px-2">
                                        <p class="font-bold inline">Notes: </p>
                                        <textarea name="" id="" cols="30" rows="10" class="w-full p-2" disabled>{{$list->notes ? $list->notes : 'No notes.'}}</textarea>
                                    </div>
                                    <div class="flex flex-col lg:flex-row justify-evenly lg:items-center py-[2px]">
                                                <p class="whitespace-nowrap font-bold lg:w-[45%] pr-2">Sales Representative</p>
                                                <select name="representative[]"  id="representative" class="border px-4 py-2 w-full border-gray-600" disabled>
                                                    <option value="" selected >Select</option>
                                                    @foreach ($representatives as $repKey => $list)
                                                        <option value="{{$list->id}}" {{$rep[$itemKey] === $repKey+11 ? 'selected' : ''}} >{{$list->firstName .' '. $list->lastName}}</option>
                                                        
                                                    @endforeach
                                                
                                                </select>
                                    </div>
                                </div>
                                
                            @endforeach
                        </div>
                        
                    </div>
                    
                </div>

              

                <div class="flex justify-end items-center p-4 pb-6 px-6">
                    
                    <a href="/viewinquiries" type="submit" 
                    class="
                    px-8
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
                        Back
                    </a>
                </div>
            
            </div>
        </div>

</div>
</x-layouts>
