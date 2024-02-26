
<x-layouts>
  <div class="bg-bgMain w-full h-screen p-7">
        <?php if(auth()->user()->userType == 4 || auth()->user()->userType == 1 || auth()->user()->userType == 3):?>
        <div class="flex flex-col sm:flex-row justify-between items-center">
          <h1 class="text-2xl py-2">{{$event->eventName}}</h1>
          <a href="{{route('events.showaddparticipants',$id)}}" class="
                    px-6
                    py-3
                    bg-green-600
                    text-white
                    font-medium
                    text-xs
                    leading-tight
                    uppercase
                    shadow-md
                    hover:bg-green-700 hover:shadow-lg
                    focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-green-700 active:shadow-lg
                    transition-all
                    duration-350
                    ease-in-out
                    border-amber-600
                    ">   
                        Add Participants
            </a>

  

        </div>
        <!--{{-- <div class="flex sm:flex-row flex-col lg:justify-evenly lg:items-center p-4"> --}}-->
        <div class="flex sm:flex-row flex-col lg:justify-between lg:items-center">

          
          <form class="py-2 w-full">
            <div class=" flex flex-col justify-evenly sm:flex-row items-center w-full ">
              <!--<div class="w-full flex flex-col h-full w-full ">-->
              <!--  <p class="">Specific Searching</p>-->
              <!--  <div class="flex sm:flex-row flex-col items-center justify-center w-full">-->
              <!--    <select name="category" id="category" class=" px-4 sm:pr-8 py-2 w-full">-->
              <!--               @php $ref = (isset($_GET['category'])) ? $_GET['category'] : ''; @endphp-->
              <!--      <option value=""  @if( $ref == '' ) selected @endif>Select</option>-->
              <!--      <option value="inquiryID"  @if( $ref == 'inquiryID' ) selected @endif>Inquiry No.</option>-->
                    <!--<option value="serviceName" @if( $ref == 'serviceName' ) selected @endif>Service</option>-->
              <!--      <option value="applicantName" @if( $ref == 'applicantName' ) selected @endif>Full Name</option>-->
              <!--      <option value="fbName" @if( $ref == 'fbName' ) selected @endif>Facebook</option>-->
              <!--      <option value="email" @if( $ref == 'email' ) selected @endif>Email Address</option>-->
              <!--      <option value="scoringName" @if( $ref == 'scoringName' ) selected @endif>Scoring</option>-->
                    <!--<option value="phoneNumber" @if( $ref == 'phoneNumber' ) selected @endif>Phone Number</option>-->
                    <!--<option value="countryReside" @if( $ref == 'countryReside' ) selected @endif>Country Reside</option>-->
              
              <!--    </select>-->
              <!--    <input type="text" name="advSearch" class=" mx-[2px] px-4 sm:pr-8 py-2 w-full" placeholder="Search" value="{{isset($_GET['advSearch']) ? $_GET['advSearch'] : ''}}">-->
              <!--  </div>-->
              <!--</div>-->
      
  
              <!--<div class=" flex flex-col justify-end w-full ">-->
              <!--    <div class="w-full invisible">a</div>-->
              <!--    <div class="flex flex-row items-center justify-end w-full">-->
              <!--           <div class="invisible w-full">a</div>-->
              <!--      <button class="-->
              <!--      px-6-->
              <!--      py-3-->
              <!--      bg-yellow-500-->
              <!--      text-white-->
              <!--      font-medium-->
              <!--      text-xs-->
              <!--      leading-tight-->
              <!--      uppercase-->
              <!--      shadow-md-->
              <!--      hover:bg-yellow-600 hover:shadow-lg-->
              <!--      focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0-->
              <!--      active:bg-yellow-600 active:shadow-lg-->
              <!--      transition-all-->
              <!--      duration-350-->
              <!--      ease-in-out-->
              <!--      border-yellow-600-->
              <!--      mx-2-->
              <!--      ">   -->
              <!--          Search-->
              <!--      </button>-->
              <!--             <a href="http://usaexamcenter.com/viewinquiries" class="-->
              <!--      px-6-->
              <!--      py-3-->
              <!--      bg-red-600-->
              <!--      text-white-->
              <!--      font-medium-->
              <!--      text-xs-->
              <!--      leading-tight-->
              <!--      uppercase-->
              <!--      shadow-md-->
              <!--      hover:bg-red-700 hover:shadow-lg-->
              <!--      focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0-->
              <!--      active:bg-red-700 active:shadow-lg-->
              <!--      transition-all-->
              <!--      duration-350-->
              <!--      ease-in-out-->
              <!--      border-amber-600-->
              <!--      ">   -->
              <!--          Clear-->
              <!--      </a>-->
              <!--    </div>-->
             
              <!--</div>-->
              
            </div>
          </form>
          
        </div>

        <div class="px-4 py-2">
                 {{ $records->appends(request()->all())->links() }}
        </div> 
   
        
        @if(session()->has('success'))
       
            
                    <div id="alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-2" role="alert">
                      <!--<strong class="font-bold">Holy smokes!</strong>-->
                      <span class="block sm:inline">{{ session()->get('success') }}</span>
                      <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="closeAlert()">
                        <svg onclick="closeAlert()" class="fill-current h-6 w-6 text-black/60" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                      </span>
                    </div>
                @endif    
        <div class="overflow-auto h-[65%] shadow-md shadow-black">

                  
          <table class="table-auto text-left text-xs w-full  max-w-[50%] lg:max-w-[100%] bg-white  py-4">
            
              <thead class="border-b bg-white shadow-sm sticky top-0">
                <tr>
                  <th class="px-4 py-2">#</th>
             
                  <th class="px-4 py-2">Full Name</th>
                  <th class="px-4 py-2">Facebook</th>
                  <th class="px-4 py-2">Email</th>
                  <th class="px-4 py-2">Contact Number</th>
                  <th class="px-4 py-2">Preferred State/Country/Service</th>
                  <th class=" py-2">Status</th>
                  <th class="px-4 py-2">Action</th>
                </tr>
              </thead>
              <tbody class="overflow-y-auto">
                @php 
                    $count = 1;
                @endphp
                @if (count($records) > 0)
                  @foreach ($records as $list)
                    <tr class="border-b-2 py-2">
                    
                      <td class="px-4 py-2">{{$count}}</td>
                      <td class="px-4 py-2">{{$list->fullName}}</td>
                      <td class="px-4 py-2">{{$list->fb}}</td>
                      <td class="px-4 py-2">{{$list->email}}</td>
                      <td class="px-4 py-2">{{$list->contactNumber}}</td>
                      <td class="px-4 py-2">{{$list->statecountry}}</td>
                      <td class="px-4 py-2">{{$list->status}}</td>
           
                 
                      <td class="px-4 py-2 whitespace-nowrap">
                        <!--<a href="" title="View Inquiry" target="_blank" rel="noopener noreferrer"><i class="bi bi-eye-fill"></i></a>-->
                          @if(auth()->user()->userType == 1 || auth()->user()->userType == 4)
                            <a href="{{route('events.viewparticipants',$list->eventRecordID)}}" title="Edit" target="_blank" rel="noopener noreferrer"><i class="bi bi-pencil-square text-blue-600"></i></a>
                              @if ($list->activitystatus == 0)
                                <form action="{{route('events.reactivateparticipant',$list->eventRecordID)}}" method="POST" class="inline">
                                  @csrf
                                  @method("PUT")
                                  <button type="submit"><i class="bi bi-check-lg text-green-600"></i></button>
                                </form>
                              @endif
                              <form action="{{route('events.deleteparticipant',$list->eventRecordID)}}" method="POST" class="{{$list->activitystatus == 0 ? "hidden" : "inline"}} ">
                              @csrf
                              @method("PUT")
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this participant?');"><i class="bi bi-trash3-fill text-red-600"></i></button>
              
                              </form>
     
                          @endif
                      </td>
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
        <div class="w-full flex justify-end items-center py-4">
           <a href="/events/viewevents" class="
                    px-6
                    py-3
                    bg-red-600
                    text-white
                    font-medium
                    text-xs
                    leading-tight
                    uppercase
                    shadow-md
                    hover:bg-red-700 hover:shadow-lg
                    focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-red-700 active:shadow-lg
                    transition-all
                    duration-350
                    ease-in-out
                    border-amber-600
                    ">   
                        Back
            </a> 
        </div>
        
          <?php else: ?>
            <p>you don't have access in this page.</p>
        <?php endif; ?>
      <!--<div class=" p-4 bottom-0">-->
      <!--  {{-- {{$inquiries->links()}} --}}-->
      <!--  {{ $records->appends(request()->all())->links() }}-->
      <!--</div>-->
  </div>

</x-layouts>

<script>
    var x = document.getElementById("alert");
    function closeAlert(){
        x.style.display = "none";
    }
</script>